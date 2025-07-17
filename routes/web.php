<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisMobilController;
use App\Http\Controllers\MobilController;
use Illuminate\Support\Facades\Route;

// Redirect root to dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard and main routes (no auth required)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Export routes
Route::get('/mobils/export/csv', [MobilController::class, 'exportCsv'])->name('mobils.export.csv');
Route::get('/mobils/export/txt', [MobilController::class, 'exportTxt'])->name('mobils.export.txt');

// Resource routes
Route::resource('jenis-mobils', JenisMobilController::class);
Route::resource('mobils', MobilController::class);
