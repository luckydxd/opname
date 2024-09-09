<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DataGudangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StokOpnameController;

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


Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard_admin');
Route::get('/admin/data-gudang', [DataGudangController::class, 'index'])->name('data_gudang');
Route::get('/admin/data-produk/', [ProdukController::class, 'index'])->name('data_produk');
Route::get('/admin/stok-opname/', [StokOpnameController::class, 'index'])->name('stok_opname');
