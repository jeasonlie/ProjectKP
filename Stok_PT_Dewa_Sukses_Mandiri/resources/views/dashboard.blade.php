@extends('layout.layout')
@section('content')

<div class="judul-content">
    <div class="intro">Dashboard</div>
    <div class="sub-intro">Selamat datang, User</div>
</div>

<div class="isi-content">
    <div class="content-jumlah">
        <a href="/barang">Jumlah Stock Barang</a>
    </div>
    <div class="content-masuk">
        <a href="/laporanbarang">Jumlah Barang Masuk</a>
    </div>
    <div class="content-keluar">
        <a href="/laporanbarang">Jumlah Barang keluar</a>
    </div>
</div>

@endsection