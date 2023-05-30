<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\API\API_BarangController;
use App\Http\Controllers\API\API_LaporanBarangController;

Route::get('/barang', [API_BarangController::class,'index']);
Route::post('/barang/{id}', [API_BarangController::class,'update']);
Route::post('/barang', [API_BarangController::class,'store']);
Route::delete('/barang/{id}', [API_BarangController::class,'destroy']);

Route::get('/transaksibarang', [API_LaporanBarangController::class,'index']);
Route::post('/transaksibarang/{id}', [API_LaporanBarangController::class,'update']);
Route::post('/transaksibarang', [API_LaporanBarangController::class,'store']);
Route::delete('/transaksibarang/{id}', [API_LaporanBarangController::class,'destroy']);
