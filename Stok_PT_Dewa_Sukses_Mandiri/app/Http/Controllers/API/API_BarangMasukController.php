<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\BarangMasuk;
use App\Models\BarangMasukDetail;

class API_BarangMasukController extends Controller
{
    public function index(){
        $masuk = BarangMasuk::all();
        return response()->json([
            'status' => 200,
            'data' => $barang
        ]);
    }
    
    public function store(Request $request){
        try {
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
    
            $masuk = New BarangMasuk();
    
            $increment = DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA ='" . env('DB_DATABASE') . "' AND TABLE_NAME ='" . $masuk->getTable() . "'")[0]->AUTO_INCREMENT;
            $masuk->kode_masuk = str_pad($increment, 8, "0", STR_PAD_LEFT);
    
            $masuk->tgl_masuk = $request->tgl_masuk;
            $masuk->keterangan_masuk = $request->keterangan_masuk;
            $masuk->save();
    
            for($i = 0; $i < count($request->id_barang); $i++){
                $masukDetail = new BarangMasukDetail();
                $masukDetail->id_masuk = $increment;
                $masukDetail->id_barang = $request->id_barang[$i];
                $masukDetail->jumlah_masuk = $request->jumlah_masuk[$i];
                $masukDetail->save();
            }
            return response()->json([
                'status' => 200,
                'data' => $barang
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'status' => 400,
                'data' => $error
            ],400);
        }
    }
}
