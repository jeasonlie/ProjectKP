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
use App\Http\Controllers\API\API_BarangMasukController;
use App\Http\Controllers\API\API_BarangKeluarController;

Route::get('/barang', [API_BarangController::class,'index']);
Route::patch('/barang/{id}', [API_BarangController::class,'update']);
Route::post('/barang', [API_BarangController::class,'store']);
Route::delete('/barang/{id}', [API_BarangController::class,'destroy']);

Route::get('/barangmasuk', [API_BarangMasukController::class,'index']);
Route::patch('/barangmasuk/{id}', [API_BarangMasukController::class,'update']);
Route::post('/barangmasuk', [API_BarangMasukController::class,'store']);
Route::delete('/barangmasuk/{id}', [API_BarangMasukController::class,'destroy']);

Route::get('/barangkeluar', [API_BarangKeluarController::class,'index']);
Route::patch('/barangkeluar/{id}', [API_BarangKeluarController::class,'update']);
Route::post('/barangkeluar', [API_BarangKeluarController::class,'store']);
Route::delete('/barangkeluar/{id}', [API_BarangKeluarController::class,'destroy']);
