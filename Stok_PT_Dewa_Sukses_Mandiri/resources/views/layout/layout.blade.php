<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script> -->
    <script src="{{asset('js/jquery-3.3.1.slim.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
    <script src="{{asset('js/datatables.min.js')}}"></script>
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" /> -->
    <!-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script> -->
    <title>Document</title>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="{{asset('logo.png')}}" alt="">
            <div class="sidebar-namaperusahaan">
                PT. Dewa Sukses Mandiri
            </div>
        </div>
        <div class="sidebar-menu">
            <div class="menu"><a href="/dashboard">Dashboard</a></div>
            <div class="menu"><a href="/user">Admin</a></div>
            <div class="menu"><a href="/barang">Barang</a></div>
            <div class="menu"><a href="/laporanbarang">Laporan Barang</a></div>
        </div>
        <div class="sidebar-user">
            <div class="nama">
                <div class="user">Nama</div>
                <div class="user">Role</div>
            </div>
            <div class="logout"><a href=""><img src="{{asset('logout.svg')}}" alt=""> logout</a></div>
        </div>
    </div>
    <div class="content">
        @yield("content")
    </div>
</body>
@yield('script')
</html>