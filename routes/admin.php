<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\PDFController;
use App\Http\Middleware\Role;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes Admin
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/admin/petugas', [AdminController::class, 'petugas'])->name('petugas');

    Route::get('/admin/masyarakat', [MasyarakatController::class, 'index'])->name('masyarakat');

    Route::post('/admin/petugas', [AdminController::class, 'tambahPetugas'])->name('post');
    Route::patch('/admin/petugas/{id}', [AdminController::class, 'editPetugas'])->name('edit');
    Route::delete('/admin/petugas/{id}', [AdminController::class, 'deletePetugas'])->name('delete');

    Route::get('/admin/laporan', [PengaduanController::class, 'index'])->name('pengaduan');
    Route::patch('/admin/laporan/{id}', [PengaduanController::class, 'upStatus'])->name('pengaduan.updateStatus');
    Route::delete('/admin/laporan/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
    Route::post('/admin/laporan', [TanggapanController::class, 'proses'])->name('pengaduan.post');

    Route::get('/admin/rekap', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/admin/rekap-pdf', [PDFController::class, 'pengaduan'])->name('laporan.rekap');
    Route::get('/admin/preview-pdf', [PDFController::class, 'previewPdf'])->name('laporan.previewPdf');

    Route::get('/admin/profile', [AdminController::class, 'edit'])->name('profile.edit');
    Route::patch('/admin/profile', [AdminController::class, 'update'])->name('profile.update');
    Route::delete('/admin/profile', [AdminController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:petugas'])->name('admin.')->group(function () {
    Route::get('/petugas', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/petugas/masyarakat', [MasyarakatController::class, 'index'])->name('masyarakat');

    Route::post('/petugas/petugas', [AdminController::class, 'tambahPetugas'])->name('post');
    Route::patch('/petugas/petugas/{id}', [AdminController::class, 'editPetugas'])->name('edit');
    Route::delete('/petugas/petugas/{id}', [AdminController::class, 'deletePetugas'])->name('delete');

    Route::get('/petugas/laporan', [PengaduanController::class, 'index'])->name('pengaduan');
    Route::patch('/petugas/laporan/{id}', [PengaduanController::class, 'upStatus'])->name('pengaduan.updateStatus');
    Route::delete('/petugas/laporan/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
    Route::post('/petugas/laporan', [TanggapanController::class, 'proses'])->name('pengaduan.post');
});
