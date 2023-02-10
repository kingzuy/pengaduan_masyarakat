<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', [HomeController::class, 'index']);

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/404', function () {
    if (auth()->user()->role == 'petugas') {
        return redirect()->route('author.home');
    } else if (auth()->user()->role == 'admin') {
        return redirect()->route('admin.dashboard');
    } else if (auth()->user()->role == 'user') {
        return redirect()->route('user.home');
    } else {
        return redirect()->route('login');
    }
});

Route::middleware('auth', 'role:user')->group(function () {
    Route::get('/pengaduan', [PengaduanController::class, 'index']);
    Route::post('/pengaduan', [PengaduanController::class, 'create'])->name('post.pengaduan');
    Route::get('/home', [UserController::class, 'index'])->name('user.home');
});

Route::middleware('auth')->name('profile.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('destroy');
});

require __DIR__ . '/auth.php';

require __DIR__ . '/admin.php';
