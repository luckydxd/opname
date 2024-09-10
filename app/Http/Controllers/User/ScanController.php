<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\StokOpname;

class ScanController extends Controller
{
    public function index()
    {
        return view('user.scan');
    }
}
