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
        return view("laporan.index", compact('laporan'));
    }
    
    public function select($id){
        $laporan_barang = LaporanBarang::find($id);

        if($laporan_barang){
            $laporan_barangDetail = LaporanBarangDetail::where('id_laporan', $id)->get();

            return view("laporan.detail", compact(['laporan', 'laporanDetail']));
        }else{
            return redirect()->route("laporan.index")->withErrors(['errors' => 'Data Barang Masuk tidak valid']);
        }
    }
}
