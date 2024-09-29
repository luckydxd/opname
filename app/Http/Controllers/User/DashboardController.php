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
        $user = auth()->user(); 
        $data = StokOpname::with('gudang')->where('user_id', $user->id)->select('stok_opnames.*');
        return DataTables::of($data)->make(true);
    }

    public function create()
    {
        $gudangs = Gudang::all();

        $currentYear = date('y');
        $currentMonth = date('m');
        $lastStokOpname = StokOpname::whereMonth('tanggal_opname', $currentMonth)->orderBy('id', 'desc')->first();    
        $nextOrder = $lastStokOpname ? sprintf('%02d', intval(substr($lastStokOpname->nomor_dokumen, -2)) + 1) : '01';
    
        // Auto Generate nomor dokumen dengan format SOP/{Bulan}/{Urutan}
        $nomorDokumen = 'SOP/' . $currentYear .'/'. $currentMonth . '/' . $nextOrder;
    
        return view('user.addopname', compact('gudangs','nomorDokumen'));
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
    
        return redirect()->route('dashboard_user')->with('success', 'Data stok opname berhasil ditambahkan');
}

public function edit($id)
{
    $stokOpname = StokOpname::findOrFail($id);
    return view('user.scan', compact('stokOpname'));
}

public function destroy($id)
{
    $stokOpname = StokOpname::find($id);

    // Pengecekan
    if (!$stokOpname) {
        return redirect()->back()->with('error', 'Stok Opname tidak ditemukan.');
    }

    $stokOpname->stokBarangs()->delete();
    $stokOpname->detailStokOpnames()->delete();
    $stokOpname->delete();
    
    return response()->json(['success' => 'Item deleted successfully.']);
}

}