<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\LaporanBarang;
use App\Models\LaporanBarangDetail;

class LaporanBarangController extends Controller
{
    public function index(){
        $laporan_barang = LaporanBarang::all();
        return view("laporan.index", compact('laporan_barang'));
    }
    
    public function select($id){
        $laporan_barang = LaporanBarang::find($id);

        if($laporan_barang){
            $laporan_barangDetail = LaporanBarangDetail::where('id_laporan', $id)->get();

            return view("laporan.detail", compact(['laporan_barang', 'laporanDetail']));
        }else{
            return redirect()->route("laporan.index")->withErrors(['errors' => 'Data Barang Masuk tidak valid']);
        }
    }
    public function show($id){
        $laporan_barang = LaporanBarang::with(['LaporanBarangDetail' => function ($query) {
            $query->with('Barang');
        }])->where('id', '=', $id)->first();
        return view("laporan.detail", compact('laporan_barang'));
    }
}
