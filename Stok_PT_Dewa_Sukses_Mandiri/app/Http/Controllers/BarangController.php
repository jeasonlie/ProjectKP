<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index(){
        $barang = Barang::all();
        return view("barang.index", compact('barang'));
    }

    public function create(){
        return view("barang.create");
    }

    public function edit(Request $request, $id)
    {
        $barang = Barang::find($id);

        if($barang){
            return view("barang.edit");
        }else{
            return redirect()->route("barang.index")->withErrors(['errors' => 'Data Barang tidak valid']);
        }
    }
}
