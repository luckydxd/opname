<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\stokOpnameDataTable;
use App\Models\StokBarang;
use App\Models\StokOpname;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StokBarangController extends Controller
{
    public function index(stokOpnameDataTable $dataTable)
    {
        $title = 'Stok Barang';
        return $dataTable->render('admin.StokBarang', compact('title'));
    }

    public function importData($id)
    {
        $title = 'Stok Barang';
        $stokOpname = StokOpname::find($id);
        return view('admin.StokBarang-import', compact('title', 'stokOpname'));
    }

    /**
     * Method untuk mengimpor data dari frontend.
     */
    public function importFromFrontend(Request $request)
    {
        // Validasi data request
        $validator = Validator::make($request->all(), [
            'data' => 'required|array',
            'id_stok_opname' => 'required|exists:stok_opnames,id'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => 'Data tidak valid!', 'errors' => $validator->errors()], 422);
        }
    
        $data = $request->input('data');
        $id_stok_opname = $request->input('id_stok_opname');
        $responseMessages = []; // Menyimpan pesan untuk setiap baris
    
        try {
            // Iterasi data dan simpan ke dalam database
            foreach ($data as $row) {
                // Validasi data per baris
                $rowValidator = Validator::make($row, [
                    'Kode' => 'required',
                    'Nama' => 'required',
                    'Kuantitas' => 'required'
                ]);
    
                if ($rowValidator->fails()) {
                    $responseMessages[] = "Baris dengan Kode " . $row['Kode'] . " tidak valid.";
                    continue; // Jika ada kesalahan di baris tertentu, lewati baris tersebut
                }
    
                // Cek apakah produk dengan kode yang sama sudah ada
                $existingProduct = StokBarang::where([
                    ['id_stok_opname', '=', $id_stok_opname],
                    ['kode_produk', '=', $row['Kode']]
                ])->first();
                
    
                if ($existingProduct) {
                    // Jika produk sudah ada, tambahkan pesan dan lanjutkan ke baris berikutnya
                    $responseMessages[] = "Kode produk " . $row['Kode'] . " sudah ada.";
                    \Log::info("Kode produk sudah ada: " . $row['Kode']); // Tambahkan log untuk debugging
                    continue;
                }
    
                // Simpan stok barang baru
                StokBarang::create([
                    'kode_produk' => $row['Kode'], // Berdasarkan 'kode_produk' produk yang unik
                    'id_stok_opname' => $id_stok_opname,
                    'nama' => $row['Nama'],
                    'kuantitas' => $row['Kuantitas']
                ]);
    
                $responseMessages[] = "Kode produk " . $row['Kode'] . " berhasil ditambahkan.";
            }
    
            // Kembalikan semua pesan sebagai respons
            return response()->json(['message' => 'Proses impor selesai.', 'details' => $responseMessages], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
    

 
function getStokBarangs(Request $request)
    {
       
        if ($request->ajax()) {
            $data = StokBarang::with(['produk', 'stokOpname'])->where('id_stok_opname', $request->id_stok_opname)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('produk', function ($row) {
                    return $row->produk->nama ?? 'N/A'; // Mengakses nama produk dari relasi
                })
                ->addColumn('stok_opname', function ($row) {
                    return $row->stokOpname->nama ?? 'N/A'; // Mengakses nama stok opname dari relasi
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-barang', $row->id);
                    $deleteUrl = route('delete-barang', $row->id);
                    $iconGear = GEAR_SVG;
                    $iconTrash = TRASH_SVG;
                    $btn = "<a href='{$editUrl}' class='btn btn-warning btn-sm'>".$iconGear."</a>
                    <a href='{$deleteUrl}' class='btn btn-danger btn-sm'>".$iconTrash."</a>";
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit($id){
        $title = 'Stok Barang';
        $stokBarang = StokBarang::find($id);
        return view('admin.StokBarang-edit', compact('title', 'stokBarang'));
    }

    public function update(Request $request, $id){
        $stokBarang = StokBarang::find($id);
        $stokBarang->update($request->all());
        return redirect()->route('stok_barang_import',  $stokBarang->id_stok_opname)->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id){
        $stokBarang = StokBarang::find($id);
        $stokBarang->delete();
        return redirect()->route('stok_barang_import',  $stokBarang->id_stok_opname)->with('success', 'Data berhasil dihapus');
    }
}
