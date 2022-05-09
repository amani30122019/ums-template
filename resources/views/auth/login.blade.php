@extends('auth.app')
@section('title', 'Login')
@section('auth-content')

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
                                register.
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
