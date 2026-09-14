<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\DashboardController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/agent/{type?}', [AgentController::class, 'show'])->name('agent.show');

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/mahasiswa/{nrp}', [DashboardController::class, 'mahasiswa'])
        ->where('nrp', '[0-9]{10}')
        ->name('mahasiswa');

    Route::get('/mahasiswa/{invalid_nrp}', [DashboardController::class, 'invalidNrp'])
        ->where('invalid_nrp', '.*')
        ->name('mahasiswa.invalid');

    Route::get('/hitung-ipk/{ip1}/{ip2}', [DashboardController::class, 'kalkulator'])
        ->where(['ip1' => '[0-9\.]+', 'ip2' => '[0-9\.]+'])
        ->name('kalkulator');
});

Route::fallback([PageController::class, 'fallback'])->name('fallback');
