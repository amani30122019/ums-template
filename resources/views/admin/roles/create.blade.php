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
                    <div class="card-header">Create role
                        <span class="float-right">
                            <a class="btn btn-primary" href="{{ route('roles.index') }}">Roles</a>
                        </span>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'roles.store', 'method' => 'POST', 'autocomplete' => 'off']) !!}
                        <div class="form-group">
                            <strong>Name:</strong>
                            {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group mt-2">
                            <strong>Permission:</strong>
                            <br />
                            @foreach ($permission as $value)
                                <label>{{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                                    {{ $value->name }}</label>
                                <br />
                            @endforeach
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
