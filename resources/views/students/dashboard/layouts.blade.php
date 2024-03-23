<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            direction: rtl;
        }

        #logo {
            width: 25%;
        }

        nav {
            text-align: center;
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            display: flex;
            align-items: center;
            justify-content: space-between; /* Updated to space-between */
        }

        nav img {
            display: block;
            margin-right: auto; /* Move the image to the left */
        }

        nav p {
            margin: 10px 0 0;
        }
    </style>
    <title>داشبرد</title>
    <link href="{{asset('css/cdn.jsdelivr.net_npm_bootstrap@5.3.2_dist_css_bootstrap.min.css')}}" rel="stylesheet">
</head>
<body>

<nav style="background-color: #e3f2fd;">
    <p style="color: black">دانشجوی محترم {{$student->name}} سلام!</p>

    <p style="color: black">سامانه مدیریت ماشین لباسشویی خوابگاه</p>
    <div class="logo-container">
        <img id="logo" src="{{asset('img/Kntu_logo-new.png')}}">
    </div>
</nav>
<div class="container mt-5">
    @yield('content')
</div>
</body>
</html>
