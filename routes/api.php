<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\ItemKategoriController;

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



Route::get('/kategori', [ItemKategoriController::class, 'index']); 
Route::post('/kategori', [ItemKategoriController::class, 'store']); 
Route::put('/kategori/{id}', [ItemKategoriController::class, 'update']); 
Route::get('/kategori/{id}', [ItemKategoriController::class, 'show']); 
Route::delete('/kategori/{id}', [ItemKategoriController::class, 'destroy']); 

Route::get('/item', [ItemController::class, 'index']); 
Route::post('/item', [ItemController::class, 'store']); 
Route::get('/item/{id}', [ItemController::class, 'show']);
Route::put('/item/{id}', [ItemController::class, 'update']); 
Route::delete('/item/{id}', [ItemController::class, 'destroy']);

Route::get('/pembelian', [PembelianController::class, 'index']); 
Route::post('/pembelian', [PembelianController::class, 'store']); 
Route::get('/pembelian/{id}', [PembelianController::class, 'show']);
Route::put('/pembelian/{id}', [PembelianController::class, 'update']); 
Route::delete('/pembelian/{id}', [PembelianController::class, 'destroy']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});