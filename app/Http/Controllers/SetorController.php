<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setor;
use App\Models\Sampah;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SetorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->is_admin == 1) {
            $setors = Setor::paginate(10);
        } else {
            $setors = Setor::Where('sender_id', auth()->id())
                ->paginate(10);
        }

        return view('Penyetoran.index', ['setors' => $setors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('is_admin', '0')->get();
        $garbages = Sampah::all();
        return view('Penyetoran.create', ['users' => $users, 'garbages' => $garbages]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => ['required'],
        ], [
            'quantity.required' => 'Berat Barang harus diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Setor::create([
            'weight' => $request->quantity,
            'sender_id' => $request->sender,
            'garbage_id' => $request->garbage
        ]);

        return redirect()->route('penyetoran');
    }

    /**
     * Display the specified resource.
     */
    public function sell(Setor $setor)
    {
        Transaction::create([
            'keterangan' => 'Penjualan ' . $setor->detailGarbage->garbage_type,
            'total_nominal' => $setor->detailGarbage->price * $setor->weight,
            'transaction_type' => '0',
            'user_id' => auth()->id()
        ]);

        $this->updateUserSaldo();

        $setor->update([
            'is_sold' => '1'
        ]);

        return redirect()->route('transaksi');
    }

    public function withdraw(Setor $setor)
    {
        $totalIncome = 0;
        $totalOutcome = 0;

        $users = User::where('is_admin', '1')->get();
        foreach ($users as $user) {
            $totalIncome += $user->total_income;
            $totalOutcome += $user->total_outcome;
        }

        $saldoAdmin = $totalIncome-$totalOutcome;

        if($setor->detailGarbage->price * $setor->weight > $saldoAdmin){
            return redirect()->route('penyetoran')->with('error', 'Saldo Bank Sampah tidak mencukupi untuk melakukan penarikan.');
        }

        Transaction::create([
            'keterangan' => 'Penarikan Uang ' . $setor->detailGarbage->garbage_type,
            'total_nominal' => $setor->detailGarbage->price * $setor->weight,
            'transaction_type' => '1',
            'user_id' => auth()->id()
        ]);

        Transaction::create([
            'keterangan' => 'Pemasukan ' . $setor->detailGarbage->garbage_type,
            'total_nominal' => $setor->detailGarbage->price * $setor->weight,
            'transaction_type' => '0',
            'user_id' => $setor->sender->id
        ]);

        $this->updateUserSaldo();

        $setor->update([
            'is_withdrawn' => '1'
        ]);

        return redirect()->route('transaksi');
    }

    public function updateUserSaldo()
    {
        $user_id = auth()->id();
        $user = User::find($user_id);

        $transactions = Transaction::where('user_id', $user_id)->get();

        $totalIncome = 0;
        $totalOutcome = 0;

        foreach ($transactions as $transaction) {
            if ($transaction->transaction_type == '0') {
                $totalIncome += $transaction->total_nominal;
            } elseif ($transaction->transaction_type == '1') {
                $totalOutcome += $transaction->total_nominal;
            }
        }

        $saldo = $totalIncome - $totalOutcome;

        $user->update([
            'total_income' => $totalIncome,
            'total_outcome' => $totalOutcome,
            'saldo' => $saldo,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setor $setor)
    {
        $setorEdit = Setor::where('id', $setor->id)->first();
        $users = User::where('is_admin', '0')->get();
        $garbages = Sampah::all();
        return view('Penyetoran.edit', compact('setorEdit', 'users', 'garbages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setor $setor)
    {
        $setor->update([
            'weight' => $request->quantity,
            'sender_id' => $request->sender,
            'garbage_id' => $request->garbage
        ]);

        return redirect()->route('penyetoran');
    }
}
