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
            $setors = Setor::orderBy('created_at', 'desc')->paginate(10);
        } else {
            $setors = Setor::where('sender_id', auth()->id())
                ->orderBy('created_at', 'desc')
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
            'sender' => ['required'],
            'garbage' => ['required']
        ], [
            'quantity.required' => 'Berat Barang harus diisi.',
            'sender.required' => 'Nama Nasabah harus diisi.',
            'garbage.required' => 'Nama Barang harus diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Setor::create([
            'weight' => $request->quantity,
            'sender_id' => $request->sender,
            'garbage_id' => $request->garbage
        ]);
        $garbage = Sampah::find($request->garbage);
        Transaction::create([
            'keterangan' => "Setor {$garbage->garbage_type} {$request->quantity} kg",
            'total_nominal' => $request->total_price,
            'transaction_type' => '0',
            'user_id' => $request->sender
        ]);

        $this->updateUserSaldo($request->sender);

        return redirect()->route('penyetoran');
    }

    /**
     * Display the specified resource.
     */
    public function sell(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'berat' => ['required', 'numeric', 'min:200'],
            'price' => ['required']
        ], [
            'berat.required' => 'Berat Barang harus diisi.',
            'berat.numeric' => 'Berat Barang harus berupa angka.',
            'berat.min' => 'Berat Barang harus lebih dari 200.',
            'price.required' => 'Nominal Uang harus diisi.'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        $user = User::where('is_admin', '1')->first();
        $sold_garbage = $user->garbage_sold;

        $allSetor = Setor::all();
        $totalGarbage = 0;
        foreach($allSetor as $setor){
            $totalGarbage += $setor->weight;
        }

        if ($request->berat > $totalGarbage - $sold_garbage) {
            return redirect()->back()
            ->withErrors(['berat' => 'Jumlah Sampah Saat Ini Tidak Mencukupi.'])
            ->withInput();
        }

        $sold_garbage += $request->berat;
        $user->update([
            'garbage_sold' => $sold_garbage
        ]);

        Transaction::create([
            'keterangan' => "Penjualan Sampah {$request->berat} kg",
            'total_nominal' => $request->price,
            'transaction_type' => '0',
            'user_id' => auth()->id()
        ]);

        $this->updateUserSaldo(auth()->id());

        return redirect()->route('transaksi');
    }

    public function withdraw(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'price' => ['required', 'numeric', 'min:10000']
        ], [
            'price.required' => 'Nominal Uang harus diisi.',
            'price.numeric' => 'Nominal Uang harus berupa angka.',
            'price.min' => 'Nominal Uang minimal Rp 10.000'
        ]);        

        $totalIncome = 0;
        $totalOutcome = 0;

        $users = User::where('is_admin', '1')->get();
        foreach ($users as $user) {
            $totalIncome += $user->total_income;
            $totalOutcome += $user->total_outcome;
        }

        $saldoAdmin = $totalIncome-$totalOutcome;

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        if($request->price > $saldoAdmin){
            return redirect()->back()
            ->withErrors(['price' => 'Jumlah Saldo Admin tidak mencukupi.'])
            ->withInput();
        }

        if($request->saving < $request->price){
            return redirect()->back()
            ->withErrors(['price' => 'Jumlah Saldo Nasabah tidak mencukupi.'])
            ->withInput();
        }

        $user = User::find($request->user_id);
        Transaction::create([
            'keterangan' => "Pencairan Dana oleh Nasabah {$user->name} ",
            'total_nominal' => $request->price,
            'transaction_type' => '1',
            'user_id' => auth()->id()
        ]);

        Transaction::create([
            'keterangan' => "Penarikan Dana",
            'total_nominal' => $request->price,
            'transaction_type' => '1',
            'user_id' => $request->user_id
        ]);

        $this->updateUserSaldo(auth()->id());
        $this->updateUserSaldo($request->user_id);

        return redirect()->route('transaksi');
    }

    public function updateUserSaldo($user_id)
    {
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
