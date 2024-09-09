<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\stokOpnameDashboardDataTable;


class DashboardAdminController extends Controller
{
    public function index(stokOpnameDashboardDataTable $dataTable)
    {
        $title = 'Dashboard';
        return $dataTable->render('admin.Dashboard', compact('title'));
    }

    public function detailOpname() {}
}
