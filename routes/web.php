<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\TanggapanController;
use App\Http\Controllers\Admin\VerifikasiController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/lapor', function () {
        return view('laporan.form');
    })->name('laporan.form');

    Route::post('/lapor', [LaporanController::class, 'store'])->name('laporan.store');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('/petugas', PetugasController::class);

    Route::get('/pengaduan', [VerifikasiController::class, 'index'])->name('admin.verifikasi.index');
    Route::get('/pengaduan/{id}', [VerifikasiController::class, 'show'])->name('admin.verifikasi.show');
    Route::put('/pengaduan/{id}', [VerifikasiController::class, 'update'])->name('admin.verifikasi.update');

    Route::put('/pengaduan/{id}/tanggapan', [VerifikasiController::class, 'updateTanggapan'])->name('admin.tanggapan.update');

    Route::get('/laporan', [DashboardController::class, 'laporan'])->name('admin.laporan.index');
    Route::get('/laporan/export/pdf', [DashboardController::class, 'exportPdf'])->name('admin.laporan.export.pdf');
    Route::get('/laporan/export/excel', [DashboardController::class, 'exportExcel'])->name('admin.laporan.export.excel');
});
