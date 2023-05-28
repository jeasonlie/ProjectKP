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
<br><br><br>
<div class="table">
    <table id="isi">
        <thead>
            <tr>
                <th>NO</th>
                <th>TANGGAL</th>
                <th>NAMA BARANG</th>
                <th>KETERANGAN</th>
                <th>TIPE</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>
<script>
    const url = window.location.origin+"/api/laporanbarang";
    getData();
    async function getData(){
        try{
            const response = await fetch(url);
            const data = await response.json();
            const table = document.querySelector('#isi tbody');
            let rows = '';
            data.data.forEach((element,index) => {
                let newRow = 
                `
                    <tr>
                        <td>
                            ${++index}
                        </td>
                        <td>
                            `
                            newRow+=new Date(element.created_at).toISOString().slice(0, 10)
                            newRow+=`
                        </td>
                        <td>
                            `
                            for (let i = 0; i < element.laporan_barang_detail.length; i++) {
                                newRow+=`${element.laporan_barang_detail[i].barang.nama_barang}`
                            }
                            newRow+=`
                        </td>
                        <td>
                            ${element.keterangan}
                        </td>
                        <td>
                            ${element.is_masuk?'masuk':'keluar'}
                        </td>
                        <td>
                        <a href="/laporanbarang/${element.id}">
                            <button>
                                DETAIL
                            </button>
                        </a>
                        </td>
                    </tr>
                `
                rows += newRow;
            });
            table.innerHTML = rows;
            $('#isi').dataTable({
                autoWidth: false,
                compact: true,
                scrollX: true,
                searching: true
            });
        }
        catch(err){
            console.error(err);
        }
    }
</script>
@endsection
