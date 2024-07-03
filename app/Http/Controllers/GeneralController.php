<?php

namespace App\Http\Controllers;

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
        foreach($allSetor as $setor){
            $totalGarbage += $setor->weight;
        }


        if (auth()->user()->is_admin == 1) {
            $latestTransactions = Transaction::latest()->take(5)->orderBy('created_at', 'desc')->get();
            $latestSetors = Setor::latest()->take(5)->orderBy('created_at', 'desc')->get();
        } else {
            $transactions = Transaction::where('user_id', auth()->id())->get();
            foreach ($transactions as $transaction) {
                if ($transaction->transaction_type == '0') {
                    $totalIncome += $transaction->total_nominal;
                } elseif ($transaction->transaction_type == '1') {
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

    public function list()
    {
        $users = User::where('is_admin', '0')
            ->orderBy('saldo', 'desc') // Sort by saldo in ascending order
            ->paginate(10); // Change 10 to the number of items per page you want

        return view('Anggota.index', compact('users'));
    }
}
