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
                    continue; // Jika ada kesalahan di baris tertentu, lewati baris tersebut
                }

                // Simpan atau perbarui stok barang berdasarkan 'Kode' produk yang unik
                StokBarang::Create(
                    [
                        'kode_produk' => $row['Kode'], // Berdasarkan 'kode_produk' produk yang unik
                        'id_stok_opname' => $id_stok_opname,
                        'nama' => $row['Nama'],
                        'kuantitas' => $row['Kuantitas']
                    ]
                );
            }

            return response()->json(['message' => 'Data stok berhasil diimpor!'], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function getStokBarangs(Request $request)
    {
        if ($request->ajax()) {
            $data = StokBarang::with(['produk', 'stokOpname'])->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('produk', function ($row) {
                    return $row->produk->nama ?? 'N/A'; // Mengakses nama produk dari relasi
                })
                ->addColumn('stok_opname', function ($row) {
                    return $row->stokOpname->nama ?? 'N/A'; // Mengakses nama stok opname dari relasi
                })
                ->make(true);
        }
    }
}
