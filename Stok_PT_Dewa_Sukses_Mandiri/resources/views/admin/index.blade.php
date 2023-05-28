@extends('layout.layout')
@section('content')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <div class="title">
        Admin
    </div>
    <br>
    <div class="input">
        <form class="input-form"action="{{route('user.store')}}" method="POST">
            @csrf
            <label for="">
                Nama
            </label>
            <br>
            <input type="text" name="name" id="">
            <br>
            <label for="">
                E-Mail
            </label>
            <br>
            <input type="text" name="email" id="">
            <br>
            <label for="">
                Password
            </label>
            <br>
            <input type="text" name="password" id="">
            <br>
            <br><br>
            <button class="admin-button" type="submit">
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
                    <th>Nama</th>
                    <th>E-Mail</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $idx => $value)
                <tr>
                    <td>
                        {{ $idx + 1 }}
                    </td>
                    <td>
                        {{$value->name}}
                    </td>
                    <td>
                        {{$value->email}}
                    </td>
                </tr>
                @endforeach
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