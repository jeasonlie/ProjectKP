<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\LaporanBarang;
use App\Models\LaporanBarangDetail;

class API_LaporanBarangController extends Controller
{
    public function index(){
        $laporan_barang = LaporanBarang::all();
        return response()->json([
            'status' => 200,
            'data' => $laporan_barang
        ]);
    }
    
    public function store(Request $request){
        try {
            $request->validate([
                'tanggal' => 'required|date',
                'keterangan' => 'required',
                'id_barang' => 'required|array',
                'id_barang.*' => [
                    'required',
                    Rule::in(Barang::all()->pluck('id')->toArray())
                ],
                'jumlah' => 'required|array',
                'jumlah.*' => 'required|numeric|between:1,999'
            ]);
    
            $laporan_barang = New LaporanBarang();
    
            $increment = DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA ='" . env('DB_DATABASE') . "' AND TABLE_NAME ='" . $laporan_barang->getTable() . "'")[0]->AUTO_INCREMENT;
    
            $laporan_barang->tanggal = $request->tanggal;
            $laporan_barang->keterangan = $request->keterangan;
            $laporan_barang->save();
    
            for($i = 0; $i < count($request->id_barang); $i++){
                $laporan_barangDetail = new LaporanBarangDetail();
                $laporan_barangDetail->id_laporan_barang = $increment;
                $laporan_barangDetail->id_barang = $request->id_barang[$i];
                $laporan_barangDetail->jumlah = $request->jumlah[$i];
                $laporan_barangDetail->save();
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
