<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/css/login.css')}}">
    <title>Login</title>
</head>
<body>
    <div class="background">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="menu">
                <img src="{{asset('logo.png')}}" alt="" srcset="" style="height:150px">
                <div class="nama-perusahaan" style="font-weight: 600; margin-bottom: 20px"> 
                PT. Dewa Sukses Mandiri</div>
            <input type="email" name="email" placeholder="Email" style="margin-bottom: 10px">
            <input type="password" name="password" placeholder="Password">
            <button type="submit" style="margin-top: 20px">
                {{ __('Login') }}
            </button>
            </div>
        </form>
    </div>
</body>
</html>