<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\BarangKeluar;
use App\Models\BarangKeluarDetail;

class API_BarangKeluarController extends Controller
{
    public function index(){
        $keluar = BarangKeluar::all();
        return response()->json([
            'status' => 200,
            'data' => $barang
        ]);
    }

    public function store(Request $request){
        try {
            $request->validate([
                'tgl_keluar' => 'required|date',
                'keterangan_keluar' => 'required',
                'id_barang' => 'required|array',
                'id_barang.*' => [
                    'required',
                    Rule::in(Barang::all()->pluck('id')->toArray())
                ],
                'jumlah_keluar' => 'required|array',
                'jumlah_keluar.*' => 'required|numeric|between:1,999'
            ]);
    
            $keluar = New BarangKeluar();
    
            $increment = DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA ='" . env('DB_DATABASE') . "' AND TABLE_NAME ='" . $keluar->getTable() . "'")[0]->AUTO_INCREMENT;
            $keluar->kode_keluar = str_pad($increment, 8, "0", STR_PAD_LEFT);
    
            $keluar->tgl_keluar = $request->tgl_keluar;
            $keluar->keterangan_keluar = $request->keterangan_keluar;
            $keluar->save();
    
            for($i = 0; $i < count($request->id_barang); $i++){
                $keluarDetail = new BarangKeluarDetail();
                $keluarDetail->id_keluar = $increment;
                $keluarDetail->id_barang = $request->id_barang[$i];
                $keluarDetail->jumlah_keluar = $request->jumlah_keluar[$i];
                $keluarDetail->save();
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
