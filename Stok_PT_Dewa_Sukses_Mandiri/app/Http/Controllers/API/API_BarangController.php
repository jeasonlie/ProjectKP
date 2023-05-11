<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Barang;

class API_BarangController extends Controller
{
    public function index(){
        $barang = Barang::all();
        return response()->json([
            'status' => 200,
            'data' => $barang
        ]);
    }
    
    public function store(Request $request){
        try {
            $validation = $request->validate([
                'nama' => 'required|min:3|max:255',
                'stok' => 'required|numeric|min:0|max: 999999999999',
            ]);
    
            $barang = new barang();
            $barang->nama_barang = $request->nama;
            $barang->stok = $request->stok;
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
                'stok' => 'required|numeric|min:0|max:999999999999',
            ]);

            $barang->nama_barang = $request->nama;
            $barang->stok = $request->stok;
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
