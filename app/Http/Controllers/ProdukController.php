<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\DataProdukDataTable;

class ProdukController extends Controller
{
    public function index(DataProdukDataTable $dataTable)
    {
        $title = 'Data Produk';
        return $dataTable->render('admin.DataProduk', compact('title'));
    }
}
