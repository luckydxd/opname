<?php

use Illuminate\Support\Facades\Route;
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


Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

// Route::get('/dashboard-user', function () {
//     return view('user.dashboard');
// });

Route::get('user/datatables', [DashboardController::class, 'datatable'])->name('user.datatable');
Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('dashboard_user');
Route::get('/user/opname_add', [DashboardController::class, 'create'])->name('user.addopname');
Route::post('/user/opname_add', [DashboardController::class, 'store'])->name('user.storeopname');

// Route::get('/admin/dashboard', [ScanController::class, 'index'])->name('dashboard_admin');

