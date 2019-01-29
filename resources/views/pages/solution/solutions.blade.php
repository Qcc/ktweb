@extends('layouts.app')
@section('title',$solutioncol->name)

@section('content')
<div class="container">
    <div class="products-banner-warp">
        <div class="products-banner">
            @if($solutioncol->banner)
            <img src="{{ $solutioncol->banner }}" alt="{{ $solutioncol->name }}">
            @endif
            @if($solutioncol->icon)
            <img class="product-icon" src="{{ $solutioncol->icon }}" alt="{{ $solutioncol->title }}">
            @endif
        </div>
        <div class="products-action">
            <div class="products-head">
                <h2> {{ $solutioncol->name }}</h2>
                <h4> {{ $solutioncol->description }}</h4>
            </div>
            <div class="products-btn">
                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ cache('online_service')??'100934166' }}&site=qq&menu=yes" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">在线咨询</a>
                <a href="{{ route('business.tryout') }}" target="_blank" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-white">现在试用</a>
            </div>
        </div>
    </div>
    @include('common.error')
    <div class="mdui-container-fluid featrue-arp">
        <div class="featrue-title">
            <p>{{ $solutioncol->title }}</p>
        </div>
        <div class="mdui-row product-featrue-arp">
            @foreach($solutions as $index => $solution)
            @break($loop->index > 3)
            <div class="mdui-col-xs-6 mdui-col-md-3">
                <div class="product-featrue">
                    <a href="{{ $solution->link() }}" target="_blank">
                        <div class="images">
                            <img src="{{ $solution->icon }}" alt="{{ $solution->title }}">
                        </div>
                        <div class="featrue-point">
                            <p>{{ $solution->title }}</p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @foreach($solutions as $index => $solution)
        @continue($loop->index < 4) @if($loop->index % 2 == 1)
            @include('pages.solution._pic_left',$solution)
            @endif
            @if($loop->index % 2 == 0)
            @include('pages.solution._pic_right',$solution)
            @endif
            @endforeach
    </div>
</div>
@include('pages._contact')
@stop