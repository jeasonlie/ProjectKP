@extends('layout.layout')
@section('content')
    <div class="title">
        Laporan Barang
    </div>
    <br>
    <div class="input">
        <form action="">
            <button>
                Tambah Barang
            </button>
            <br><br>
            <table id="form">
                <tr>
                    <th>
                        ID Barang
                    </th>
                    
                    <th>
                        Jumlah Masuk/Keluar
                    </th>
                </tr>
                <tr>
                    <td>
                    <input type="number" name="id_barang" id="">
                    </td>
                    <td>
                    <input type="number" name="jumlah" id="">
                    </td>
                </tr>
            </table>
            <br>
            <label for="">
                Keterangan
            </label>
            <br>
            <input type="text" name="keterangan">
            <br><br>
            <button>
                Tambah
            </button>
        </form>
    </div>
    <br><br>
    <div class="table">
        <table id="isi">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Masuk/Keluar</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection