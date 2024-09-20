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

    public function datatable($id)
    {
        $data = DetailStokOpname::select([
                'detail_stok_opnames.id',
                'produks.kode as kode',
                'produks.nama as nama',
                'detail_stok_opnames.fisik_all as fisik_all'
            ])
            ->join('produks', 'produks.kode', '=', 'detail_stok_opnames.kode_produk')
            ->where('detail_stok_opnames.id_stok_opname', $id);  // Menambahkan kondisi filter
    
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
            'kode_produk' => 'required|exists:produks,kode',
            'fisik_all' => 'required|numeric',
        ]);
    
        DetailStokOpname::create([
            'id_stok_opname' => $validated['id_stok_opname'],
            'kode_produk' => $validated['kode_produk'],
            'fisik_all' => $validated['fisik_all'],
            'kuantitas' => 0, 
            'selisih' => 0,
            'keterangan' => null,
        ]);
    
        return redirect()->route('dashboard_user')->with('success', 'Data berhasil disimpan.');
    }
    

public function scan($id)
{
    $stokOpname = StokOpname::findOrFail($id);
    $produks = Produk::all();
    return view('user.scan', compact('stokOpname','produks'));
}

public function edit($id)
{
    
    $DetailStokOpname = DetailStokOpname::findOrFail($id);

    // Join with 'produks' to get product details like kode and nama
    $item = DetailStokOpname::select([
        'detail_stok_opnames.id',
        'produks.kode as kode',
        'produks.nama as nama',
        'detail_stok_opnames.fisik_all as fisik_all',
        'detail_stok_opnames.id_stok_opname'
    ])
    ->join('produks', 'produks.kode', '=', 'detail_stok_opnames.kode_produk')
    ->where('detail_stok_opnames.id', $id) // Use the specific record's ID here
    ->first(); 

    return view('user.editqty', compact('DetailStokOpname', 'item')); // Pass both $DetailStokOpname and $item

}

public function updateqty(Request $request, $id)
{
    $request->validate([
        'id_stok_opname' => 'required|exists:stok_opnames,id',
        'fisik_all' => 'required|numeric',
    ]);

    $DetailStokOpname = DetailStokOpname::findOrFail($id);
    $DetailStokOpname->update([
        'fisik_all' => $request->fisik_all,
    ]);

    return redirect()->route('user.scan', $DetailStokOpname->id_stok_opname)
    ->with('success', 'Data berhasil diperbarui.');
}

public function destroy($id)
{
    $DetailStokOpname = DetailStokOpname::find($id);

    $DetailStokOpname->delete();

    return response()->json(['success' => 'Stok Opname berhasil dihapus.']);
}


}
