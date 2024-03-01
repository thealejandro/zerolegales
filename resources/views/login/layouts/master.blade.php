<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('pageTitle', config('app.name')) | {{ config('app.name') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('admin.layouts.css_header')
    <link rel="shortcut icon" type="image/x-icon"  href="{{asset('assets/images/logo.png')}}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/styles/css/themes/lite-purple.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/custom/css/customstyle.css')}}">
</head>

<body class="text-left">
    <div class="auth-layout-wrap" style="background-image: url(./assets/images/photo-wide-4.jpg)">
    @yield('content')

    <!-- /.login-box -->
    </div>

    <script src="{{asset('assets/js/vendor/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/es5/script.min.js')}}"></script>

    <script src="{{ asset('js/app.js') }}" defer></script>

    @include('admin.layouts.js_footer')
</body>

</html>
