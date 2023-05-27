@extends('layout.layout')
@section('content')

<div class="judul-content">
    <div class="intro">Dashboard</div>
    <div class="sub-intro-1">Selamat datang, User</div>
    <div class="sub-intro-1">Sebelum menggunakan aplikasi, mohon untuk Membaca Petunjuk Terlebih dahulu</div>
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
<br><br>
<div class="petunjuk">
    <div class="sub-petunjuk-1">
        Petunjuk untuk Menginput Barang : 
        <div class="isi-petunjuk-1">
            <li>Klik menu Barang</li>
            <li>Masukkan Nama Barang</li>
            <li>Klik Button Tambah</li>
        </div>
        <br>
        <div class="reminder-1">
            Perlu diingat :
            <div class="isi-reminder-1">
                <li>Setelah menginput Barang, maka secara otomatis stock barang nya akan menjadi 0</li>
                <li>Untuk menambah Stock Barang, maka anda harus menginput Laporan Barang Terlebih Dahulu</li>
        </div>
    </div>
    <br><br>
    <div class="sub-petunjuk-2">
        Petunjuk untuk Menginput Laporan Barang : 
        <div class="isi-petunjuk-2">
            <li>Klik menu Laporan Barang</li>
            <li>Pilih Barang yang mau diinput</li>
            <li>Klik Button Tambah</li>
        </div>
        <br>
        <div class="reminder-2">
            Perlu diingat :
            <div class="isi-reminder-2">
                <li>Setelah menginput Barang, maka secara otomatis stock barang nya akan menjadi 0</li>
                <li>Untuk menambah Stock Barang, maka anda harus menginput Laporan Barang Terlebih Dahulu</li>
        </div>
    </div>
</div>

@endsection
