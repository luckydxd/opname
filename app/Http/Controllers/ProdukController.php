<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\DataTables\DataProdukDataTable;
use Illuminate\Support\Facades\Validator;

use App\Models\Produk;

class ProdukController extends Controller
{
    public function index(DataProdukDataTable $dataTable)
    {
        $title = 'Data Produk';
        return $dataTable->render('admin.DataProduk', compact('title'));
    }

    public function importData()
    {
        $title = 'Data Produk';
        
        return view('admin.UploadDataProduk', compact('title'));
    }

    public function unggahProduk(Request $request)
    {
        // Validasi data request
        $validator = Validator::make($request->all(), [
            'data' => 'required|array', // Pastikan ada array data yang dikirim
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Data tidak valid!', 'errors' => $validator->errors()], 422);
        }

        $data = $request->input('data');

        try {
            // Iterasi data dan simpan ke dalam database
            foreach ($data as $row) {
                // Validasi data per baris
                $rowValidator = Validator::make($row, [
                    'Kode' => 'required|string', // Kode produk harus ada
                    'Nama' => 'required|string', // Nama produk harus ada
                ]);

                if ($rowValidator->fails()) {
                    continue; // Jika ada kesalahan di baris tertentu, lewati baris tersebut
                }

                // Simpan atau perbarui produk berdasarkan 'Kode' produk yang unik
                Produk::updateOrCreate(
                    [
                        'kode' => $row['Kode'], // Berdasarkan kode produk yang unik
                    ],
                    [
                        'nama' => $row['Nama'], // Nama produk
                    ]
                );
            }

            return response()->json(['message' => 'Produk berhasil diunggah!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

   
 


}
