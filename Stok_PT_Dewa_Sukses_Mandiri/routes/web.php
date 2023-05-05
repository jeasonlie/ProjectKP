<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\BarangController;
use App\Http\Controllers\LaporanBarangController;
use App\Http\Controllers\UserController;

Route::get('/barang', [BarangController::class,'index']);
Route::get('/laporanbarang', [LaporanBarangController::class,'index']);
Route::get('/admin', [UserController::class,'index']);