<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanMasukController;
use App\Http\Controllers\KejadianBencanaController;
use App\Http\Controllers\WilayahRawanController;
use App\Http\Controllers\BeritaController;
use Illuminate\Support\Facades\Route;


// Guest//
Route::get('/', function () {
    return view('welcome');
});

Route::get('/laporan/buat', [LaporanMasukController::class, 'create'])->name('laporan.create');
Route::post('/laporan', [LaporanMasukController::class, 'store'])->name('laporan.store');

Route::get('/berita', [BeritaController::class, 'publikIndex'])->name('berita.index');
Route::get('/berita/{berita}', [BeritaController::class, 'publikShow'])->name('berita.show');


// ROLE PETUGAS

Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/petugas/dashboard', [DashboardController::class, 'index'])->name('petugas.dashboard');

    Route::get('/petugas/laporan/buat', [LaporanMasukController::class, 'create'])->name('petugas.laporan.create');
    Route::post('/petugas/laporan', [LaporanMasukController::class, 'store'])->name('petugas.laporan.store');

    Route::get('/petugas/laporan-saya', [LaporanMasukController::class, 'laporanSaya'])->name('petugas.laporan-saya');
});

// ROLE ADMIN

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // buat laporan admin
    Route::get('/admin/laporan/buat', [LaporanMasukController::class, 'create'])->name('admin.laporan.create');
    Route::post('/admin/laporan', [LaporanMasukController::class, 'store'])->name('admin.laporan.store');

    //Kelola laporan
    Route::get('/admin/laporan', [LaporanMasukController::class, 'index'])->name('admin.laporan.index');
    Route::get('/admin/verifikasi-laporan', [LaporanMasukController::class, 'antrean'])->name('admin.verifikasi-laporan');
    Route::post('/admin/laporan/{laporanMasuk}/verifikasi', [LaporanMasukController::class, 'verifikasi'])->name('admin.laporan.verifikasi');
    Route::post('/admin/laporan/{laporanMasuk}/tolak', [LaporanMasukController::class, 'tolak'])->name('admin.laporan.tolak');

    // Kelola Data Kejadian Bencana (index, edit, hapus saja — tambah data lewat form laporan)
    Route::get('/admin/kejadian', [KejadianBencanaController::class, 'index'])->name('admin.kejadian.index');
    Route::get('/admin/kejadian/{kejadianBencana}', [KejadianBencanaController::class, 'show'])->name('admin.kejadian.show');
    Route::get('/admin/kejadian/{kejadianBencana}/edit', [KejadianBencanaController::class, 'edit'])->name('admin.kejadian.edit');
    Route::put('/admin/kejadian/{kejadianBencana}', [KejadianBencanaController::class, 'update'])->name('admin.kejadian.update');
    Route::delete('/admin/kejadian/{kejadianBencana}', [KejadianBencanaController::class, 'destroy'])->name('admin.kejadian.destroy');

    // Kelola Wilayah Rawan Bencana
    Route::get('/admin/wilayah', [WilayahRawanController::class, 'index'])->name('admin.wilayah.index');
    Route::get('/admin/wilayah/buat', [WilayahRawanController::class, 'create'])->name('admin.wilayah.create');
    Route::post('/admin/wilayah', [WilayahRawanController::class, 'store'])->name('admin.wilayah.store');
    Route::get('/admin/wilayah/{wilayahRawan}/edit', [WilayahRawanController::class, 'edit'])->name('admin.wilayah.edit');
    Route::put('/admin/wilayah/{wilayahRawan}', [WilayahRawanController::class, 'update'])->name('admin.wilayah.update');
    Route::delete('/admin/wilayah/{wilayahRawan}', [WilayahRawanController::class, 'destroy'])->name('admin.wilayah.destroy');

    // Kelola Berita
    Route::get('/admin/berita', [BeritaController::class, 'index'])->name('admin.berita.index');
    Route::get('/admin/berita/buat', [BeritaController::class, 'create'])->name('admin.berita.create');
    Route::post('/admin/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
    Route::get('/admin/berita/{berita}/edit', [BeritaController::class, 'edit'])->name('admin.berita.edit');
    Route::put('/admin/berita/{berita}', [BeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/admin/berita/{berita}', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
