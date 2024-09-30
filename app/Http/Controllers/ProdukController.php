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

    // public function unggahProduk(Request $request)
    // {
    //     // Validasi data request
    //     $validator = Validator::make($request->all(), [
    //         'data' => 'required|array', // Pastikan ada array data yang dikirim
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['message' => 'Data tidak valid!', 'errors' => $validator->errors()], 422);
    //     }

    //     $data = $request->input('data');

    //     try {
    //         // Iterasi data dan simpan ke dalam database
    //         foreach ($data as $row) {
                
    //             // Validasi data per baris
    //             $rowValidator = Validator::make($row, [
    //                 'Kode' => 'required', // Kode produk harus ada
    //                 'Nama' => 'required', // Nama produk harus ada
    //             ]);

    //             if ($rowValidator->fails()) {
    //                 continue; // Jika ada kesalahan di baris tertentu, lewati baris tersebut
    //             }

    //             // Simpan atau perbarui produk berdasarkan 'Kode' produk yang unik
    //             Produk::Create(
    //                 [
    //                     'kode' => $row['Kode'], // Berdasarkan kode produk yang unik
                    
    //                     'nama' => $row['Nama'], // Nama produk
    //                 ]
    //             );
    //         }

    //         return response()->json(['message' => 'Produk berhasil diunggah!'], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Beberapa Produk Sudah tersimpan Sebelumnya'], 500);
    //     }
    // }

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
        $duplicateMessages = []; // Array untuk menyimpan pesan duplikat
    
        try {
            // Iterasi data dan simpan ke dalam database
            foreach ($data as $index => $row) {
                
                // Validasi data per baris
                $rowValidator = Validator::make($row, [
                    'Kode' => 'required', // Kode produk harus ada
                    'Nama' => 'required', // Nama produk harus ada
                ]);
    
                if ($rowValidator->fails()) {
                    continue; // Jika ada kesalahan di baris tertentu, lewati baris tersebut
                }
    
                // Cek jika kode sudah ada di database
                $existingProductByCode = Produk::where('kode', $row['Kode'])->first();
                if ($existingProductByCode) {
                    $duplicateMessages[] = 'Baris ' . ($index + 2) . ': Kode "' . $row['Kode'] . '" sudah ada.'; // Pesan duplikat
                    continue; // Jika ada kode duplikat, lewati baris ini
                }
    
                // Cek jika nama sudah ada di database
                $existingProductByName = Produk::where('nama', $row['Nama'])->first();
                if ($existingProductByName) {
                    $duplicateMessages[] = 'Baris ' . ($index + 2) . ': Nama "' . $row['Nama'] . '" sudah ada.'; // Pesan duplikat
                    continue; // Jika ada nama duplikat, lewati baris ini
                }
    
                // Simpan produk jika tidak ada duplikat
                Produk::create([
                    'kode' => $row['Kode'], // Berdasarkan kode produk yang unik
                    'nama' => $row['Nama'], // Nama produk
                ]);
            }
    
            // Cek jika ada kode atau nama yang duplikat
            if (!empty($duplicateMessages)) {
                return response()->json(['message' => 'Beberapa Produk Sudah Tersimpan Sebelumnya:', 'duplicates' => $duplicateMessages], 400);
            }
    
            return response()->json(['message' => 'Produk berhasil diunggah!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
    

    public function delete($id){
        $produk = Produk::find($id);
        if($produk){
            $produk->delete();
            return redirect()->route('data_produk')->with('success', 'Data berhasil dihapus');
        }else {
            return redirect()->route('data_produk')->with('error', 'Data tidak ditemukan');
        }
    }
    public function edit($id){
        $title = 'Data produk';
        $produk = Produk::find($id);
        return view('admin.DataProduk-edit', compact('title', 'produk'));
    }
   
    public function update(Request $request)
{
    // Validasi input
    
    $request->validate([
        'nama' => 'required|string|max:255',
        'kode' => 'required|string|max:50',
        'id' => 'required|integer', 
    ]);

    // Ambil model berdasarkan ID yang diterima
    $produk = Produk::find($request->id);

    if ($produk) {
        // Update data produk
        $produk->nama = $request->nama;
        $produk->kode = $request->kode; // Update kolom kode
        $produk->save();
        

        // Redirect dengan pesan sukses
        return redirect()->route('data_produk')->with('success', 'Data berhasil diupdate');
    } else {
        // Jika tidak ditemukan, bisa mengarahkan kembali dengan pesan error
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }
}

   
 


}
