<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
    <meta name="description" content="@yield('description', '沟通科技CTBS、云桌面RAS远程接入软件提供移动办公,专业虚拟打印,移动虚拟化,金蝶用友ERP的远程接入解决方案和Citrix替代方案,企业管理软件及ERP云服务商,包括金蝶云服务、云ERP管理软件、云之家移动办公、精斗云财务软件、财务共享，企业上云，行业解决方案等')" />
    <meta name="keywords" content="@yield('keywords', '沟通科技,沟通,CTBS,远程接入,应用虚拟化,金蝶,金蝶云,数字化转型,新零售,SaaS,erp管理系统,财务软件,移动办公,云erp,KIS,企业上云,K/3WISE')" />
    <title>@yield('title')-远程接入-企业管理ERP-财务软件-进销存软件-云服务-应用虚拟化-深圳市沟通科技有限公司</title>
    <link rel="stylesheet" href="{{ asset('layui/css/layui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mdui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="bookmark"href="/favicon.ico" />
    @yield('styles')

</head>

<body class="mdui-theme-primary-indigo mdui-theme-accent-indigo">
    <div class="{{ route_class() }}-page">
        @include('layouts._header')
        <div class="container">
            @include('layouts._message')
            @yield('content')
            <button class="mdui-fab mdui-fab-fixed mdui-color-theme-accent reset-top mdui-ripple"><i class="kticon">&#xe786;</i></button>
        </div>
        @include('layouts._footer')
    </div>
    <script src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
    <script src="{{ asset('layui/layui.js') }}"></script>
    <script src="{{ asset('js/mdui.min.js') }}"></script>
    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <script src="{{ asset('js/countUp.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="//at.alicdn.com/t/font_916960_dsr6fh19j3f.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @includeWhen(app()->environment() === 'production','layouts.baidu_360_js_push')
    @if (app()->isLocal())
    @include('sudosu::user-selector')
    @endif
    @yield('script')
</body>

</html>