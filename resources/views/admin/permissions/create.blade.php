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
                    <div class="card-header">Create permission
                        <span class="float-right">
                            <a class="btn btn-primary" href="{{ route('permissions.index') }}">Permissions</a>
                        </span>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'permissions.store', 'method' => 'POST']) !!}
                        <div class="form-group">
                            <strong>Name:</strong>
                            {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
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
