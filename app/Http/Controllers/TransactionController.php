<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index(){
        $transactions = Transaction::all();
        return view('Transaksi.index',['transactions' => $transactions]);
    }

    public function create(){
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
        return redirect()->route('transaksi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transaksi');
    }
}
