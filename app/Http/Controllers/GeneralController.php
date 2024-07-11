<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Setor;
use App\Models\Transaction;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $latestTransactions = Transaction::where('user_id', $user_id)
            ->latest()
            ->take(5)
            ->orderBy('created_at', 'desc')
            ->get();
        $latestSetors = Setor::where('sender_id', $user_id)
            ->latest()
            ->take(5)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalIncome = 0;
        $totalOutcome = 0;
        $totalGarbage = 0;

        $allSetor = Setor::all();
        foreach ($allSetor as $setor) {
            $totalGarbage += $setor->weight;
        }

        $admin = User::where('is_admin', '1')->first();
        $totalGarbage -= $admin->garbage_sold;

        if (auth()->user()->is_admin == 1) {
            $latestTransactions = Transaction::latest()->take(5)->orderBy('created_at', 'desc')->get();
            $latestSetors = Setor::latest()->take(5)->orderBy('created_at', 'desc')->get();
        } else {
            $transactions = Transaction::where('user_id', auth()->id())->get();
            foreach ($transactions as $transaction) {
                if ($transaction->transaction_type == '0') {
                    $totalIncome += $transaction->total_nominal;
                } else {
                    $totalOutcome += $transaction->total_nominal;
                }
            }
            $user_id = auth()->id();
            $user = User::find($user_id);

            $user->update([
                'total_income' => $totalIncome,
                'total_outcome' => $totalOutcome,
                'saldo' => $totalIncome - $totalOutcome,
            ]);
        }

        $users = User::where('is_admin', '1')->get();
        foreach ($users as $user) {
            $totalIncome += $user->total_income;
            $totalOutcome += $user->total_outcome;
        }

        return view('home', compact('latestTransactions', 'latestSetors', 'totalIncome', 'totalOutcome', 'totalGarbage'));
    }

    public function list(Request $request)
    {
        // Get current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Default query to fetch non-admin users sorted by saldo in descending order
        $query = User::where('is_admin', '0')
            ->orderBy('saldo', 'desc');

        // Check if search term is provided in the request
        if ($request->has('search')) {
            $searchTerm = $request->input('search');

            // Modify the query to include search functionality
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            });
        }

        // Fetch users with their transactions for the current month
        $users = $query->withCount(['sent as setor_count'])
            ->with(['sent' => function ($query) use ($currentMonth, $currentYear) {
                $query->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear);
            }])
            ->get();

        // Iterate through each user to calculate totals
        foreach ($users as $user) {
            // Initialize variables to hold totals
            $total_income = 0;
            $total_outcome = 0;

            // Fetch transactions for the current month and year
            $transactions = $user->transacted()
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->get();

            // Calculate total_income and total_outcome
            foreach ($transactions as $transaction) {
                if ($transaction->transaction_type == '0') {
                    $total_income += $transaction->total_nominal;
                } elseif ($transaction->transaction_type == '1') {
                    $total_outcome += $transaction->total_nominal;
                }
            }

            // Assign calculated totals to user object
            $user->total_income = $total_income;
            $user->total_outcome = $total_outcome;
        }

        // Now $users will have total_income and total_outcome for each user for the current month and year


        $users = $query->paginate(10); // Adjust 10 to the number of items per page you want
        return view('Anggota.index', compact('users'));
    }

    public function sellingIndex()
    {
        return view('jual_sampah');
    }

    public function transferIndex(User $user)
    {
        $user = User::where('id', $user->id)->first();
        return view('cair_saldo', ['user' => $user]);
    }
}
