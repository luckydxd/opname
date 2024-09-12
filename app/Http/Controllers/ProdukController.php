<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\DataTables\DataProdukDataTable;
use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Models\Produk;

class ProdukController extends Controller
{
    public function index(DataProdukDataTable $dataTable)
    {
        $title = 'Data Produk';
        return $dataTable->render('admin.DataProduk', compact('title'));
    }

    public function uploadForm()
    {
        $title = 'Data Produk';
        $products = Produk::all(); // Ambil semua produk dari database
        return view('admin.UploadDataProduk', compact('title', 'products'));
    }

    // public function unggahProduk(Request $request)
    // {
    //     // Validasi file Excel
    //     $request->validate([
    //         'file_excel' => 'required|file|mimes:xlsx,xls',
    //     ]);

    //     // Cek jika file ada
    //     if ($request->hasFile('file_excel')) {
    //         $file = $request->file('file_excel');

    //         // Load file Excel
    //         $spreadsheet = IOFactory::load($file->getRealPath());

    //         // Ambil worksheet aktif pertama
    //         $sheet = $spreadsheet->getActiveSheet();

    //         // Mulai dari baris ke-2 (asumsi baris 1 adalah header)
    //         $rowIterator = $sheet->getRowIterator(2);

    //         foreach ($rowIterator as $row) {
    //             $cellIterator = $row->getCellIterator();
    //             $cellIterator->setIterateOnlyExistingCells(false); // Loop through all cells, even empty ones

    //             $data = [];

    //             // Iterasi setiap sel dalam baris
    //             foreach ($cellIterator as $cell) {
    //                 $data[] = $cell->getValue();
    //             }

    //             // Cek jika baris memiliki setidaknya 3 kolom data yang sesuai
    //             if (count($data) >= 2) {
    //                 // Validasi sederhana untuk kolom price (pastikan angka)
    //                 if (is_numeric($data[1])) {
    //                     // Asumsi kolom Excel: name, price, description
    //                     Produk::create([
    //                         'nama' => $data[0],          // Kolom pertama (name)
    //                         'kode' => $data[1],         // Kolom kedua (price)
                        
    //                     ]);
    //                 }
    //             }
    //         }

    //         return back()->with('success', 'File Excel berhasil diunggah dan datanya dimasukkan ke dalam database!');
    //     }

    //     return back()->with('error', 'Tidak ada file yang diunggah.');
    // }

   
 


}
