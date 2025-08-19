<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BtController;
use App\Http\Controllers\KpController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Rute Umum & Autentikasi
|--------------------------------------------------------------------------
*/

// Halaman Utama / Landing Page
Route::get('/', function () {
    return view('landingpage.lp');
})->name('lp');

// Rute untuk Autentikasi (Login & Logout)
Route::controller(LoginController::class)->group(function () {
    Route::get('auth', 'showLoginForm')->name('login');
    Route::post('auth', 'login');
    Route::post('logout', 'logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Rute Fitur: Kepuasan Pelanggan (KP)
|--------------------------------------------------------------------------
*/
Route::controller(KpController::class)->group(function () {
    // Rute Publik untuk Tamu
    Route::get('/kp', 'create')->name('kp.create');
    Route::post('/kp', 'store')->name('kp.store');

    // Rute Terproteksi untuk Admin (Wajib Login)
    Route::middleware(['auth'])->group(function () {
        Route::get('admin/kepuasan', 'index')->name('admin.kp.index');
        Route::get('/kp/download-pdf', 'downloadPDF')->name('kp.downloadPDF');
    });
});

/*
|--------------------------------------------------------------------------
| Rute Fitur: Buku Tamu (BT)
|--------------------------------------------------------------------------
*/
Route::controller(BtController::class)->group(function () {
    // Rute Publik untuk Tamu
    Route::get('/bt', 'create')->name('bt.create');
    Route::post('/bt', 'store')->name('bt.store');

    // Rute Terproteksi untuk Admin (Wajib Login)
    Route::middleware(['auth'])->group(function () {
        Route::get('/bt/view', 'viewBt')->name('bt.view');
        Route::get('/buku-tamu/excel', 'exportExcel')->name('buku-tamu.excel');
        Route::get('/bt/export-pdf', 'exportPdf')->name('bt.exportPdf');
    });
});

/*
|--------------------------------------------------------------------------
| Rute Terproteksi Lainnya (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Halaman Dashboard
    Route::get('/dashboard', [DashboardController::class, 'showSurveyPage'])->name('dashboard');
    Route::get('admin/tampilan-survei', [App\Http\Controllers\DashboardController::class, 'showSurveyPage'])->name('admin.tampilan.survei');

    // Halaman Profile Pengguna
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });
});

// require __DIR__.'/auth.php';
