<?php

use App\Http\Controllers\AdminController;
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
    Route::get('/admin/profile', [AdminController::class, 'edit'])->name('edit');
    Route::patch('/admin/profile', [AdminController::class, 'update'])->name('update');
    Route::delete('/admin/profile', [AdminController::class, 'destroy'])->name('destroy');
});
