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
        <h1>User & Admin</h1>
        <table>
            <tr>
                <th>
                    No
                </th>
                <th>
                    Nama
                </th>
                <th>
                    Role
                </th>
            </tr>
            <tr>
                <td>
                    1
                </td>
                <td>
                    jeason
                </td>
                <td>
                    Admin
                </td>
            </tr>
            <tr>
                <td>
                    2
                </td>
                <td>
                    Nova Ariansyah
                </td>
                <td>
                    User
                </td>
            </tr>
        </table>
    </div>
</body>
</html>