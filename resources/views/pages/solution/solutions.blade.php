@extends('layouts.app')
@section('title',$solutioncol->name)

@section('content')
<div class="mdui-container-full">
    <div class="products-banner-warp">
        <div class="products-banner">
            <img src="{{ $solutioncol->banner }}" alt="{{ $solutioncol->name }}">
        </div>
        <div class="products-action">
            <div class="products-head">
                <h2> {{ $solutioncol->name }}</h2>
                <h4> {{ $solutioncol->description }}</h4>
            </div>
            <div class="products-btn">
                <a class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">在线咨询</a>
                <a class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-white">相关方案</a>
            </div>
        </div>
    </div>
    @include('common.error')
    <div class="mdui-container-full featrue-arp">
        <div class="featrue-title">
            <p>{{ $solutioncol->title }}</p>
        </div>
        <div class="mdui-row product-featrue-arp">
            @foreach($solutions as $index => $solution)
            @break($loop->index > 3)
            <div class="mdui-col-xs-3">
                <div class="product-featrue">
                    <a href="{{ route('product.show',$solution->id) }}" target="_blank">
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

@section('styles')
<link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}">
@stop

@section('script')
<script src="{{ asset('js/swiper.min.js') }}"></script>

<script>
    $$(document).ready(function () {
        $$(document).ready(function () {
        // 初始化首页轮播图
        if ($$('.swiper-container').length === 1) {
            var solutionSwiper = new Swiper ('#solutionSwiper', {
              centeredSlides : true,
            	slidesPerView : 'auto',
                spaceBetween : 40,
                loop : true,
                autoplay:true,
              navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
              },
            }) 
        }
        });
    });
</script>
@stop