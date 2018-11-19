<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
    <title>@yield('title')</title>
  <link rel="stylesheet" href="/css/mdui.min.css" type="text/css">
  <link rel="stylesheet" href="/css/swiper.min.css" type="text/css">
  <link rel="stylesheet" href="/css/animate.min.css" type="text/css">
  <link rel="stylesheet" href="/css/iconfont.css" type="text/css">
  <link rel="stylesheet" href="/css/style.css" type="text/css">

</head>
<body class="mdui-theme-primary-pink mdui-theme-accent-pink">
@include('wwwlayouts._header')
    <div class="mdl-layout__container">
        @yield('content')
    </div>
@include('wwwlayouts._footer')
<script src="/js/mdui.min.js"></script>
  <script src="/js/swiper.min.js"></script>
  <script src="/js/iconfont.js"></script>
  <script src="/js/countUp.min.js"></script>
  <script src="/js/wow.min.js"></script>
  <script src="/js/app.js"></script>
</body>
</html>
