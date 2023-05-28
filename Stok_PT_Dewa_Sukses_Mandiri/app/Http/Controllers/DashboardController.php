<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Barang;
use App\Models\LaporanBarang;
use App\Models\LaporanBarangDetail;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        //$collection = $collection =DB::select("select*from masuk_keluar where is_masuk = 1 ");
        $query = LaporanBarang::query();
        $dateFilter = $request->date_filter;
        switch($dateFilter){
            case 'today':
                $query->whereDate('tanggal',Carbon::today());
                break;
            case 'yesterday':
                $query->wheredate('tanggal',Carbon::yesterday());
                break;
            case 'this_week':
                $query->whereBetween('tanggal',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()]);
                break;
            case 'last_week':
                $query->whereBetween('tanggal',[Carbon::now()->subWeek(),Carbon::now()]);
                break;
            case 'this_month':
                $query->whereMonth('tanggal',Carbon::now()->month);
                break;
            case 'last_month':
                $query->whereMonth('tanggal',Carbon::now()->subMonth()->month);
                break;
            case 'this_year':
                $query->whereYear('tanggal',Carbon::now()->year);
                break;
            case 'last_year':
                $query->whereYear('tanggal',Carbon::now()->subYear()->year);
                break;
        }
        $barang = $query->get();
        $barang_jumlah = Barang::all();
        $barang_masuk = LaporanBarang::where('is_masuk', 1)->get();
        $barang_keluar = LaporanBarang::where('is_masuk', 0)->get();
        return response()->view('dashboard', compact('barang','barang_jumlah','barang_masuk','barang_keluar','dateFilter'));
    }
}
