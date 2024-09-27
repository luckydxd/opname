<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DataGudangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\DataUserController;
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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
     return redirect()->route('login');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Fadhil
    Route::get('admin/dashboard-datatable', [DashboardAdminController::class, 'datatable'])->name('admin.datatable');
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard_admin');
    Route::get('/admin/detail-opname/{id}', [DashboardAdminController::class, 'show'])->name('StokOpnameDetail');



    //end Fadhil

    // andini
    Route::get('/admin/data-gudang', [DataGudangController::class, 'index'])->name('data_gudang');
    Route::get('/admin/datagudang-add', [DataGudangController::class, 'add'])->name('data_gudang_add');
    Route::post('/form-submit', [DataGudangController::class, 'store'])->name('form.submit');
    Route::get('/admin/datagudang-edit/{id}', [DataGudangController::class, 'edit'])->name('data_gudang_edit');
    Route::post('/admin/datagudang-update/', [DataGudangController::class, 'update'])->name('data_gudang_update');
    Route::get('/admin/datagudang-hapus/{id}', [DataGudangController::class, 'delete'])->name('data_gudang_delete');

    //end andini

    //Legi
    Route::get('/admin/data-produk/', [ProdukController::class, 'index'])->name('data_produk');

    Route::get('/produk/upload', [ProdukController::class, 'importData'])->name('uploadForm_produk');
    // Route::post('/produk/uploadd', [ProdukController::class, 'upload'])->name('upload_produk');
    Route::post('/unggah/produk', [ProdukController::class, 'unggahProduk'])->name('unggah_produk');

    //

    //end Legi



    //Azhar

    Route::get('/admin/stok-barang/', [StokBarangController::class, 'index'])->name('stok_barang');
    Route::get('/admin/stok-barang/import/{id}', [StokBarangController::class, 'importData'])->name('stok_barang_import');
    Route::post('/admin/stok_barang/import-frontend', [StokBarangController::class, 'importFromFrontend'])->name('stok_barang_import_frontend');
    Route::get('/admin/stok_barang/get-stok-barangs', [StokBarangController::class, 'getStokBarangs'])->name('stok-barangs-get');
    Route::get('/admin/stok_barang/edit-stok-barang/{id}', [StokBarangController::class, 'edit'])->name('edit-barang');
    Route::post('/admin/stok_barang/update-stok-barang/{id}', [StokBarangController::class, 'update'])->name('update-barang');
    Route::get('/admin/stok_barang/delete-stok-barang/{id}', [StokBarangController::class, 'destroy'])->name('delete-barang');

    //end Azhar



    // Route::get('/dashboard', function () {
    //     return view('admin.dashboard');
    // });

    //Lucky Route
    Route::get('/admin/data-user', [DataUserController::class, 'index'])->name('data_user');
    Route::get('/admin/datauser-add', [DataUserController::class, 'add'])->name('data_user_add');
    Route::post('/admin/datauser-store', [DataUserController::class, 'store'])->name('data_user_store');
    Route::get('/admin/datauser-edit/{id}', [DataUserController::class, 'edit'])->name('data_user_edit');
    Route::post('/admin/datauser-update', [DataUserController::class, 'update'])->name('data_user_update');
    Route::delete('/admin/datauser-delete/{id}', [DataUserController::class, 'delete'])->name('data_user_delete');

});


Route::middleware(['auth', 'role:user'])->group(function () {
Route::get('user/datatables', [DashboardController::class, 'datatable'])->name('user.datatable');
Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('dashboard_user');
Route::get('/user/opname_add', [DashboardController::class, 'create'])->name('user.addopname');
Route::post('/user/opname_add', [DashboardController::class, 'store'])->name('user.storeopname');
Route::delete('/user/dashboard/{id}', [DashboardController::class, 'destroy'])->name('user.deleteopname');
// Route::get('user/scan/datatables/{id}', [ScanController::class, 'datatable'])->name('user.scan.datatable');
Route::get('/user/scan/{id}', [ScanController::class, 'scan'])->name('user.scan');
Route::get('/user/scan/{id}/datatable', [ScanController::class, 'datatable'])->name('user.scan.datatable');
Route::post('/user/scan/storeqty', [ScanController::class, 'store'])->name('user.storeqty');
Route::delete('/user/scan/{id}', [ScanController::class, 'destroy'])->name('user.deleteqty');
Route::get('/user/scan/edit/{id}', [ScanController::class, 'edit'])->name('user.editqty');
Route::post('/user/scan/update/{id}', [ScanController::class, 'updateqty'])->name('user.update.qty');



});
//end Lucky
