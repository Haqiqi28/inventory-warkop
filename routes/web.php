<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('/dashboard/admin',
        [DashboardController::class,'admin'])
        ->name('dashboard.admin');

    Route::resource('barang-masuk', BarangMasukController::class);
    Route::resource('barang-keluar', BarangKeluarController::class);

});

Route::middleware(['auth','role:master'])->group(function () {

    Route::get('/dashboard/master',
        [DashboardController::class,'master'])
        ->name('dashboard.master');
    
        Route::resource('barang', BarangController::class);

});

require __DIR__.'/auth.php';