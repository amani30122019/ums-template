@extends('auth1.app')
@section('title', 'Register')
@section('auth-content')
    <div class="register register-with-news-feed">

        <div class="news-feed">
            <div class="news-image" style="background-image: url(../assets/img/login-bg/login-bg-15.jpg)"></div>
            <div class="news-caption">
                <h4 class="caption-title"><b>UMS</b> Template App</h4>
                <p>
                    As a {{ config('app.name') }} app administrator, you use the {{ config('app.name') }} console to
                    manage your
                    organization’s account, such as add new users, manage security settings, and turn on the
                    services you want your team to access.
                </p>
            </div>
        </div>


        <div class="register-container">

            <div class="register-header mb-25px h1">
                <div class="mb-1">Sign Up</div>
                <small class="d-block fs-15px lh-16">Create your {{ config('app.name') }} Account. It’s free and always
                    will
                    be.</small>
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
            <div class="register-content">

                <form action="{{ route('register') }}" method="POST" class="fs-13px" id="form"
                    data-parsley-validate autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <label class="mb-2">Name <span class="text-danger">*</span></label>
                        <div class="row gx-3">
                            <div class="col-md-6 mb-2 mb-md-0">
                                <input type="text" name="first_name" class="form-control fs-13px" placeholder="First name"
                                    value="{{ old('first_name') }}"
                                    data-parsley-required-message="Please enter your First name " data-parsley-required />
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control fs-13px" placeholder="Last name" name="last_name"
                                    value="{{ old('last_name') }}"
                                    data-parsley-required-message="Please enter your Last name" data-parsley-required />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="mb-2">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control fs-13px" placeholder="Email address"
                            value="{{ old('email') }}" data-parsley-required-message="Please enter your email address"
                            data-parsley-required />
                    </div>
                    <div class="mb-4">
                        <label class="mb-2">Password <span class="text-danger">*</span></label>
                        <input type="password" id="mypassword" name="password" class="form-control fs-13px"
                            placeholder="Password" value="{{ old('password') }}"
                            data-parsley-required-message="Please enter your password" data-parsley-length="[4,20]"
                            data-parsley-length-message="At least Four characters" data-parsley-required />
                    </div>
                    <div class="mb-3">
                        <label class="mb-2">Re-enter Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control fs-13px" placeholder="Re-enter password" name="cpassword"
                            value="{{ old('password') }}" data-parsley-required-message="Please enter your password"
                            data-parsley-equalto="#mypassword" data-parsley-equalto-message="Password does not match"
                            data-parsley-length="[4,20]" data-parsley-length-message="At least Four characters"
                            data-parsley-required />
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary d-block w-100 btn-lg h-45px fs-13px">Sign
                            Up</button>
                    </div>
                    <div class="mb-4 pb-5">
                        Already a member? Click <a href="{{ route('login') }}">here</a> to login. OR <span><a
                                href="{{ url('/') }}">Welcome</a></span>
                    </div>
                    <hr class="bg-gray-600 opacity-2" />
                    <p class="text-center text-gray-600">
                        &copy; Ikotek 2022
                    </p>
                </form>
            </div>

        </div>

    </div>
@endsection
