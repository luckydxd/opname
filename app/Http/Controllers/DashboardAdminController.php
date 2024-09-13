<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\stokOpnameDashboardDataTable;
use App\DataTables\DetailOpnameDataTable; // Tambahkan ini untuk detailOpname
use App\Models\StokOpname; // Model yang digunakan
// use APP\DataTables\stokOpnameDataTable;

class DashboardAdminController extends Controller
{
    public function index(stokOpnameDashboardDataTable $dataTable)
    {
        $title = 'Dashboard';
        return $dataTable->render('admin.Dashboard', compact('title'));
    }

    // Menampilkan detail Opname
    // public function show(DetailOpnameDataTable $dataTable, $id)
    // {
    //     $stokOpname = StokOpname::findOrFail($id); // Mengambil detail opname berdasarkan ID
    //     return $dataTable->with('id', $stokOpname->id)->render('admin.detailOpname', compact('stokOpname'));
    // }

    public function show($id)
    {
        $title = 'Dashboard';
        $stokOpname = StokOpname::findOrFail($id);

        // Buat instance dari DataTable dan masukkan id_stok_opname
        $dataTable = new DetailOpnameDataTable($id);

        return $dataTable->render('admin.DetailOpname', compact('stokOpname', 'title'));
    }
}
