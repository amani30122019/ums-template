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
                        @can('permission-create')
                            <span class="float-right">
                                <a class="btn btn-primary" id="create-user">New Permission</a>
                            </span>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-condensed" id="permission-datatable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Permission Name</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $key => $permission)
                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.permissions.modals.create')
    @include('admin.permissions.modals.edit')
@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        $(function() {
            // new user modal
            $('#create-user').on('click', function() {
                $('.createPermissionModal').modal('show');
            });
            //Register user
            $('#create-permission-form').on('submit', function(e) {
                e.preventDefault();
                let form = this
                let name = $('#permission').val();

                $.ajax({
                    url: '{{ route('create.permission') }}',
                    method: "POST",
                    data: {
                        name: name
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
                            $(form)[0].reset();
                            $("#permission-datatable").DataTable().ajax.reload(null, false);
                            toastr.success(response.msg);
                        }
                    }
                })

            })
            // get all user in datatable
            $("#permission-datatable").DataTable({

                "lengthMenu": [
                    [5, 10, 15, 20, 25, 30, 50, 100, -1],
                    [5, 10, 15, 20, 25, 30, 50, 100, "All"]
                ],
                "pageLength": 5,
                processing: true,
                info: true,
                ajax: "{{ route('index.permissions') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'actions',
                        name: 'actions'
                    },

                ]
            })

            //get  permission details in editing modal
            $(document).on('click', '#edit-permission-btn', function() {
                var form = this;
                let permissionId = $(form).data('id');
                let url = '{{ route('edit.permission') }}';
                $('.editPermissionModal').find('form')[0].reset();
                $('.editPermissionModal').find('span.error-text').text('');
                $.post(url, {
                    permissionId: permissionId
                }, function(res) {

                    $('.editPermissionModal').find('input[name="pid"]').val(res.permission
                        .id);
                    $('.editPermissionModal').find('input[name="permission_name"]').val(res
                        .permission.name
                    );
                    $('.editPermissionModal').modal('show');
                }, 'json');

            })
            //updating user info
            $("#edit-permission-form").on('submit', function(event) {
                event.preventDefault();
                var form = this;
                $.ajax({
                    url: '{{ route('update.permission') }}',
                    method: "POST",
                    data: new FormData(form),
                    processData: false,
                    dataType: 'json',
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
                            $("#permission-datatable").DataTable().ajax.reload(null, false);
                            $('.editPermissionModal').modal('hide');
                            $('.editPermissionModal').find('form')[0].reset();
                            toastr.success(response.msg);
                        }

                    }
                });
            });

            //delete user
            $(document).on('click', '#delete-permission-btn', function() {
                let permissionId = $(this).data('id');
                let url = '{{ route('delete.permission') }}';
                swal.fire({
                    title: "Are you sure?",
                    html: "You want to <b> delete</b> this permission",
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
                                permissionId: permissionId
                            },
                            function(response) {

                                if (response.code == 0) {
                                    toastr.error(response.error);

                                } else {
                                    $("#permission-datatable").DataTable().ajax.reload(null,
                                        false);
                                    toastr.success(response.msg);

                                }

                            }
                        );
                    }
                })

            })

        });
    </script>
@endsection
