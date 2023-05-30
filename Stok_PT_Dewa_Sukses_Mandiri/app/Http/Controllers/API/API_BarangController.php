<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Barang;

class API_BarangController extends Controller
{
    public function index(){
        $barang = DB::select("SELECT barang.id, barang.nama_barang, sum(barang_masuk.total_masuk) as total_masuk, sum(barang_keluar.total_keluar) as total_keluar
        FROM barang
        LEFT JOIN (
            SELECT *
            FROM transaksi_barang
            WHERE is_masuk = 1
        ) AS masuk ON masuk.id = barang.id
        LEFT JOIN (
            SELECT transaksi_barang.id, transaksi_barang_detail.id_barang, SUM(transaksi_barang_detail.jumlah) AS total_masuk
            FROM transaksi_barang_detail
            INNER JOIN transaksi_barang ON transaksi_barang.id = transaksi_barang_detail.id_laporan_barang
            WHERE transaksi_barang.is_masuk = 1
            GROUP BY transaksi_barang.id, transaksi_barang_detail.id_barang  -- Include transaksi_barang.id in the GROUP BY clause
        ) AS barang_masuk ON barang_masuk.id_barang = barang.id
        LEFT JOIN (
            SELECT *
            FROM transaksi_barang
            WHERE is_masuk = 0
        ) AS keluar ON keluar.id = barang.id
        LEFT JOIN (
            SELECT transaksi_barang.id, transaksi_barang_detail.id_barang, SUM(transaksi_barang_detail.jumlah) AS total_keluar
            FROM transaksi_barang_detail
            INNER JOIN transaksi_barang ON transaksi_barang.id = transaksi_barang_detail.id_laporan_barang
            WHERE transaksi_barang.is_masuk = 0
            GROUP BY transaksi_barang.id, transaksi_barang_detail.id_barang  -- Include transaksi_barang.id in the GROUP BY clause
        ) AS barang_keluar ON barang_keluar.id_barang = barang.id
        GROUP BY barang.id, barang.nama_barang
        ");
        return response()->json([
            'status' => 200,
            'data' => $barang
        ]);
    }
    
    public function store(Request $request){
        try {
            $validation = $request->validate([
                'nama' => 'required|min:3|max:255',
            ]);
    
            $barang = new barang();
            $barang->nama_barang = $request->nama;
            $barang->save();
    
            return response()->json([
                'status' => 200,
                'data' => $barang
            ]);
        } catch (\Exception $err) {
            return response()->json([
                'status' => 400,
                'error' => $err
            ],400);
        }
    }
    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        if($barang){

            $validation = $request->validate([
                'nama' => 'required|min:3|max:255',
            ]);

            $barang->nama_barang = $request->nama;
            $barang->save();

            return response()->json([
                'status' => 200,
                'data' => $barang
            ]);
        }else{
            return response()->json([
                'status' => 400,
            ],400);
        }
    }

    public function destroy(Request $request, $id)
    {
        $barang = Barang::find($id);
        
        if($barang){
            try{
                $barang->delete();
                return response()->json([
                    'status' => 200,
                ]);
            }catch(QueryException $ex){
                return response()->json([
                    'status' => 400,
    
                ],400);
            }
        }else{
            return response()->json([
                'status' => 400,
            ],400);
        }
    }
}
