<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\DataGudangDataTable;;

class DataGudangController extends Controller
{
    public function index(DataGudangDataTable $dataTable)
    {
        $title = 'Data Gudang';
        return $dataTable->render('admin.DataGudang', compact('title'));
    }
}
