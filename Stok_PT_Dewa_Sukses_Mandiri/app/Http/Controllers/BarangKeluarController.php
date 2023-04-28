<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\BarangKeluar;
use App\Models\BarangKeluarDetail;

class BarangKeluarController extends Controller
{
    public function index(){
        $keluar = BarangKeluar::all();
        return view("keluar.index", compact('keluar'));
    }
    
    public function select($id){
        $keluar = BarangKeluar::find($id);

        if($keluar){
            $keluarDetail = BarangKeluarDetail::where('id_keluar', $id)->get();

            return view("keluar.detail", compact(['keluar', 'keluarDetail']));
        }else{
            return redirect()->route("keluar.index")->withErrors(['errors' => 'Data Barang Keluar tidak valid']);
        }
    }
}