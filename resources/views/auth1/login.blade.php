@extends('auth1.app')
@section('title', 'Login')
@section('auth-content')

    <div class="login login-with-news-feed">
        <div class="news-feed">
            <div class="news-image" style="background-image: url(../assets/img/login-bg/login-bg-11.jpg)"></div>
            <div class="news-caption">
                <h4 class="caption-title"><b>Login</b> System</h4>
                <p>
                    Download the Login System app for iPhone®, iPad®, and Android™. Lorem ipsum dolor sit amet,
                    consectetur adipiscing elit.
                </p>
            </div>
        </div>
        <div class="login-container">
            <div class="login-header mb-30px">
                <div class="brand">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-sign-in-alt mx-3"></i> <b>Login</b>
                    </div>
                </div>
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="login-content">
                <form action="{{ route('login') }}" method="POST" class="fs-13px" id="form" data-parsley-validate
                    autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <label class="mb-2">Email</label>
                        <input type="email" name="email" class="form-control fs-13px" placeholder="Email address"
                            value="{{ old('email') }}" data-parsley-required />
                    </div>
                    <div class="mb-3">
                        <label class="mb-2">Password</label>
                        <input type="password" name="password" class="form-control fs-13px" placeholder="Password"
                            data-parsley-required />
                    </div>
                    <div class="form-check mb-30px">
                        <input class="form-check-input" type="checkbox" value="1" id="rememberMe" />
                        <label class="form-check-label" for="rememberMe">
                            Remember Me
                        </label>
                    </div>
                    <div class="mb-15px">
                        <button type="submit" class="btn btn-success d-block h-45px w-100 btn-lg fs-14px">Sign me
                            in</button>
                    </div>
                    <div class="mb-40px pb-40px text-dark">
                        Not a member yet? Click <a href="{{ route('register') }}" class="text-primary">Here</a>
                        to
                        register. OR <span><a href="{{ url('/') }}">Welcome</a></span>
                    </div>
                    <hr class="bg-gray-600 opacity-2" />
                    <div class="text-gray-600 text-center  mb-0">
                        &copy; Color Admin All Right Reserved 2021
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
