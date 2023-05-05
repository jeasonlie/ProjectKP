<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Document</title>
</head>
<body>
    <div class="sideBar">
        <div class="sidebar-top">
            <div class="sidebarlogo">
                <img src="{{asset('logo.png')}}" alt="">
                <p>PT. DEWA SUKSES MANDIRI</p>
            </div>
            <div class="sidebarmenu">
                <a href="" class="menu menu1">Dashboard</a>
                <a href="" class="menu menu2">User</a>
                <a href="http://127.0.0.1:8000/barang" class="menu menu3">Barang</a>
                <a href="http://127.0.0.1:8000/laporanbarang" class="menu menu4">Laporan Barang</a>
            </div>
        </div>
        <div class="sidebar-bottom">
            <p>Jeason Lie</p>
            <p>Pengangguran</p>
            <div class="tampilanlogout">
                <img src="{{asset('logout.svg')}}" alt="">
                <a href="" class="logout">Logout</a>
            </div>
        </div>

    </div>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>