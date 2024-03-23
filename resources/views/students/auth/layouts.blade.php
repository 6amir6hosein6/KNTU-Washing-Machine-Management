<!DOCTYPE html>
<html>
<head>
    <style>
        body{
            direction: rtl;
        }
        #logo{
            width: 10%;
        }

        nav {
            text-align: center;
            background-color: #333;
            color: #fff;
            padding: 20px 0;
        }

        nav img {
            display: block;
            margin: 0 auto;
        }

        nav p {
            margin: 10px 0 0;
        }
    </style>
    <title>فرم ورود دانشجو</title>
    <link href="{{asset('css/cdn.jsdelivr.net_npm_bootstrap@5.3.2_dist_css_bootstrap.min.css')}}" rel="stylesheet">
</head>
<body>

<nav style="background-color: #e3f2fd;">
    <div class="logo-container">
        <img id="logo" src="{{asset('img/Kntu_logo-new.png')}}">
    </div>
    <br>
    <p style="color: black">سامانه مدیریت ماشین لباسشویی خوابگاه</p>

</nav>
<div class="container mt-5">
    @yield('content')
</div>
</body>
</html>
