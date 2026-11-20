<?php

use App\Http\Controllers\barangController;
use App\Http\Controllers\detailPenerimaanController;
use App\Http\Controllers\detailPengadaanController;
use App\Http\Controllers\detailPenjualanController;
use App\Http\Controllers\kartuStokController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\marginPenjualanController;
use App\Http\Controllers\penerimaanController;
use App\Http\Controllers\pengadaanController;
use App\Http\Controllers\penjualanController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\satuanController;
use App\Http\Controllers\usersController;
use App\Http\Controllers\vendorController;
use App\Models\marginPenjualan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [loginController::class, 'tryLogin']);


Route::middleware(['isLogin'])->group(function () {
    Route::get('/dashboard', [loginController::class, 'toDashboard'])->name('dashboard');

    Route::get('/dashboard/barang/{filter}/{id}', [barangController::class, 'getAll'])->name('getBarang');

    Route::post('/barang/action', [barangController::class, 'actionBarang']);

    Route::get('/dashboard/kartu-stok/{filter}/{id}', [kartuStokController::class, 'getAll'])->name('getKartuStok');

    Route::post('/kartu-stok/action', [kartuStokController::class, 'actionStock']);

    Route::get('/dashboard/vendor/{filter}/{id}', [vendorController::class, 'getAll'])->name('getVendor');
    Route::post('/vendor/action', [vendorController::class, 'actionVendor']);

    Route::get('/dashboard/pengadaan/{filter}/{page}', [pengadaanController::class, 'getAll'])->name('getPengadaan');
    Route::post('/pengadaan/action', [pengadaanController::class, 'actionPengadaan']);
    Route::get('/dashboard/detail-pengadaan/{idPengadaan}/{page}', [detailPengadaanController::class, 'getAll'])->name('getDetailPengadaan');
    Route::post('/detail-pengadaan/action', [detailPengadaanController::class, 'actionDetailPengadaan']);


    Route::get('/dashboard/penerimaan/{filter}/{page}', [penerimaanController::class, 'getAll'])->name('getPenerimaan');
    Route::post('/penerimaan/action/{idPengadaan}', [penerimaanController::class, 'getBarangPengadaanAktif']);
    Route::post('/penerimaan/action', [penerimaanController::class, 'actionPenerimaan']);
    Route::get('/penerimaan/getBarang/{idPengadaan}', [penerimaanController::class, 'getBarang']);
    Route::get('/dashboard/detail-penerimaan/{idPenerimaan}/{page}', [detailPenerimaanController::class, 'getAll'])->name('getDetailPenerimaan');
    Route::post('/detail-penerimaan/action', [detailPenerimaanController::class, 'actionDetailPenerimaan']);


    Route::get('/dashboard/penjualan/{page}', [penjualanController::class, 'getAll'])->name('getPenjualan');
    Route::post('/penjualan/action', [penjualanController::class, 'actionPenjualan']);
    Route::get('/dashboard/detail-penjualan/{idPenjualan}/{page}', [detailPenjualanController::class, 'getAll'])->name('getDetailPenjualan');
    Route::post('/detail-penjualan/action', [detailPenjualanController::class, 'actionDetailPenjualan']);




    Route::post('/users/action', [usersController::class, 'actionUsers']);
    Route::get('/dashboard/users/{page}', [usersController::class, 'getAll'])->name('getUser');

    Route::post('/role/action', [roleController::class, 'actionRole']);
    Route::get('/dashboard/role/{page}', [roleController::class, 'getAll'])->name('getRole');

    Route::post('/satuan/action', [satuanController::class, 'actionSatuan']);
    Route::get('/dashboard/satuan/{filter}/{page}', [satuanController::class, 'getAll'])->name('getSatuan');

    Route::post('/margin-penjualan/action', [marginPenjualanController::class, 'actionMarginPenjualan']);
    Route::get('/dashboard/margin-penjualan/{filter}/{page}', [marginPenjualanController::class, 'getAll'])->name('getMarginPenjualan');


    Route::post('/logout', [logoutController::class, 'logout'])->name('logout');

});


