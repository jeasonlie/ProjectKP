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

    public function store(Request $request){

        $validation = $request->validate([
            'nama' => 'required|min:3|max:255',
            'stok' => 'required|numeric|min:0|max: 999999999999',
        ]);

        $barang = new barang();
        $barang->nama_barang = $request->nama;
        $barang->stok = $request->stok;
        $barang->save();

        $request->session()->flash("info", "Data Barang $request->nama berhasil dibuat!");
        return redirect()->route("barang.index");
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

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        if($barang){

            $validation = $request->validate([
                'nama' => 'required|min:3|max:255',
                'stok' => 'required|numeric|min:0|max:999999999999',
            ]);

            $barang->nama_barang = $request->nama;
            $barang->stok = $request->stok;
            $barang->save();

            $request->session()->flash("info", "Data barang $request->nama (ID : $barang->kode_barang) berhasil diupdate!");
            return redirect()->route("barang.index");
        }else{
            return redirect()->route("barang.index")->withErrors(['errors' => 'Data Barang tidak valid']);
        }
    }

    public function destroy(Request $request, $id)
    {
        $barang = Barang::find($id);
        
        if($barang){

            try{
                $barang->delete();
                $request->session()->flash("info", "Data Barang berhasil dihapus!");
            }catch(QueryException $ex){
                return redirect()->route("barang.index")->withErrors(['errors' => 'Data Barang gagal dihapus']);
            }
        }else{
            $request->session()->flash("info", "Data barang tidak valid");
        }
        
        return redirect()->route("barang.index");
    }
}
