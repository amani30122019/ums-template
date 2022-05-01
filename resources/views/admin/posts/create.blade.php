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
                    <div class="card-header">Create post
                        <span class="float-right">
                            <a class="btn btn-primary" href="{{ route('posts.index') }}">Posts</a>
                        </span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('posts.store') }}" method="post" data-parsley-validate
                            id="form-create-post">
                            @csrf
                            <div class="form-group">
                                <strong>Title:</strong>
                                <input type="text" name="title" class="form-control" placeholder="Title"
                                    data-parsley-required>
                            </div>
                            <div class="form-group mt-3">
                                <strong>Body:</strong>
                                <textarea name="body" id="editor" cols="30" rows="10" class="form-control" placeholder="Type here the body message"
                                    data-parsley-required></textarea>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $('#form-create-post').parsley();
        })
    </script>
@endsection
