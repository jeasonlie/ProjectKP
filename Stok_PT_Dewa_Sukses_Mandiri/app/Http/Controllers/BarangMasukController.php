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
            $masukDetail = MasukDetail::where('id_masuk', $id)->get();

            return view("masuk.detail", compact(['masuk', 'masukDetail']));
        }else{
            return redirect()->route("masuk.index")->withErrors(['errors' => 'Data Barang Masuk tidak valid']);
        }
    }

    public function create(){
        $this->authorize('create', Masuk::class);
        $barang = Barang::all();
        return view("masuk.create", compact('barang'));
    }

    public function store(Request $request){
        $this->authorize('create', Masuk::class);
        $request->validate([
            'tgl_masuk' => 'required|date',
            'keterangan' => 'required',
            'id_barang' => 'required|array',
            'id_barang.*' => [
                'required',
                Rule::in(Barang::all()->pluck('id')->toArray())
            ],
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|numeric|between:1,999'
        ]);

        $masuk = New Masuk();

        $increment = DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA ='" . env('DB_DATABASE') . "' AND TABLE_NAME ='" . $masuk->getTable() . "'")[0]->AUTO_INCREMENT;
        $masuk->kode_masuk = str_pad($increment, 8, "0", STR_PAD_LEFT);

        $masuk->tgl_masuk = $request->tgl_masuk;
        $masuk->keterangan = $request->keterangan;
        $masuk->save();

        for($i = 0; $i < count($request->id_barang); $i++){
            $masukDetail = new MasukDetail();
            $masukDetail->id_masuk = $increment;
            $masukDetail->id_barang = $request->id_barang[$i];
            $masukDetail->jumlah = $request->jumlah[$i];
            $masukDetail->save();
        }

        $request->session()->flash("info", 'Data Barang Masuk '.str_pad($increment, 8, "0", STR_PAD_LEFT).' berhasil dibuat!');
        return redirect()->route("masuk.index");
    }

    public function validasi(Request $request, $id){
        $masuk = Masuk::find($id);

        if($masuk){
            $this->authorize('validasi', [Masuk::class, $masuk]);

            $masuk->id_validator = Auth::user()->id;
            $masuk->tgl_validasi = now();
            $masuk->save();

            $request->session()->flash("info", "Data Barang Masuk $masuk->kode_masuk berhasil divalidasi!");
            return redirect()->route("masuk.index");
        }else{
            return redirect()->route("masuk.index")->withErrors(['errors' => 'Data Barang Masuk tidak valid']);
        }
    }
}
