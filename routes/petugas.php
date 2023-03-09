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
| Web Routes Petugas
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


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


    Route::get('/petugas/profile', [AdminController::class, 'edit'])->name('profile.edit');
    Route::patch('/petugas/profile', [AdminController::class, 'update'])->name('profile.update');
    Route::delete('/petugas/profile', [AdminController::class, 'destroy'])->name('profile.destroy');
});
