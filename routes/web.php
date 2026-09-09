<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanMasukController;

Route::get('/', function () {
    return view('welcome');
});

// Rute khusus Admin
Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

// Rute khusus Petugas
Route::get('/petugas/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:petugas'])
    ->name('petugas.dashboard');

// Form pelaporan — bisa diakses SEMUA orang (guest/Masyarakat maupun Petugas login)
Route::get('/laporan/buat', [LaporanMasukController::class, 'create'])->name('laporan.create');
Route::post('/laporan', [LaporanMasukController::class, 'store'])->name('laporan.store');

// Khusus Petugas
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/petugas/laporan-saya', [LaporanMasukController::class, 'laporanSaya'])->name('petugas.laporan-saya');
});

// Khusus Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/laporan', [LaporanMasukController::class, 'index'])->name('admin.laporan.index');
    Route::get('/admin/verifikasi-laporan', [LaporanMasukController::class, 'antrean'])->name('admin.verifikasi-laporan');
    Route::post('/admin/laporan/{laporanMasuk}/verifikasi', [LaporanMasukController::class, 'verifikasi'])->name('admin.laporan.verifikasi');
    Route::post('/admin/laporan/{laporanMasuk}/tolak', [LaporanMasukController::class, 'tolak'])->name('admin.laporan.tolak');
});

#Route::get('/dashboard', function () {
    #return view('dashboard');
#})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
