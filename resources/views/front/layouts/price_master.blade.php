<!doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no maximum-scale=1">
    <link rel="icon" href="{{asset('front/assets/img/favicon.ico')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ config('app.name') }} | @yield('pageTitle', config('app.name')) </title>
  </head>
  <body class="price-page-wrap">
    <div class="pos-inner-wrap">
    @include('front.layouts.css_header')
    @include('front.layouts.header')
    <div class="save-money-bg">
    </div>
    @yield('content')
    @include('front.layouts.footer')
    @include('front.layouts.js_footer')
    @stack('js')
    </div>
</body>
</html>