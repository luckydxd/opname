<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\DataProdukDataTable;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index(DataProdukDataTable $dataTable)
    {
        $title = 'Data Produk';
        return $dataTable->render('admin.DataProduk', compact('title'));
    }

    public function uploadForm()
    {
        $title = 'Data Produk';
        $products = Produk::all(); // Ambil semua produk dari database
        return view('admin.UploadDataProduk', compact('title', 'products'));
    }
}
