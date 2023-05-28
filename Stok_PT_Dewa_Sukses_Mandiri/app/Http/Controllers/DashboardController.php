<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\LaporanBarang;
use App\Models\LaporanBarangDetail;

class DashboardController extends Controller
{
    public function index(){
        $barang = Barang::all();
        $barang_masuk = LaporanBarang::where('is_masuk', 1)->get();
        $barang_keluar = LaporanBarang::where('is_masuk', 0)->get();
        return view('dashboard', compact('barang','barang_masuk','barang_keluar'));
    }
}
