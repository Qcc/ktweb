<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
    <meta name="description" content="@yield('description', '深圳市沟通科技有限公司官方网站')" />
    <title>@yield('title') - 深圳市沟通科技有限公司</title>
    <link rel="stylesheet" href="{{ asset('css/mdui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('css/club.css') }}">
    @yield('styles')
    
</head>
<body class="mdui-theme-primary-pink mdui-theme-accent-pink">
    <div class="{{ route_class() }}-page">
        @include('layouts._club_header')
        <div class="mdui-container-full">
            @include('layouts._message')
            @yield('content')
        </div>    
        @include('layouts._footer')
    </div>
  <script src="{{ asset('js/mdui.min.js') }}"></script>
  <script src="{{ asset('js/iconfont.js') }}"></script>
  <script src="{{ asset('js/club.js') }}"></script>
  @if (app()->isLocal())
        @include('sudosu::user-selector')
    @endif
  @yield('script')
</body>
</html>
