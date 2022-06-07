<?php

use App\Http\Controllers\LoginController;
use App\Http\Livewire\{Login, Register};
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::view('/', 'pages.index')->name('index');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('login', Login::class)->name('login');
Route::get('register', Register::class)->name('register');
