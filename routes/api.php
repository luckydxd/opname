<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// In routes/api.php
use App\Http\Controllers\StokBarangController;

Route::post('/admin/stok_barang/import-frontend', [StokBarangController::class, 'importFromFrontend'])->name('stok_barang_import_frontend');


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
