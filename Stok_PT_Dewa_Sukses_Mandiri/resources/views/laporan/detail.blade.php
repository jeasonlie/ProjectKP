@extends('layout.layout')
@section('content')
<link rel="stylesheet" href="{{asset('css/laporanbarangdetail.css')}}">
<div class="title">
        DETAIL LAPORAN BARANG
    </div>
    <br>
    <div class="kartu-detail">
        <p>
            <b>Tanggal : </b> {{$laporan_barang->created_at}}
        </p>
        <p>
            <b>Keterangan : </b> {{$laporan_barang->keterangan}}
        </p>
    </div>
    <br><br>
    <div class="table">
        <table id="isi">
            <thead>
                <tr>
                    <th>ID BARANG</th>
                    <th>NAMA BARANG</th>
                    <th>JUMLAH</th>
                </tr>
            </thead>
            <tbody>
            @if($laporan_barang->LaporanBarangDetail)
               @foreach($laporan_barang->LaporanBarangDetail as $val)
               <tr>
                    <td>{{$val->barang->id}}</td>
                    <td>{{$val->barang->nama_barang}}</td>
                    <td>{{$val->jumlah}}</td>
                </tr>
               @endforeach
            @endif
            </tbody>
        </table>
    </div>
<script>
    $('#isi').dataTable({
        autoWidth: false,
        compact: true,
        scrollX: true,
        searching: true
    });
</script>
@endsection