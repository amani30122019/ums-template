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
                        <span class="float-right">
                            <a class="btn btn-primary" id="new-user">New User</a>
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-condensed" id="datatable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.users.modals.show')
    @include('admin.users.modals.create')
    @include('admin.users.modals.edit')
@endsection
@section('script')
    <script>
        $('#create-user-form').parsley();
        $('#edit-user-form').parsley();
    </script>
    <script>
        toastr.options.preventDuplicates = true;
        toastr.options.timeOut = 1500;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        $(function() {
            //show registration form modal
            $('#new-user').on('click', function() {

                $('.createUserModal').modal('show');

            });
            //Register user
            $('#create-user-form').on('submit', function(e) {
                e.preventDefault();
                let form = this
                let fname = $('#fname').val();
                let lname = $('#lname').val();
                let phone = $('#phone').val();
                let email = $('#email').val();
                let password = $('#password').val();
                let cpassword = $('#cpassword').val();
                let role = $('#role').val();
                $.ajax({
                    url: '{{ route('create.user') }}',
                    method: "POST",
                    data: {
                        first_name: capitalizeEveryFirstLetter(fname),
                        last_name: capitalizeEveryFirstLetter(lname),
                        phone: phone,
                        email: email,
                        password: password,
                        cpassword: cpassword,
                        roles: role,
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
                            $("#datatable").DataTable().ajax.reload(null, false);
                            toastr.success(response.msg);
                        }
                    }
                })

            })
            // get all user in datatable
            $("#datatable").DataTable({

                "lengthMenu": [
                    [5, 10, 15, 20, 25, 30, 50, 100, -1],
                    [5, 10, 15, 20, 25, 30, 50, 100, "All"]
                ],
                "pageLength": 10,
                processing: true,
                info: true,
                ajax: "{{ route('index.users') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'actions',
                        name: 'actions'
                    },

                ]
            })
            // get one user details
            $(document).on('click', '#show-user-btn', function() {
                let userId = $(this).data('id');
                let url = '{{ route('show.user') }}';
                $.post(url, {
                        userId: userId
                    },
                    function(result) {
                        $('.showUserModal').find('span.firstname').text(result.user.first_name);
                        $('.showUserModal').find('span.email').text(result.user.email);
                        $('.showUserModal').modal('show');
                    },
                    'json'
                );

            })
            //get  user details in editing modal
            $(document).on('click', '#edit-user-btn', function() {
                var form = this;
                let userId = $(form).data('id');
                let url = '{{ route('edit.user') }}';
                $('.editUserModal').find('form')[0].reset();
                /// $('.editUserModal').find('span.error-text').text('');
                $.post(url, {
                    userId: userId
                }, function(res) {

                    $('.editUserModal').find('input[name="uid"]').val(res.user
                        .id);
                    $('.editUserModal').find('input[name="first_name"]').val(res.user
                        .first_name);
                    $('.editUserModal').find('input[name="last_name"]').val(res.user
                        .last_name);
                    $('.editUserModal').find('input[name="phone"]').val(res.user
                        .phone);
                    $('.editUserModal').find('input[name="email"]').val(res.user
                        .email);
                    $('.editUserModal').find(":selected").val(res.user.roles[0].name).text(res.user
                        .roles[0].name);
                    $('.editUserModal').modal('show');
                }, 'json');

            })
            //updating user info
            $("#edit-user-form").on('submit', function(event) {
                event.preventDefault();
                var form = this;

                $.ajax({
                    url: '{{ route('update.user') }}',
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
                            $("#datatable").DataTable().ajax.reload(null, false);
                            $('.editUserModal').modal('hide');
                            $('.editUserModal').find('form')[0].reset();
                            toastr.success(response.msg);
                        }

                    }
                });
            });

            //delete user
            $(document).on('click', '#delete-user-btn', function() {
                let userId = $(this).data('id');
                let url = '{{ route('delete.user') }}';
                swal.fire({
                    title: "Are you sure?",
                    html: "You want to <b> delete</b> this user",
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
                                userId: userId
                            },
                            function(response) {

                                if (response.code == 0) {
                                    toastr.error(response.error);

                                } else {
                                    $("#datatable").DataTable().ajax.reload(null, false);
                                    toastr.success(response.msg);

                                }

                            }
                        );
                    }
                })

            })

        })

        function capitalizeEveryFirstLetter(str) {
            return str.replace(/\w\S*/g, function(txt) {
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            });
        }
    </script>
@endsection
