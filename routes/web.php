<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisMobilController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/mobils/export/csv', [MobilController::class, 'exportCsv'])->name('mobils.export.csv');
    Route::get('/mobils/export/txt', [MobilController::class, 'exportTxt'])->name('mobils.export.txt');
    
    Route::resource('jenis-mobils', JenisMobilController::class);
    Route::resource('mobils', MobilController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
