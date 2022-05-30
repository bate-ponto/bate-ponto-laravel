<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::view('/', 'pages.index')->name('index');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::prefix('login')->controller()->group(function () {
    Route::get('/', [LoginController::class, 'loginForm'])->name('login');
    Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authentication');
});

Route::prefix('register')->group(function () {
    Route::get('/', [LoginController::class, 'registerForm'])->name('register');
    Route::post('/create-account', [LoginController::class, 'register'])->name('create-account');
});
