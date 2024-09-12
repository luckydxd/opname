<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\stokOpnameDataTable;

class StokOpnameController extends Controller
{
    public function index(stokOpnameDataTable $dataTable)
    {
        $title = 'Stok Opname';
        return $dataTable->render('admin.StokOpname', compact('title'));
    }

    public function importData()
    {
        $title = 'Stok Opname';
        return view('admin.StokOpname-import', compact('title'));
    }
}
