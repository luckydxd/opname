<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\StokOpname;
use App\Models\Gudang;


class DashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    public function datatable(Request $request)

    {
        $data = StokOpname::with('gudang')->select('stok_opnames.*');
        return DataTables::of($data)->make(true);
    }

    public function create()
    {
        $gudangs = Gudang::all();

        return view('user.addopname', compact('gudangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_dokumen' => 'required|string|max:255',
            'id_gudang' => 'required|exists:gudangs,id',
            'tanggal_opname' => 'required|date',
        ]);
    
             StokOpname::create([
            'nomor_dokumen' => $request->nomor_dokumen,
            'id_gudang' => $request->id_gudang,
            'tanggal_opname' => $request->tanggal_opname,
        ]);
    
        return redirect()->route('dashboard_user')->with('success', 'Data berhasil ditambahkan');
}

}