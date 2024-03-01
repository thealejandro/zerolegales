<!doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{asset('front/assets/img/favicon.ico')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ config('app.name') }} | @yield('pageTitle', config('app.name')) </title>
  </head>
  <body class="mailverify-wrap">
    @include('front.layouts.css_header')
    @include('front.layouts.header')
    @yield('content')
    @include('front.layouts.footer')
    @include('front.layouts.js_footer')
    @stack('js')
    </div>
</body>
</html>