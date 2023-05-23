<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBarangDetail extends Model
{
    use HasFactory;
    Protected $table = 'laporan_barang_detail';

    public function Barang(){
        return $this->belongsTo(Barang::class, 'id_barang','id');
    }

}

