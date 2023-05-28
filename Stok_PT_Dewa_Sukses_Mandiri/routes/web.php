<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LaporanBarangController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/barang', [BarangController::class,'index']);
    Route::get('/laporanbarang', [LaporanBarangController::class,'index']);
    Route::get('/laporanbarang/{detail}', [LaporanBarangController::class,'show']);
    Route::get('/user', [UserController::class,'index']);
    Route::post('/user',[UserController::class,'store'])->name('user.store');
});

require __DIR__.'/auth.php';
