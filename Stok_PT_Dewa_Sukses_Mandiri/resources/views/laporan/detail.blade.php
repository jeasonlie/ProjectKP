@extends('layout.layout')
@section('content')
<div class="title">
        DETAIL LAPORAN BARANG
    </div>
    <br>
    <div class="">
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
            @if($laporan_barang->laporan_barang_detail)
               @foreach($laporan_barang->laporan_barang_detail as $val)
               <tr>
                    <td>{{$val->barang->id}}</td>
                    <td>{{$val->barang->nama_barang}}</td>
                    <td>{{$val->barang->jumlah}}</td>
                </tr>
               @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection