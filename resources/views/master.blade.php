<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    <title>User list</title>
    @yield('styles')
</head>

<body>
    <div class="wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @yield('content')
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <!-- REQUIRED SCRIPTS -->
    <script src="{{ mix('js/app.js') }}"></script>

    @yield('modal')
    @yield('scripts')
</html>