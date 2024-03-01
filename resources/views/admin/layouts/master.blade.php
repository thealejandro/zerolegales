<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle',config('app.name'))</title>
    @include('admin.layouts.css_header')
    <link rel="shortcut icon" type="image/x-icon"  href="{{asset('assets/images/logo.png')}}">

    @stack('css')
</head>

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large clearfix">

        @include('admin.layouts.header')

        <!-- /.navbar -->
        @include('admin.layouts.sidebar')


        <!-- Content Wrapper. Contains page content -->
        <div class="main-content-wrap sidenav-open d-flex flex-column">

            @yield('content')
        
        <!-- /.content-wrapper -->



        <!-- @include('admin.layouts.footer') -->
        </div>  
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    @include('admin.layouts.js_footer')
    @stack('js')

</body>

</html>
