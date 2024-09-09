<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DataGudangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StokOpnameController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ScanController;


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

// Fadhil
Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard_admin');

//end Fadhil

// andini
Route::get('/admin/data-gudang', [DataGudangController::class, 'index'])->name('data_gudang');


//end andini

//Legi
Route::get('/admin/data-produk/', [ProdukController::class, 'index'])->name('data_produk');

//end Legi



//Azhar

Route::get('/admin/stok-opname/', [StokOpnameController::class, 'index'])->name('stok_opname');
Route::get('/admin/stok-opname/import/{id}', [StokOpnameController::class, 'importData'])->name('stok_opname_import');

//end Azhar



Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

// Route::get('/dashboard-user', function () {
//     return view('user.dashboard');
// });

Route::get('user/datatables', [DashboardController::class, 'datatable'])->name('user.datatable');
Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('dashboard_user');

// Route::get('/admin/dashboard', [ScanController::class, 'index'])->name('dashboard_admin');
