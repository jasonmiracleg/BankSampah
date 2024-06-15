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
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    Route::get('/penyetoran', [SetorController::class, 'index'])->name('penyetoran');
    Route::get('/buat/penyetoran', [SetorController::class, 'create'])->name('penyetoran.create');
    Route::post('/store/penyetoran', [SetorController::class, 'store'])->name('penyetoran.store');
    Route::get('/transaksi', [TransactionController::class, 'index'])->name('transaksi');
});