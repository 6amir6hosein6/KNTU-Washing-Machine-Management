<!DOCTYPE html>
<html>
<head>
    @include('students.dashboard.header')
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>رزرو ماشین لباسشویی</title>
    <script src="{{asset('js/separate-number.js')}}" defer></script>
    <script src="{{asset('js/Chart.min.js')}}"></script>
    <style>
        /* Add some styles to your divs */
        .custom-div {
            padding: 10px;
            margin: 5px;
            border: 1px solid #ccc;
            cursor: pointer;
        }

        /* Add a class to indicate the selected div */
        .selected {
            border-color: #2a2a2a;
            background-color: #b3b3b3;
        }

        .day-select {
            flex: 0 0 14.28%;
            max-width: 14.28%;
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 8px;
            padding-left: 8px;
        }

        .select-option {
            cursor: pointer;
        }
    </style>


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
                        <h1 class="m-0 text-dark">رزرو ماشین لباسشویی</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="container-fluid">
                <div class="row" style="display: none" id="errorM">
                    <span style="color: red">
                        شما هنوز ماشین لباسشویی انتخاب نکردید
                    </span>
                </div>
                <div class="row" style="display: none" id="errorD">
                    <span style="color: red">
                        شما هنوز روز انتخاب نکردید
                    </span>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-dark">انتخاب ماشین لباسشویی</h4>
                        <br>
                    </div><!-- /.col -->
                </div>
                <div class="row">
                    @foreach($washingMachines as $machine)
                        <div class="col-lg-2 col-6 select-option">
                            <!-- small box -->
                            <div id="{{$machine->code}}" class="small-box" onclick="selectMachine(this)">
                                <div class="inner" style="text-align: center">
                                    <img height="50px" src="{{asset('img/washing-machine-icon.jpg')}}">
                                    <br>
                                    <br>
                                    <span style="font-size: 15px">{{$machine->code}}</span>
                                </div>
                                <div class="icon">
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                    @endforeach
                </div>
                <!-- /.row -->
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-dark">انتخاب روز هفته</h4>
                        <br>
                    </div><!-- /.col -->
                </div>
                <div class="row">
                    @foreach($days as $day)
                        <div class="col-lg-2 col-6 day-select select-option">
                            <!-- small box -->
                            <div id="{{$day['date']}}" class="small-box" onclick="selectDay(this)">
                                <div class="inner" style="text-align: center">
                                    <h5>{{$day["dayName"]}}</h5>
                                    <h7>{{$day['date']}}</h7>
                                </div>
                                <div class="icon">
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                    @endforeach
                </div>

                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-dark">انتخاب ساعت</h4>
                        <br>
                    </div><!-- /.col -->
                </div>
                <div class="row" id="time-row">
                    <p id="time-text">لطفا یک لباسشویی و یک روز هفته انتخاب کنید سپس روی دکمه مشاهده برنامه کلیک
                        کنید.</p>
                </div>

                <hr>

                <div class="row">
                    <div class="col-sm-12" style="text-align: left;">
                        <button class="btn btn-primary" onclick="getProgram()">مشاهده برنامه</button>
                        <form action="{{route("student-washing-machine-reserve.action")}}" method="post">
                            @csrf
                            <input id="machine-input" type="hidden" name="machine_id">
                            <input id="date-input" type="hidden" name="date">
                            <input id="time-input" type="hidden" name="time">
                            <input type="submit" class="btn btn-success" style="visibility: hidden" id="submit" value="ثبت سفارش">
                        </form>

                    </div><!-- /.col -->
                </div>
                <div class="row">


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
    // Keep track of the currently selected div
    let selectedMachine = null;
    let selectedDay = null;
    let selectedTime = null;

    function fresh() {
        let sme = document.getElementById('errorM');
        let sde = document.getElementById('errorD');
        let sub = document.getElementById('submit');

        sme.style.display = 'none';
        sde.style.display = 'none';
        sub.style.visibility = 'hidden';

        document.getElementsByName("machine_id").value = ""
        document.getElementsByName("date").value = ""
        document.getElementsByName("time").value = ""

        document.getElementById('time-row').innerHTML = '<p id="time-text">لطفا یک لباسشویی و یک روز هفته انتخاب کنید سپس روی دکمه مشاهده برنامه کلیک کنید.</p>'
    }

    // JavaScript code to handle div selection
    function selectMachine(clickedDiv) {
        fresh();
        // If there's a previously selected div, reset its appearance
        if (selectedMachine !== null) {
            selectedMachine.classList.remove('selected');
        }

        // Set the clicked div as the currently selected one
        selectedMachine = clickedDiv;

        // Add the 'selected' class to the clicked div
        selectedMachine.classList.add('selected');
        document.getElementById("machine-input").value = selectedMachine.id
        console.log(selectedMachine.id)
    }

    function selectDay(clickedDiv) {
        fresh();
        // If there's a previously selected div, reset its appearance
        if (selectedDay !== null) {
            selectedDay.classList.remove('selected');
        }

        // Set the clicked div as the currently selected one
        selectedDay = clickedDiv;

        // Add the 'selected' class to the clicked div
        selectedDay.classList.add('selected');
        document.getElementById("date-input").value = selectedDay.id
        console.log(selectedDay.id)
    }

    function selectTime(clickedDiv) {
        // If there's a previously selected div, reset its appearance
        if (selectedTime !== null) {
            selectedTime.classList.remove('selected');
        }

        // Set the clicked div as the currently selected one
        selectedTime = clickedDiv;

        // Add the 'selected' class to the clicked div
        selectedTime.classList.add('selected');
        console.log(selectedTime.id)
        document.getElementById("time-input").value = selectedTime.id
        document.getElementById('submit').style.visibility = 'visible';
    }


    function getProgram() {
        let sme = document.getElementById('errorM');
        let sde = document.getElementById('errorD');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedMachine === null) {
            sme.style.display = 'block';
        }
        if (selectedDay === null) {
            sde.style.display = 'block';
        }

        if (selectedMachine !== null && selectedDay !== null) {
            const url = '{{route('student-washing-machine-reserve-get-time')}}';
            let data = {
                machine_id: selectedMachine.id,
                date: selectedDay.id
            };

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify(data)
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(responseData => {
                    let value;
                    let time = ""
                    for (let key in responseData) {
                        value = responseData[key];
                        time = time + ' \
                        <div class="col-lg-2 col-6 day-select select-option"> \
                            <div id="' + value.start +':00" class="small-box" onclick="selectTime(this)"> \
                                <div class="inner" style="text-align: center">' +
                                value.end + ' - ' + value.start +
                                '</div> \
                                <div class="icon"></div> \
                            </div> \
                        </div>'
                    }
                    document.getElementById("time-row").innerHTML = time
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });
        }

    }

</script>
</body>
</html>
