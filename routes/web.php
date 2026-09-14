<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AgentController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/agent/{type?}', [AgentController::class, 'show'])->name('agent.show');
Route::fallback([PageController::class, 'fallback'])->name('fallback');
