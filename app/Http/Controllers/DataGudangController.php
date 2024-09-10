<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\DataGudangDataTable;;
use App\Models\Gudang;

class DataGudangController extends Controller
{
    public function index(DataGudangDataTable $dataTable)
    {
        $title = 'Data Gudang';
        return $dataTable->render('admin.DataGudang', compact('title'));
    }

    public function add(){
        $title = 'Data Gudang';
        return view('admin.DataGudang-Add', compact('title'));
    }

    public function store(Request $request){
        Gudang::create([
            'nama'=>$request->nama,
        ]);
        return redirect()->route('data_gudang');
    }
    public function edit($id){
        $title = 'Data Gudang';
        $gudang = Gudang::find($id);
        return view('admin.DataGudang-edit', compact('title', 'gudang'));
    }
    public function update(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
    ]);

    // Ambil model berdasarkan ID yang diterima
    $gudang = Gudang::find($request->id);

    if ($gudang) {
        // Update data gudang
        $gudang->nama = $request->nama;
        $gudang->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    return redirect()->back()->with('error', 'Data tidak ditemukan');
}
}
