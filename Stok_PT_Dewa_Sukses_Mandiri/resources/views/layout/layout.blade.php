<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatables.css')}}">
    <script src="{{asset('js/jquery-3.7.0.js')}}"></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/datatables.js')}}"></script>
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
            <div class="menu"><a href="/penyimpananbarang">Pendataan Barang</a></div>
        </div>
        <div class="sidebar-user">
            <div class="nama">
                <div class="user">{{ Auth::user()->name }}</div>
            </div>
            <form id="keluar" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button id="keluar" onclick="event.preventDefault();
                    this.closest('form').submit();">
                    <img src="{{asset('logout.svg')}}" alt="">
                    Logout
                </button>
                </form>
        </div>
    </div>
    <div class="content">
        @yield("content")
    </div>
</body>
@yield('script')
</html>