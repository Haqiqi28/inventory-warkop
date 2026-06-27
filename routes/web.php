<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\LaporanTransaksiController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('/dashboard/admin',
        [DashboardController::class,'admin'])
        ->name('dashboard.admin');

    Route::resource('barang-masuk', BarangMasukController::class);
    Route::resource('barang-keluar', BarangKeluarController::class);

});

Route::middleware(['auth', 'role:master'])->group(function () {

    Route::get('/dashboard/master', [DashboardController::class, 'master'])
        ->name('dashboard.master');

    Route::resource('barang', BarangController::class);

    Route::resource('outlet', OutletController::class);

    Route::get('/pilih-outlet', [OutletController::class, 'pilih'])
        ->name('pilih-outlet');

    Route::prefix('laporan')->name('laporan.')->group(function () {

        Route::get('/', [LaporanTransaksiController::class, 'index'])
            ->name('index');

    });

});

require __DIR__.'/auth.php';