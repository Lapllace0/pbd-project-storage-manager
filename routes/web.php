<?php

use App\Http\Controllers\barangController;
use App\Http\Controllers\detailPenjualanController;
use App\Http\Controllers\kartuStokController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\penjualanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [loginController::class, 'tryLogin']);

Route::get('/dashboard', [loginController::class, 'toDashboard']);

Route::get('/dashboard/barang/{filter}/{id}', [barangController::class, 'getAll'])->name('getBarang');

Route::post('/barang/action', [barangController::class, 'actionBarang']);

Route::get('/dashboard/kartu-stok/{filter}/{id}', [kartuStokController::class, 'getAll'])->name('getKartuStok');

Route::post('/kartu-stok/action', [kartuStokController::class, 'actionStock']);

Route::get('/dashboard/penjualan/{filter}/{id}', [penjualanController::class, 'getAll'])->name('getPenjualan');

Route::get('/dashboard/detail-penjualan/{filter}/{id}', [detailPenjualanController::class, 'getAll'])->name('getDetailPenjualan');

Route::post('/detail-penjualan/action', [detailPenjualanController::class, 'actionDetailPenjualan']);








Route::get('/dashboard/users/{id}', [barangController::class, 'getAll'])->name('getUser');


Route::get('/dashboard/vendor/{id}', [barangController::class, 'getAll'])->name('getVendor');

Route::get('/dashboard/Role/{id}', [barangController::class, 'getAll'])->name('getRole');


Route::get('/dashboard/margin/{id}', [barangController::class, 'getAll'])->name('getMargin');

Route::get('/dashboard/satuan/{id}', [barangController::class, 'getAll'])->name('getSatuan');

Route::get('/dashboard/penerimaan/{id}', [barangController::class, 'getAll'])->name('getPenerimaan');

Route::get('/dashboard/detail-penerimaan/{id}', [barangController::class, 'getAll'])->name('getDetailPenerimaan');

Route::get('/dashboard/pengadaan/{id}', [barangController::class, 'getAll'])->name('getPengadaan');

Route::get('/dashboard/detail-pengadaan/{id}', [barangController::class, 'getAll'])->name('getDetailPengadaan');

Route::get('/dashboard/penjualan/{id}', [barangController::class, 'getAll'])->name('getPenjualan');

Route::get('/dashboard/detail-penjualan/{id}', [barangController::class, 'getAll'])->name('getDetailPenjualan');

Route::get('/dashboard/retur/{id}', [barangController::class, 'getAll'])->name('getRetur');

Route::get('/dashboard/detail-retur/{id}', [barangController::class, 'getAll'])->name('getDetailRetur');
