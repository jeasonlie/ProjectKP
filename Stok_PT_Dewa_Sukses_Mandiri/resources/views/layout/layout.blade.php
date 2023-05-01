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
                <a href="" class="menu menu3">Barang</a>
                <a href="" class="menu menu4">Barang Masuk</a>
                <a href="" class="menu menu5">Barang keluar</a>
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
        <h1>Dashboard</h1>
        <p style="margin-bottom: 20px">Selamat Datang Jeason Lie</p>

       <div class="tampilanmenu">
            <div class="menubox jumlahbarang">
                <p>Jumlah Barang</p>
            </div>

            <div class="menubox barangmasuk">
                <p>Jumlah Barang Masuk</p>
            </div>
            <div class="menubox barangkeluar">
                <p>Jumlah Barang keluar</p>
            </div>
       </div>
    </div>
</body>
</html>