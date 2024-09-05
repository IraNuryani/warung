<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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



Route::get('/kategori', [ItemKategoriController::class, 'index']); // Get all categories
Route::post('/kategori', [ItemKategoriController::class, 'store']); // Create a new category
// Route::get('/item-kategori/{id}', [ItemKategoriController::class, 'show']); // Get a specific category by ID
// Route::put('/item-kategori/{id}', [ItemKategoriController::class, 'update']); // Update a specific category by ID
// Route::delete('/item-kategori/{id}', [ItemKategoriController::class, 'destroy']); // Delete a specific category by ID

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});