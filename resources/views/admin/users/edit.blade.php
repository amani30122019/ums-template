@extends('admin.app')
@section('content')
    <div id="content" class="app-content">
        <div class="container">
            <div class="justify-content-center">
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
                <div class="card">
                    <div class="card-header">Create user
                        <span class="float-right">
                            <a class="btn btn-primary" href="{{ route('users.index') }}">Users</a>
                        </span>
                    </div>

                    <div class="card-body">

                        {{-- <form action="{{ route(['users.update', $user->id]) }}" method="PATCH" autocomplete="off">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-2">Name <span class="text-danger">*</span></label>
                                <div class="row gx-3">
                                    <div class="col-md-6 mb-2 mb-md-0">
                                        <input type="text" name="first_name" class="form-control fs-13px"
                                            placeholder="First name" value="{{ old('first_name') }} @isset($user)
                                                                                                {{ $user->first_name }}
                                                                    @endisset"
                                            data-parsley-required-message="Please enter your First name "
                                            data-parsley-required />
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control fs-13px" placeholder="Last name"
                                            name="last_name" value="{{ old('last_name') }} @isset($user)
                                                                                {{ $user->last_name }}
                                                            @endisset"
                                            data-parsley-required-message="Please enter your Last name"
                                            data-parsley-required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <strong>Email:</strong>
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }} @isset($user)
                                                    {{ $user->email }}
                                        @endisset">
                            </div>
                            <div class="form-group">
                                <strong>Password:</strong>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <strong>Confirm Password:</strong>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Confirm Password">

                            </div>
                            <div class="form-group">
                                <strong>Role:</strong>
                                <select class="form-select" multiple aria-label="multiple select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control', 'multiple']) !!}
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form> --}}

                        {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PATCH', 'autocomplete' => 'off']) !!}

                        <div class="mb-3">
                            <label class="mb-2">Name <span class="text-danger">*</span></label>
                            <div class="row gx-3">
                                <div class="col-md-6 mb-2 mb-md-0">
                                    <input type="text" name="first_name" class="form-control fs-13px"
                                        placeholder="First name" value="{{ old('first_name', $user->first_name) }}"
                                        data-parsley-required-message="Please enter your First name "
                                        data-parsley-required />
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control fs-13px" placeholder="Last name" name="last_name"
                                        value="{{ old('last_name', $user->last_name) }}"
                                        data-parsley-required-message="Please enter your Last name" data-parsley-required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <strong>Email:</strong>
                            {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                        </div>


                        <div class="form-group">
                            <strong>Role:</strong>
                            {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control', 'multiple']) !!}
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
