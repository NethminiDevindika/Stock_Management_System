@extends('layouts.app')

@section('content')
    <div class="login-page">
        <div class="login-box mt-5">
            <div class="login-logo">

                <img src="{{asset('img/AdminLTELogo.jpg')}}" alt="AdminLTE Logo" width="225" height="225">
                <br>
                <b>Sri Lanka Light Infantry Regiment - SL Army</b>
               
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Staff Login</p>

                    <form method="POST" action="{{ route('user.login') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                   placeholder="Username" value="{{ old('username') }}" name="username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Password" name="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-4 offset-8">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <p class="mb-1">
                        <a href="{{ route('admin.login') }}">Admin Login</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
@endsection

