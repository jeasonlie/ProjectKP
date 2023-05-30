<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBarang extends Model
{
    use HasFactory;
    Protected $table = 'transaksi_barang';

    function LaporanBarangDetail(){
        return $this->hasMany(LaporanBarangDetail::class, 'id_laporan_barang','id');
    }
}
