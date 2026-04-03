<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.loginpage');
});

Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::get('/dashboard', [App\Http\Controllers\RedirectController\GetController::class, 'dashboard'])->name('dashboard');