<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/default/app.min.css') }}" rel="stylesheet" />
</head>

<body>
    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>

    <div id="app" class="app app-header-fixed app-sidebar-fixed ">

        @include('admin.partials.header')
        @include('admin.partials.sidebar')


        @yield('content')

    </div>



    <script src="{{ asset('assets/js/vendor.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/app.min.js') }}" type="text/javascript"></script>

</body>

</html>
