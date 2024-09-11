<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\StokBarang;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\DetailStokOpname;
use App\Models\StokOpname;


class ScanController extends Controller
{
    public function index()
    {
        
        return view('user.scan');
    }

    public function datatable(Request $request)

    {
        $data = DetailStokOpname::select([
            'detail_stok_opnames.id',
            'produks.kode as kode',
            'produks.nama as nama',
            'detail_stok_opnames.fisik_all as fisik_all'
        ])
        ->join('produks', 'produks.id', '=', 'detail_stok_opnames.id_produk');

        return DataTables::of($data)->make(true);
    }

    public function create()
    {
        $produks = Produk::all();
        $fisik_alls = DetailStokOpname::where('fisik_all');

        return view('user.scan',compact('produks','fisik_alls'));

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_stok_opname' => 'required|exists:stok_opnames,id',
            'id_produk' => 'required|exists:produks,id',
            'fisik_all' => 'required|numeric',
        ]);
    
        DetailStokOpname::create([
            'id_stok_opname' => $validated['id_stok_opname'],
            'id_produk' => $validated['id_produk'],
            'fisik_all' => $validated['fisik_all'],
            'kuantitas' => 0, // Sesuaikan jika ada logika perhitungan lain
            'selisih' => 0,
            'keterangan' => null,
        ]);
    
        return redirect()->route('dashboard_user')->with('success', 'Data berhasil disimpan.');
    }
    

public function edit($id)
{
    $stokOpname = StokOpname::findOrFail($id);
    $produks = Produk::all();
    return view('user.scan', compact('stokOpname','produks'));
}

public function destroy($id)
{
    $stokOpname = StokOpname::find($id);

    // Hapus data terkait dari detail stok opname terlebih dahulu (jika ada)
    if ($stokOpname->detailStokOpnames()->count() > 0) {
        $stokOpname->detailStokOpnames()->delete();
    }

    // Menghapus stok opname setelah detailnya dihapus
    $stokOpname->delete();

    return response()->json(['success' => 'Stok Opname berhasil dihapus.']);
}


}
