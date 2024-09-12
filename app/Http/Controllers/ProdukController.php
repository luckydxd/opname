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

    public function importData()
    {
        $title = 'Data Produk';
        
        return view('admin.UploadDataProduk', compact('title'));
    }

    // public function importData()
    // {
    //     $title = 'Data Produk';
    //     return view('admin.StokOpname-import', compact('title'));
    // }

    //         return back()->with('success', 'File Excel berhasil diunggah dan datanya dimasukkan ke dalam database!');
    //     }

    //     return back()->with('error', 'Tidak ada file yang diunggah.');
    // }

   
 


}
