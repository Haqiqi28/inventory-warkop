<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('/dashboard/admin',
        [DashboardController::class,'admin'])
        ->name('dashboard.admin');

});

Route::middleware(['auth','role:master'])->group(function () {

    Route::get('/dashboard/master',
        [DashboardController::class,'master'])
        ->name('dashboard.master');

});

require __DIR__.'/auth.php';