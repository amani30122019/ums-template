@extends('auth.app')
@section('title', 'Register')
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
                    <i style="color:#000000;" class="fa fa-user-plus"></i>
                </div>
            </div>
            <div class="login-content text-gray-600">
                <form action="{{ route('register') }}" method="POST" class="fs-13px" id="form"
                    data-parsley-validate autocomplete="on">
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
                        <label class="mb-2">Mobile Phone Number <span class="text-danger">*</span></label>
                        <input type="numeric" class="form-control" name="phone" value="{{ old('phone') }}"
                            onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                            placeholder="eg. 0655373778  ten digits only"
                            data-parsley-required-message="Please enter your Mobile phone number."
                            data-parsley-pattern="^(0)(7(?:(?:[1345678][0-9]{1}))[0-9]{6})|^(0)(6(?:(?:[25789][0-9]{1}))[0-9]{6})$"
                            data-parsley-pattern-message="Your Phone number must start with 0,  and valid in Tanzania ."
                            data-parsley-required>
                    </div>
                    <div class="text-danger">
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="mb-2">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control fs-13px" placeholder="Email address"
                            value="{{ old('email') }}" data-parsley-required-message="Please enter your email address"
                            data-parsley-required />
                    </div>
                    <div class="text-danger">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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
                    <div class="mb-4 pb-5 text-gray-500">
                        Already a member? Click <a href="{{ route('login') }}">here</a> to login.
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
@section('script')
    <script>
        $('#form').parsley();
    </script>

@endsection
