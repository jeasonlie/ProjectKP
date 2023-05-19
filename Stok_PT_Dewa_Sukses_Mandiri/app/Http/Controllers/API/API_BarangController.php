<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Barang;

class API_BarangController extends Controller
{
    public function index(){
        $barang = DB::table('barang')
    ->leftJoinSub(function ($query) {
        $query->select('laporan_barang.id', 'laporan_barang_detail.id_barang', DB::raw('SUM(laporan_barang_detail.jumlah) AS total_masuk'))
            ->from('laporan_barang_detail')
            ->join('laporan_barang', 'laporan_barang.id', '=', 'laporan_barang_detail.id_laporan_barang')
            ->where('laporan_barang.is_masuk', '=', 1)
            ->groupBy('laporan_barang.id', 'laporan_barang_detail.id_barang');
    }, 'barang_masuk', 'barang_masuk.id_barang', '=', 'barang.id')
    ->leftJoinSub(function ($query) {
        $query->select('laporan_barang.id', 'laporan_barang_detail.id_barang', DB::raw('SUM(laporan_barang_detail.jumlah) AS total_keluar'))
            ->from('laporan_barang_detail')
            ->join('laporan_barang', 'laporan_barang.id', '=', 'laporan_barang_detail.id_laporan_barang')
            ->where('laporan_barang.is_masuk', '=', 0)
            ->groupBy('laporan_barang.id', 'laporan_barang_detail.id_barang');
    }, 'barang_keluar', 'barang_keluar.id_barang', '=', 'barang.id')
    ->select('barang.nama_barang', 'barang.id', DB::raw('SUM(barang_masuk.total_masuk) AS total_masuk'), DB::raw('SUM(barang_keluar.total_keluar) AS total_keluar'))
    ->groupBy('barang.id')
    ->get();

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
            $barang->stok = 0;
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
