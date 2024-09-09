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
    public function update(Request $request){
        $gudang = Gudang::find($request->id);
        $gudang->update([
            'name'=>$request->name,
        ]);
        return redirect()->route('data_gudang');
    }
    }

