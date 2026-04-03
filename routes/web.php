<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.loginpage');
})->name('login');

Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\RedirectController\GetController::class, 'dashboard'])->name('dashboard');
});