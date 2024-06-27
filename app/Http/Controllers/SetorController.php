<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Setor;
use App\Models\Sampah;
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
            $setors = Setor::all();
        } else {
            $setors = Setor::Where('sender_id', auth()->id())
            ->get();
        }

        return view('Penyetoran.index', ['setors' => $setors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('is_admin', '0')->get();;
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
}
