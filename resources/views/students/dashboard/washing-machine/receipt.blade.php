<!DOCTYPE html>
<html>
<head>
    @include('students.dashboard.header')
    <meta charset="UTF-8">
    <title>رزرو ماشین لباسشویی</title>


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

@include('students.dashboard.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">رسید رزرو ماشین لباسشویی</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <span>
                        رسید رزرو شما <b>{{$receiptID}}</b> می‌باشد . در حفظ آن کوشا باشید
                        <br>
                        در زمان رزرو شده با این کد ماشین لباسشویی برای شما <u>فعال</u> خواهد شد
                    </span>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
@include('students.dashboard.footer')
</body>
</html>
