<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\StokOpname;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    public function datatable(Request $request)

    {
        $data = StokOpname::query();
        return DataTables::of($data)->make(true);
    }
}
