<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/mdui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')
    
</head>
<body class="mdui-theme-primary-pink mdui-theme-accent-pink">
    <div class="{{ route_class() }}-page">
        @include('layouts._header')
        <div class="mdui-container-full" style="margin-top: 64px;">
            @yield('content')
        </div>    
        @include('layouts._footer')
    </div>
  <script src="{{ asset('js/mdui.min.js') }}"></script>
  <script src="{{ asset('js/swiper.min.js') }}"></script>
  <script src="{{ asset('js/iconfont.js') }}"></script>
  <script src="{{ asset('js/countUp.min.js') }}"></script>
  <script src="{{ asset('js/wow.min.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  @yield('script')
</body>
</html>
