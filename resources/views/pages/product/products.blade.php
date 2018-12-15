@extends('layouts.app')
@section('title',$productcol->name)

@section('content')
<div class="mdui-container-full">
    <div class="products-banner-warp">
        <div class="products-banner">
            <img src="{{ $productcol->banner }}" alt="{{ $productcol->name }}">
        </div>
        <div class="products-action">
            <div class="products-head">
                <h2> {{ $productcol->name }}</h2>
                <h4> {{ $productcol->description }}</h4>
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
            <p>{{ $productcol->title }}</p>
        </div>
        <div class="mdui-row product-featrue-arp">
            @foreach($products as $index => $product)
            @break($loop->index > 3)
            <div class="mdui-col-xs-3">
                <div class="product-featrue">
                    <a href="{{ route('product.show',$product->id) }}" target="_blank">
                        <div class="images">
                            <img src="{{ $product->icon }}" alt="{{ $product->title }}">
                        </div>
                        <div class="featrue-point">
                            <p>{{ $product->title }}</p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @foreach($products as $index => $product)
        @continue($loop->index < 4) @if($loop->index % 2 == 1)
            @include('pages.product._pic_left',$product)
            @endif
            @if($loop->index % 2 == 0)
            @include('pages.product._pic_right',$product)
            @endif
        @endforeach
    </div>
    <div>
    @foreach($solutions as $index => $solution)
        <p>
            {{ $solution->title }}
        </p>
    @endforeach
    </div>
    <div>客户案例</div>
</div>

@stop

@section('styles')
<link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}">
@stop

@section('script')
<script src="{{ asset('js/swiper.min.js') }}"></script>

<script>
    $$(document).ready(function () {
        // 初始化首页轮播图
        if ($$('.swiper-container').length === 1) {
            var swiper = new Swiper('.swiper-container', {});
        }
    });
</script>

@stop