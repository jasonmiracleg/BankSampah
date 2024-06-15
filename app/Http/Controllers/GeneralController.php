<?php

namespace App\Http\Controllers;

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
            ->get();
        $latestSetors = Setor::where('sender_id', $user_id)
            ->latest()
            ->take(5)
            ->get();

        return view('home', compact('latestTransactions', 'latestSetors'));
    }
}
