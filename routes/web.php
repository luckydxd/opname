<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DataGudangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StokOpnameController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ScanController;

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


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
Route::get('/admin/detail-opname/{id}', [DashboardAdminController::class, 'show'])->name('StokOpnameDetail');



//end Fadhil

// andini
Route::get('/admin/data-gudang', [DataGudangController::class, 'index'])->name('data_gudang');
Route::get('/admin/datagudang-add',[DataGudangController::class, 'add'])->name('data_gudang_add');
Route::post('/form-submit', [DataGudangController::class, 'store'])->name('form.submit');
Route::get('/admin/datagudang-edit/{id}',[DataGudangController::class, 'edit'])->name('data_gudang_edit');
Route::post('/admin/datagudang-update/',[DataGudangController::class, 'update'])->name('data_gudang_update');


//end andini

//Legi
Route::get('/admin/data-produk/', [ProdukController::class, 'index'])->name('data_produk');
Route::get('/produk/upload', [ProdukController::class, 'importData'])->name('uploadForm_produk');
// Route::post('/produk/uploadd', [ProdukController::class, 'upload'])->name('upload_produk');
Route::post('/unggah/produk', [ProdukController::class, 'importData'])->name('unggah_produk');

// 
//end Legi



//Azhar

Route::get('/admin/stok-opname/', [StokOpnameController::class, 'index'])->name('stok_opname');
Route::get('/admin/stok-opname/import/{id}', [StokOpnameController::class, 'importData'])->name('stok_opname_import');

//end Azhar



Route::get('/dashboard', function () {
    return view('admin.dashboard');
});



//Lucky Route

Route::get('user/datatables', [DashboardController::class, 'datatable'])->name('user.datatable');
Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('dashboard_user');
Route::get('/user/opname_add', [DashboardController::class, 'create'])->name('user.addopname');
Route::post('/user/opname_add', [DashboardController::class, 'store'])->name('user.storeopname');
Route::delete('/user/dashboard/{id}', [DashboardController::class, 'destroy'])->name('user.deleteopname');
Route::get('user/scan/datatables', [ScanController::class, 'datatable'])->name('user.scan.datatable');
Route::get('/user/scan/{id}', [ScanController::class, 'edit'])->name('user.scan');
Route::post('/user/scan/storeqty', [ScanController::class, 'store'])->name('user.storeqty');
Route::delete('/user/scan/{id}', [DashboardController::class, 'destroy'])->name('user.deleteqty');



//end Lucky