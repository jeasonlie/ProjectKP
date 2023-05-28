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
                {{count($barang_jumlah)}}
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
<br><br><br>
<form method="get" action="dashboard">
    <div class="input-group" style="display:flex; gap:10px" >
        <div>
        <select class="form-select select2" name="date_filter">
            <option value="">All Dates</option>
            <option value="today" {{ $dateFilter == 'today' ? 'selected' : '' }}>Today</option>
            <option value="yesterday" {{ $dateFilter == 'yesterday' ? 'selected' : '' }}>Yesterday</option>
            <option value="this_week" {{ $dateFilter == 'this_week' ? 'selected' : '' }}>This Week</option>
            <option value="last_week" {{ $dateFilter == 'last_week' ? 'selected' : '' }}>Last Week</option>
            <option value="this_month" {{ $dateFilter == 'this_month' ? 'selected' : '' }}>This Month</option>
            <option value="last_month" {{ $dateFilter == 'last_month' ? 'selected' : '' }}>Last Month</option>
            <option value="this_year" {{ $dateFilter == 'this_year' ? 'selected' : '' }}>This Year</option>
            <option value="last_year" {{ $dateFilter == 'last_year' ? 'selected' : '' }}>Last Year</option>
        </select>
        </div>

        <button type="submit" class="btn btn-primary">Filter</button>
    </div>
</form>
<div class="table">
    <table id="isi">
        <thead>
            <tr>
                <th>NO</th>
                <th>TANGGAL</th>
                <th>KETERANGAN</th>
                <th>TIPE</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($barang as $idx=>$value)
            <tr>
                <td>{{$idx+1}}</td>
                <td>{{$value->tanggal}}</td>
                <td>{{$value->keterangan}}</td>
                <td>{{$value->is_masuk? 'masuk':'keluar'}}</td>
                <td>
                    <a href="/laporanbarang/{{$value->id}}">
                        <button class="detail">
                            DETAIL
                        </button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    const url = window.location.origin+"/api/laporanbarang";
    $('document').ready(function () {
        $('#isi').dataTable({
            autoWidth: false,
            compact: true,
            scrollX: true,
            searching: true
        });
    })
</script>
@endsection
