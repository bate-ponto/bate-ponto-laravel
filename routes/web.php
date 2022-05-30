<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('authentication');

Route::middleware('auth')->group(function () {
    Route::view('/', 'pages.index')->name('index');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
