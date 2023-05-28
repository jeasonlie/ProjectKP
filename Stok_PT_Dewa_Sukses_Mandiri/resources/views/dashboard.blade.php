@extends('layout.layout')
@section('content')

<div class="judul-content">
    <div class="intro">Dashboard</div>
    <div class="sub-intro">Selamat datang, User</div>
</div>

<div class="isi-content">
    <div class="content-jumlah">
        <a href="/barang">
            <div>
                Jumlah Barang
            </div>
            <div class="jumlah">
                {{count($barang)}}
            </div>
        </a>
    </div>
    <div class="content-masuk">
        <a href="/laporanbarang">
            <div>
                Jumlah Laporan Masuk
            </div>
            <div class="jumlah">
                {{count($barang_masuk)}}
            </div>
        </a>
    </div>
    <div class="content-keluar">
    <a href="/laporanbarang">
            <div>
                Jumlah Laporan Keluar
            </div>
            <div class="jumlah">
                {{count($barang_keluar)}}
            </div>
        </a>
    </div>
</div>
@endsection
