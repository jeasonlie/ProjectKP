@extends('layout.layout')
@section('content')
    <div class="title">
        Barang
    </div>
    <br>
    <div class="input">
        <form action="">
            <label for="">
                Nama Barang
            </label>
            <br>
            <input type="text" name="nama" id="">
            <br>
            <label for="">
                Stock
            </label>
            <br>
            <input type="number" name="stok" id="">
            <br><br>
            <button>
                Tambah
            </button>
        </form>
    </div>
    <br><br>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Stock</th>
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
                </tr>
            </tbody>
        </table>
    </div>
@endsection