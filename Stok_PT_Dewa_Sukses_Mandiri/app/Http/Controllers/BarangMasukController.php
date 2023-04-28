<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\BarangMasuk;
use App\Models\BarangMasukDetail;

class BarangMasukController extends Controller
{
    public function index(){
        $masuk = BarangMasuk::all();
        return view("masuk.index", compact('masuk'));
    }
    
    public function select($id){
        $masuk = BarangMasuk::find($id);

        if($masuk){
            $masukDetail = BarangMasukDetail::where('id_masuk', $id)->get();

            return view("masuk.detail", compact(['masuk', 'masukDetail']));
        }else{
            return redirect()->route("masuk.index")->withErrors(['errors' => 'Data Barang Masuk tidak valid']);
        }
    }

    public function store(Request $request){
        $request->validate([
            'tgl_masuk' => 'required|date',
            'keterangan_masuk' => 'required',
            'id_barang' => 'required|array',
            'id_barang.*' => [
                'required',
                Rule::in(Barang::all()->pluck('id')->toArray())
            ],
            'jumlah_masuk' => 'required|array',
            'jumlah_masuk.*' => 'required|numeric|between:1,999'
        ]);

        $masuk = New Masuk();

        $increment = DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA ='" . env('DB_DATABASE') . "' AND TABLE_NAME ='" . $masuk->getTable() . "'")[0]->AUTO_INCREMENT;
        $masuk->kode_masuk = str_pad($increment, 8, "0", STR_PAD_LEFT);

        $masuk->tgl_masuk = $request->tgl_masuk;
        $masuk->keterangan_masuk = $request->keterangan_masuk;
        $masuk->save();

        for($i = 0; $i < count($request->id_barang); $i++){
            $masukDetail = new MasukDetail();
            $masukDetail->id_masuk = $increment;
            $masukDetail->id_barang = $request->id_barang[$i];
            $masukDetail->jumlah_masuk = $request->jumlah_masuk[$i];
            $masukDetail->save();
        }

        $request->session()->flash("info", 'Data Barang Masuk '.str_pad($increment, 8, "0", STR_PAD_LEFT).' berhasil dibuat!');
        return redirect()->route("masuk.index");
    }
}
