<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\AuthPetugasAdmin\AdminLoginController;
use App\Http\Controllers\AuthPetugasAdmin\PetugasLoginController;
use App\Http\Controllers\Petugas\PetugasDashboardController;
use App\Http\Controllers\Petugas\PetugasVerifikasiController;



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth:web'])->group(function () {
    Route::get('/lapor', fn() => view('laporan.form'))->name('laporan.form');
    Route::post('/lapor', [LaporanController::class, 'store'])->name('laporan.store');
});

Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
Route::get('/admin', function () {
    return redirect()->route('admin.login');
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/petugas', PetugasController::class);

    Route::get('/pengaduan', [VerifikasiController::class, 'index'])->name('admin.verifikasi.index');
    Route::get('/pengaduan/{id}', [VerifikasiController::class, 'show'])->name('admin.verifikasi.show');
    Route::put('/pengaduan/{id}', [VerifikasiController::class, 'update'])->name('admin.verifikasi.update');
    Route::put('/pengaduan/{id}/tanggapan', [VerifikasiController::class, 'updateTanggapan'])->name('admin.tanggapan.update');

    Route::get('/laporan', [DashboardController::class, 'laporan'])->name('admin.laporan.index');
    Route::get('/laporan/export/pdf', [DashboardController::class, 'exportPdf'])->name('admin.laporan.export.pdf');
    Route::get('/laporan/export/excel', [DashboardController::class, 'exportExcel'])->name('admin.laporan.export.excel');
});

Route::get('/petugas/login', [PetugasLoginController::class, 'showLoginForm'])->name('petugas.login');
Route::post('/petugas/login', [PetugasLoginController::class, 'login']);
Route::get('/petugas', function () {
    return redirect()->route('petugas.login');
});

Route::prefix('petugas')->middleware('auth:petugas')->group(function () {
    Route::post('/logout', [PetugasLoginController::class, 'logout'])->name('petugas.logout');
    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('petugas.dashboard');
    Route::get('/pengaduan', [PetugasDashboardController::class, 'pengaduan'])->name('petugas.pengaduan');
    Route::post('/pengaduan/{id}/tanggapan', [PetugasDashboardController::class, 'tanggapi'])->name('petugas.tanggapan');

    Route::get('/pengaduan', [PetugasVerifikasiController::class, 'index'])->name('petugas.verifikasi.index');
    Route::put('/pengaduan/{id}', [PetugasVerifikasiController::class, 'update'])->name('petugas.verifikasi.update');
    Route::put('/pengaduan/{id}/tanggapan', [PetugasVerifikasiController::class, 'updateTanggapan'])->name('petugas.tanggapan.update');
});