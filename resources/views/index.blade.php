<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Styles -->
    <!-- <link href="{{ asset('bootstarp/css/bootstrap.min.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('material-design/material.min.css') }}" rel="stylesheet">
    <link href="{{ asset('animate/animate.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>
    <div class="mdl-layout__container">
        111
    </div>
<!-- @include('wwwlayouts._footer') -->


<script src="{{ asset('bootstarp/js/jquery.min.js') }}"></script>
<!-- <script src="{{ asset('bootstarp/js/popper.min.js') }}"></script> -->
<!-- <script src="{{ asset('bootstarp/js/bootstrap.min.js') }}"></script> -->
<script src="{{ asset('material-design/material.min.js') }}"></script>
<link rel="stylesheet" href="{{ mix('/js/app.js') }}">
</body>
</html>
