<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BtController;

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
Route::get('/bt', [BtController::class, 'create'])->name('bt.create');
Route::post('/bt',[BtController::class, 'store'])->name('bt.store');
Route::get('/bt/view', [BtController::class, 'viewBt'])->name('bt.view');
Route::get('/buku-tamu/excel', [BtController::class, 'exportExcel'])->name('buku-tamu.excel');
Route::get('/bt/export-pdf', [BtController::class, 'exportPdf'])->name('bt.exportPdf');


require __DIR__.'/auth.php';
