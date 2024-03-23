<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
{{--    <ul class="navbar-nav">--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>--}}
{{--        </li>--}}
{{--    </ul>--}}

    <ul class="navbar-nav">
        <li class="nav-item">
            <button id="SMSPriceExist" type="button" class="btn btn-default" disabled>
                سامانه مدیریت ماشین لباسشویی
            </button>
        </li>
    </ul>

{{--    <ul class="navbar-nav">--}}
{{--        <!-- Messages Dropdown Menu -->--}}
{{--        <li class="nav-item dropdown">--}}
{{--            <a class="nav-link" data-toggle="dropdown" href="#">--}}
{{--                <i class="fa fa-comments-o"></i>--}}
{{--                <span class="badge badge-danger navbar-badge">3</span>--}}
{{--            </a>--}}
{{--            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">--}}
{{--                <a href="#" class="dropdown-item">--}}
{{--                    <!-- Message Start -->--}}
{{--                    <div class="media">--}}
{{--                        <img src="{{asset("dist/img/user1-128x128.jpg")}}" alt="User Avatar"--}}
{{--                             class="img-size-50 ml-3 img-circle">--}}
{{--                        <div class="media-body">--}}
{{--                            <h3 class="dropdown-item-title">--}}
{{--                                حسام موسوی--}}
{{--                                <span class="float-left text-sm text-danger"><i class="fa fa-star"></i></span>--}}
{{--                            </h3>--}}
{{--                            <p class="text-sm">با من تماس بگیر لطفا...</p>--}}
{{--                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Message End -->--}}
{{--                </a>--}}
{{--                <div class="dropdown-divider"></div>--}}
{{--                <a href="#" class="dropdown-item">--}}
{{--                    <!-- Message Start -->--}}
{{--                    <div class="media">--}}
{{--                        <img src="{{asset("dist/img/user8-128x128.jpg")}}" alt="User Avatar"--}}
{{--                             class="img-size-50 img-circle ml-3">--}}
{{--                        <div class="media-body">--}}
{{--                            <h3 class="dropdown-item-title">--}}
{{--                                پیمان احمدی--}}
{{--                                <span class="float-left text-sm text-muted"><i class="fa fa-star"></i></span>--}}
{{--                            </h3>--}}
{{--                            <p class="text-sm">من پیامتو دریافت کردم</p>--}}
{{--                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Message End -->--}}
{{--                </a>--}}
{{--                <div class="dropdown-divider"></div>--}}
{{--                <a href="#" class="dropdown-item">--}}
{{--                    <!-- Message Start -->--}}
{{--                    <div class="media">--}}
{{--                        <img src="{{asset("dist/img/user3-128x128.jpg")}}" alt="User Avatar"--}}
{{--                             class="img-size-50 img-circle ml-3">--}}
{{--                        <div class="media-body">--}}
{{--                            <h3 class="dropdown-item-title">--}}
{{--                                سارا وکیلی--}}
{{--                                <span class="float-left text-sm text-warning"><i class="fa fa-star"></i></span>--}}
{{--                            </h3>--}}
{{--                            <p class="text-sm">پروژه اتون عالی بود مرسی واقعا</p>--}}
{{--                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i>4 ساعت قبل</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Message End -->--}}
{{--                </a>--}}
{{--                <div class="dropdown-divider"></div>--}}
{{--            </div>--}}
{{--        </li>--}}
{{--    </ul>--}}

    <ul class="navbar-nav mr-auto">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">پشتیبانی</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('student-logout.action')}}" class="nav-link">خروج از سیستم</a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <center>

            <img src="{{asset("img/Kntu_logo-new.png")}}" style="width: 25%">
        </center>
        <br>
        <span style="color: #313131;font-size: 15px">{{$student->name}} سلام!</span>
        <br>
        <span style="color: #313131;font-size: 15px">کیف پول شما : {{$student->wallet}} تومان </span>
        <br>
        <span style="color: #313131;font-size: 15px">خوابگاه :  {{$dorm}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
        <div style="direction: rtl">
            <!-- Sidebar user panel (optional) -->
{{--            <div class="user-panel">--}}
{{--                <img src="{{asset('img/banner.jpg')}}" style="width: 100%">--}}
{{--            </div>--}}

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{route('student-dashboard')}}" class="nav-link">
                            <i class="nav-icon fa fa-th"></i>
                            <p>
                                داشبرد
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('student-washing-machine-reserve.form')}}" class="nav-link">
                            <i class="nav-icon fa fa-asterisk"></i>
                            <p>
                                رزرو ماشین لباسشویی
                            </p>
                        </a>
                    </li>

{{--                    <li class="nav-item has-treeview">--}}
{{--                        <a href="#" class="nav-link">--}}
{{--                            <i class="nav-icon fa fa-pencil-square-o"></i>--}}
{{--                            <p>--}}
{{--                                اطلاعات پایه--}}
{{--                                <i class="right fa fa-angle-left"></i>--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview" style="">--}}
{{--                            <li class="nav-item" style="border: 1px solid lightgray;border-radius: 10px;margin-top: 5px;height: 40px">--}}
{{--                                <a href="{{route('customers.create')}}" class="nav-link">--}}
{{--                                    <i class="fa fa-user-circle-o  nav-icon"></i>--}}
{{--                                    <p>ثبت مشتری</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item" style="border: 1px solid lightgray;border-radius: 10px;margin-top: 5px;height: 40px">--}}
{{--                                <a href="{{route('customers.index')}}" class="nav-link">--}}
{{--                                    <i class="fa fa-id-card-o nav-icon"></i>--}}
{{--                                    <p>لیست مشتریان</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <hr style="border-top: 1px solid lightgray">--}}
{{--                            <li class="nav-item" style="border: 1px solid lightgray;border-radius: 10px;margin-top: 5px;height: 40px">--}}
{{--                                <a href="{{route('products.create')}}" class="nav-link">--}}
{{--                                    <i class="fa fa-pencil   nav-icon"></i>--}}
{{--                                    <p>ثبت کالا</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item" style="border: 1px solid lightgray;border-radius: 10px;margin-top: 5px;height: 40px">--}}
{{--                                <a href="{{route('products.index')}}" class="nav-link">--}}
{{--                                    <i class="fa fa-list-alt  nav-icon"></i>--}}
{{--                                    <p>لیست کالا ها</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <hr style="border-top: 1px solid lightgray">--}}
{{--                        </ul>--}}
{{--                    </li>--}}


                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
