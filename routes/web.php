<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\RedirectController\GetController::class, 'loginPage'])->name('login.page');

Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\RedirectController\GetController::class, 'dashboard'])->name('dashboard');
    Route::post('add-item', [App\Http\Controllers\ItemsController::class, 'addItems'])->name('items.store');

    
});