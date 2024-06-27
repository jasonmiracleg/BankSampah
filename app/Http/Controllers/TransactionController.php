<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', auth()->id())->paginate(10);
        return view('Transaksi.index', ['transactions' => $transactions]);
    }

    public function create()
    {
        return view('Transaksi.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keterangan' => ['required'],
            'total_nominal' => ['required'],
        ], [
            'keterangan.required' => 'Keterangan harus diisi.',
            'total_nominal.required' => 'Nominal harus diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Transaction::create([
            'keterangan' => $request->keterangan,
            'total_nominal' => $request->total_nominal,
            'transaction_type' => $request->transaction_type,
            'user_id' => $request->user_id
        ]);

        $this->updateSaving();

        return redirect()->route('transaksi');
    }

    public function edit(Transaction $transaction)
    {
        $transactionEdit = Transaction::where('id', $transaction->id)->first();
        return view('Transaksi.edit', compact('transactionEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $transaction->update([
            'keterangan' => $request->keterangan,
            'total_nominal' => $request->total_nominal,
            'transaction_type' => $request->transaction_type,
            'user_id' => $request->user_id
        ]);

        $this->updateSaving();
        
        return redirect()->route('transaksi');
    }
    
    public function updateSaving()
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
}
