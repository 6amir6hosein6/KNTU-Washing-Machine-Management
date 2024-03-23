@extends('students.auth.layouts')
@section('content')
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">ورود دانشجو</h3>
                        <div class="card-body">
                            <form method="POST" action="{{ route('student-login.action') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="شماره دانشجویی" id="email" class="form-control" name="studentID"
                                           required autofocus>
                                    @if ($errors->has('studentID'))
                                        <span class="text-danger">{{ $errors->first('studentID') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" placeholder="رمز عبور" id="password" class="form-control"
                                           name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
{{--                                <div class="form-group mb-3">--}}
{{--                                    <div class="checkbox">--}}
{{--                                        <label>--}}
{{--                                            <input type="checkbox" name="remember"> Remember Me--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">ورود</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
