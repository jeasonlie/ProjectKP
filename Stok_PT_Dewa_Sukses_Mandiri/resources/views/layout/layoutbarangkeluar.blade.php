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
        <h1>Lihat Barang</h1>
        <table>
            <tr>
                <th>
                    No
                </th>
                <th>
                    Nama Barang
                </th>
                <th>
                    Barang Keluar
                </th>
                <th>
                    Keterangan
                </th>
                <th>
                    Tanggal Masuk
                </th>
            </tr>
            <tr>
                <td>
                    1
                </td>
                <td>
                    Contoh 1
                </td>
                <td>
                    2
                </td>
                <td>
                    Masuk
                </td>
                <td>
                    01-05-2023
                </td>
            </tr>
            <tr>
                <td>
                    2
                </td>
                <td>
                    Contoh 2
                </td>
                <td>
                    5
                </td>
                <td>
                    Masuk
                </td>
                <td>
                    02-05-2023
                </td>
            </tr>
        </table>
    </div>
</body>
</html>