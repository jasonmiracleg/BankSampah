<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\SetorController;
use App\Http\Controllers\TransactionController;

Route::get('/', [AuthenticationController::class, 'loginPage'])->name('login.page');
Route::get('/register', [AuthenticationController::class, 'registerPage'])->name('register.page');

Route::post('/login', [AuthenticationController::class, 'authenticate'])->name('login');
Route::post('/registered', [AuthenticationController::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {
    Route::get('/beranda', [GeneralController::class, 'index'])->name('home');
    Route::get('/nasabah', [GeneralController::class, 'list'])->name('data.nasabah');
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    Route::get('/penyetoran', [SetorController::class, 'index'])->name('penyetoran');
    Route::get('/buat/penyetoran', [SetorController::class, 'create'])->name('penyetoran.create');
    Route::post('/store/penyetoran', [SetorController::class, 'store'])->name('penyetoran.store');
    Route::get('/edit/{setor}/penyetoran', [SetorController::class, 'edit'])->name('penyetoran.edit');
    Route::post('/update/{setor}/penyetoran', [SetorController::class, 'update'])->name('penyetoran.update');
    Route::get('/jual/{setor}', [SetorController::class, 'sell'])->name('penyetoran.jual');
    Route::get('/tarik/{setor}', [SetorController::class, 'withdraw'])->name('penyetoran.tarik');
    Route::get('/transaksi', [TransactionController::class, 'index'])->name('transaksi');
    Route::get('/buat/transaksi', [TransactionController::class, 'create'])->name('transaksi.create');
    Route::post('/store/transaksi', [TransactionController::class, 'store'])->name('transaksi.store');
    Route::get('/edit/{transaction}/transaksi', [TransactionController::class, 'edit'])->name('transaksi.edit');
    Route::post('/update/{transaction}/transaksi', [TransactionController::class, 'update'])->name('transaksi.update');
});
