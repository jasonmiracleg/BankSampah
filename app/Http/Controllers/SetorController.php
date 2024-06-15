<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SetorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setors = Setor::all();
        return view('Penyetoran.index', ['setors' => $setors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('Penyetoran.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => ['required'],
            'weight' => ['required'],
        ], [
            'product_name.required' => 'Nama Barang harus diisi.',
            'weight.required' => 'Berat Barang harus diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Setor::create([
            'product_name' => $request->product_name,
            'weight' => $request->weight,
            'recipient_id' => $request->recipient,
            'sender_id' => $request->sender
        ]);

        return redirect()->route('penyetoran');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setor $setor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setor $setor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setor $setor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setor $setor)
    {
        //
    }
}
