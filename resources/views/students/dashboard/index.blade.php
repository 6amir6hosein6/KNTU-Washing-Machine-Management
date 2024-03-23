<!DOCTYPE html>
<html>
<head>
    @include('students.dashboard.header')
    <title>داشبرد مدیریت</title>
    <script src="{{asset('js/separate-number.js')}}" defer></script>
    <script src="{{asset('js/Chart.min.js')}}"></script>



</head><body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('students.dashboard.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">داشبرد</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>3</h3>

                                <p>تعداد مشتریان</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>3</h3>

                                <p>تعداد فاکتورها</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-file-text-o"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>3}</h3>
                                <p>مبلغ کل بدهی(تومان)</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-usd"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>3</h3>

                                <p>تعداد بار های تایید نشده</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-dropbox"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <section class="col-lg-7 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header d-flex p-0">
                                <h3 class="card-title p-3">
                                    <i class="fa fa-pie-chart mr-1"></i>
                                    تعداد فاکتور روزانه
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <canvas id="myChart" style="width:100%;max-width:600px;max-height: 400px"></canvas>
                            </div>
                        </div>
                        <!-- /.card -->
                    </section>

                    <section class="col-lg-5 connectedSortable">
                        <!-- Map card -->
                        <div class="card">
                            <div class="card-header d-flex p-0">
                                <h3 class="card-title p-3">
                                    <i class="fa fa-pie-chart mr-1"></i>
                                    دسته بندی مشتریان
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body" style="padding: 0">
                                <canvas height="250px" id="myChart2" style="width:100%;max-width:600px;max-height: 400px"></canvas>
                            </div>
                        </div>
                        <!-- /.card -->
                    </section>
                </div>
                <!-- /.row (main row) -->
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
<script>
    {{--let factor_data = JSON.parse(' {!! $factor_count_day_based !!} ');--}}
    {{--var factor_xValues = [];--}}
    {{--var factor_yValues = [];--}}
    {{--Object.entries(factor_data).forEach(([key, value], index) => {--}}
    {{--    factor_xValues.push(key.substring(5))--}}
    {{--    factor_yValues.push(value)--}}
    {{--});--}}

    {{--new Chart("myChart", {--}}
    {{--    type: "line",--}}
    {{--    data: {--}}
    {{--        labels: factor_xValues,--}}
    {{--        datasets: [{--}}
    {{--            data: factor_yValues,--}}
    {{--            borderColor: "green",--}}
    {{--            fill: false--}}
    {{--        }]--}}
    {{--    },--}}
    {{--    options: {--}}
    {{--        legend: {display: false}--}}
    {{--    }--}}
    {{--});--}}


    {{--let customer_data = JSON.parse(' {!! $customer_count_kind_based !!} ');--}}
    {{--var customer_xValues = [];--}}
    {{--var customer_yValues = [];--}}
    {{--var barColors = ["red", "green", "blue"];--}}
    {{--Object.entries(customer_data).forEach(([key, value], index) => {--}}
    {{--    customer_xValues.push(value['kind'])--}}
    {{--    customer_yValues.push(value['count'])--}}
    {{--});--}}

    {{--new Chart("myChart2", {--}}
    {{--    type: "pie",--}}
    {{--    data: {--}}
    {{--        labels: customer_xValues,--}}
    {{--        datasets: [{--}}
    {{--            backgroundColor: barColors,--}}
    {{--            data: customer_yValues--}}
    {{--        }]--}}
    {{--    },--}}
    {{--    options: {--}}
    {{--        title: {--}}
    {{--            display: true,--}}
    {{--        }--}}
    {{--    }--}}
    {{--});--}}
</script>
</body>
</html>
