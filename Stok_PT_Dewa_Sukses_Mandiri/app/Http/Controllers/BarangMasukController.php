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
}
