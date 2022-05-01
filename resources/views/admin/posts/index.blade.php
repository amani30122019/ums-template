@extends('admin.app')
@section('content')
    <div id="content" class="app-content">
        <div class="container">
            <div class="justify-content-center">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        @can('post-create')
                            <span class="float-right">
                                <a class="btn btn-primary" id="new-post-button">New post</a>
                            </span>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table table-hover " id="posts-datatable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th width="280px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{!! $post->body !!}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @include('admin.posts.modals.create')
                @include('admin.posts.modals.edit')
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function() {
            // show modal for registering new post
            $('#new-post-button').on('click', function(event) {
                event.preventDefault();
                $('.createPostModal').modal('show')
            });
            //storing data form form modal
            $("#form-create-post").on('submit', function(e) {
                e.preventDefault();
                $('#save').text('Saving.......');
                let form = this;
                let title = $('#title').val();
                let body = $('#body').val();
                $.ajax({
                    url: '{{ route('posts.store') }}',
                    type: "POST",
                    data: {
                        title: title,
                        body: body,
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        $(form).find('span.error-text').text('');
                    },
                    success: function(response) {
                        if (response.code == 0) {
                            $.each(response.errors, function(prefix, val) {
                                $(form).find('span.' + prefix +
                                    '_error').text(val[0]);
                            })
                        } else {
                            $(form).trigger('reset');
                            $('#save').text('Submit');
                            $("#posts-datatable").DataTable().ajax.reload(null, false);
                            toastr.success(response.msg);

                        }
                    }
                })
            })
            // edit post modal
            $(document).on('click', '#edit-post-btn', function(event) {
                event.preventDefault();
                let postId = $(this).data('id');
                $('.editPostModal').find(this).trigger('reset');
                $.ajax({
                    url: '{{ route('post.get') }}',
                    method: "GET",
                    data: {
                        post_id: postId,
                    },
                    dataType: "json",
                    success: function(response) {

                        $('.editPostModal').find('input[name="post_id"]').val(response.post
                            .id);
                        $('.editPostModal').find('input[name="title"]').val(response.post
                            .title);
                        $('.editPostModal').find('textarea[name="body"]').val(response.post
                            .body);

                        $('.editPostModal').modal('show');

                    }
                });
            })
            //updating the post
            $('#form-edit-post').on('submit', function(event) {
                event.preventDefault();
                let form = this
                $.ajax({
                    url: '{{ route('post.update') }}',
                    method: "POST",
                    data: new FormData(form),
                    processData: false,
                    dataType: "json",
                    contentType: false,
                    beforeSend: function() {
                        $(form).find('span.error-text').text('');
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.code == 0) {
                            $.each(response.errors, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            $("#posts-datatable").DataTable().ajax.reload(null, false);
                            $('.editPostModal').modal('hide');
                            toastr.success(response.msg);

                        }

                    }
                });

            });
            // show one post 
            $(document).on('click', '#show-post-btn', function(e) {
                e.preventDefault();
                let postId = $(this).data('id');
                console.log(postId);
                //$('.editPostModal').modal('show');
            })
            // show all posts
            $("#posts-datatable").DataTable({

                "lengthMenu": [
                    [5, 10, 15, 20, 25, 30, 50, 100, -1],
                    [5, 10, 15, 20, 25, 30, 50, 100, "All"]
                ],
                "pageLength": 10,
                processing: true,
                info: true,
                ajax: "{{ route('posts.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'body',
                        name: 'body'
                    },
                    {
                        data: 'actions',
                        name: 'actions'
                    },

                ]
            })
        });
        // delete post
        $(document).on('click', '#delete-post-btn', function(e) {
            e.preventDefault();
            let post_id = $(this).data('id');
            let url = '{{ route('post.delete') }}';
            swal.fire({
                title: "Are you sure?",
                html: "You want to <b> delete</b> this Post",
                showCancelButton: true,
                showCloseButton: false,
                cancelButtonText: "Cancel",
                confirmButtonText: 'Yes, Delete',
                cancelButtonColor: "#0d6efd",
                confirmButtonColor: '#dc3545',
                width: 300,
                allowOutsideClick: false,
            }).then(function(action) {
                if (action.value) {
                    $.post(
                        url, {
                            post_id: post_id
                        },
                        function(response) {

                            if (response.code == 0) {
                                toastr.error(response.error);

                            } else {
                                $("#posts-datatable").DataTable().ajax.reload(null, false);
                                toastr.success(response.msg);

                            }

                        }
                    );
                }
            })

        })
    </script>
@endsection
