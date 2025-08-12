<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BtController;
use App\Http\Controllers\KpController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Form buku tamu untuk guest
Route::get('/buku-tamu', [BtController::class, 'create'])->name('bt.create');
Route::post('/buku-tamu', [BtController::class, 'store'])->name('bt.store');

// kepuasan pelanggan
Route::get('/kp', [KpController::class, 'create'])->name('kp.create');
// Route::get('/kp/create', [KpController::class, 'create'])->name('kp.create');
Route::post('/kp', [KpController::class, 'store'])->name('kp.store');

// kepuasan pelanggan -- rute admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/kepuasan', [\App\Http\Controllers\KpController::class, 'index'])->name('kp.index');
});


require __DIR__.'/auth.php';
