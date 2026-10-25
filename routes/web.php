<?php

use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [loginController::class, 'tryLogin']);

Route::get('/dashboard', [loginController::class, 'toDashboard']);

// Route::barang('/barang', )
