<?php

use App\Http\Controllers\LoginController;
use App\Http\Livewire\{Login, Pages, Register};
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', Pages\Index::class)->name('index');
    Route::get('user', Pages\UserSettings::class)->name('user');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});
