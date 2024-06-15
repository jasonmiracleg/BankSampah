<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\GeneralController;

Route::get('/', [AuthenticationController::class, 'loginPage'])->name('login.page');
Route::get('/register', [AuthenticationController::class, 'registerPage'])->name('register.page');

Route::post('/login', [AuthenticationController::class, 'authenticate'])->name('login');
Route::post('/registered', [AuthenticationController::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {
    Route::get('/beranda', [GeneralController::class, 'index'])->name('home');
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});