@extends('auth.app')
@section('title', 'Login')
@section('auth-content')

    {{-- <div class="login login-with-news-feed">
        <div class="news-feed">
            <div class="news-image" style="background-image: url(../assets/img/login-bg/login-bg-11.jpg)"></div>
            <div class="news-caption">
                <h4 class="caption-title"><b>{{ config('app.name') }}</b> </h4>
                <p>
                    Admin and user management template for web applications
                    Using Laravel Backend framework
                </p>
            </div>
        </div>
        <div class="login-container">
            <div class="login-header mb-30px">
                <div class="brand">
                    <div class="d-flex align-items-center">
                        <b>Login</b>
                    </div>
                </div>
            </div>
            <hr class="bg-gray-600 opacity-2" />
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
                            data-parsley-required-message="Please provide email address" value="{{ old('email') }}"
                            data-parsley-required />
                    </div>
                    <div class="mb-3">
                        <label class="mb-2">Password</label>
                        <input type="password" name="password" class="form-control fs-13px" placeholder="Password"
                            data-parsley-required-message="Fill in your password" data-parsley-required />
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
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                    <div class="mb-40px pb-40px text-dark">
                        Not a member yet? Click <a href="{{ route('register') }}" class="text-primary">Here</a>
                        to
                        register. OR <span><a href="{{ url('/') }}">Welcome</a></span>
                    </div>
                    <hr class="bg-gray-600 opacity-2" />
                    <div class="text-gray-600 text-center  mb-0">
                        &copy; Ikotek 2022
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    <div class="login login-v2 fw-bold">

        <div class="login-cover">
            <div class="login-cover-img" style="background-color:#ffffff" data-id="login-cover-image"></div>

        </div>
        <div class="login-container">

            <div class="login-header">
                <div class="brand text-center">
                    <div class="d-flex align-items-center text-gray-600">
                        <b>{{ config('app.name') }} </b>
                    </div>
                </div>
                <div class="icon">
                    <i style="color:#000000;" class="fa fa-sign-in-alt"></i>
                </div>
            </div>
            <div class="login-content text-gray-500">
                <div class="card shadow">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <span>{{ $error }}</span>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ route('login') }}" method="POST" id="user-login-form" data-parsley-validate
                            autocomplete="on">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-2">Email</label>
                                <input type="email" name="email" class="form-control fs-13px" placeholder="Email address"
                                    data-parsley-required-message="Please provide email address"
                                    value="{{ old('email') }}" data-parsley-required />
                            </div>
                            <div class="mb-3">
                                <label class="mb-2">Password</label>
                                <input type="password" name="password" class="form-control fs-13px" placeholder="Password"
                                    data-parsley-required-message="Fill in your password" data-parsley-required />
                            </div>
                            <div class="form-check mb-20px">
                                <input class="form-check-input" type="checkbox" value="1" id="rememberMe" />
                                <label class="form-check-label fs-13px text-gray-500" for="rememberMe">
                                    Remember Me
                                </label>

                            </div>
                            <div class="mb-20px">
                                <button type="submit" class="btn btn-success d-block w-100 h-45px btn-lg">Sign me
                                    in</button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="text-gray-600">
                                Not a member yet? Click <a href="{{ route('register') }}">here</a>
                                to
                                register. OR <span><a href="{{ url('/') }}">Welcome</a></span>
                            </div>
                            <hr class="bg-gray-600 opacity-2" />
                            <p class="text-center text-gray-600">
                                &copy; Ikotek 2022
                            </p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#user-login-form').parsley();
        /*  $('#user-login-form').on('submit', function(e) {
             e.preventDefault()
             console.log('it is working');
         }); */
    </script>
@endsection
