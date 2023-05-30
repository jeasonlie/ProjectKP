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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/barang', [BarangController::class,'index']);
    Route::get('/transaksibarang', [LaporanBarangController::class,'index']);
    Route::get('/transaksibarang/{detail}', [LaporanBarangController::class,'show']);
    Route::get('/user', [UserController::class,'index']);
    Route::post('/user',[UserController::class,'store'])->name('user.store');
});

require __DIR__.'/auth.php';
