@extends('layouts.app')
@section('title',$productcol->name)

@section('content')
<div class="container">
    <div class="products-banner-warp">
        <div class="products-banner">
            @if($productcol->icon)
            <img class="product-icon" src="{{ $productcol->icon }}" alt="{{ $productcol->title }}">
            @endif
            @if($productcol->banner)
            <img src="{{ $productcol->banner }}" alt="{{ $productcol->name }}">
            @endif
        </div>
        <div class="products-action">
            <div class="products-head">
                <h2> {{ $productcol->name }}</h2>
                <h4> {{ $productcol->description }}</h4>
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
            <p>{{ $productcol->title }}</p>
        </div>
        <div class="mdui-row product-featrue-arp">
            @foreach($products as $index => $product)
            @break($loop->index > 3)
            <div class="mdui-col-sm-3 mdui-col-xs-6">
                <div class="product-featrue">
                    <a href="{{ $product->link() }}" target="_blank">
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
    <div class="solution-warp">
        <div class="solution-title">
            <p>{{ $productcol->name }}解决方案</p>
        </div>
        <div id="solutionSwiper" class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($solutions as $index => $solution)
                <div class="swiper-slide">
                    <div class="swiper-background"></div>
                    <div class="swiper-image">
                        <img src="{{ $solution->image }}" alt="{{ $solution->title }}">
                    </div>
                    <div class="info">
                        <div class="date">{{ $productcol->name }}解决方案</div>
                        <h3><a href="{{ route('solution.show', $solution->id) }}">{{ $solution->title }}</a></h3>
                        <p>{{ $solution->excerpt }}</p>
                        <a href="{{ route('solution.show', $solution->id) }}" class="btn">详情</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-prev"><i class="kticon">&#xe779;</i></div>
            <div class="swiper-button-next"><i class="kticon">&#xe638;</i></div>
        </div>
    </div>
    <div class="mdui-container customer-warp">
        <div class="customer-title">
            <p>看看他们如何使用{{ $productcol->name }}</p>
        </div>
        <div class="mdui-row customer-list">
            @foreach($customers as $index => $customer)
            <div class="mdui-col-xs-12 mdui-col-sm-3">
                <div class=" customer-item">
                    <div class="customer-img">
                        <a href="{{ route('customer.show',$customer->id) }}">
                            <img src="{{ $customer->image }}" alt="{{ $customer->title }}">
                        </a>
                    </div>
                    <div class="customer-col">
                        <a href="{{ route('customer.index')}}?order=profession&particular={{$customer->customercol->id}}">{{
                            $customer->customercol->name }}</a>
                        <span> | </span>
                        <a href="{{ route('customer.show',$customer->id) }}">{{ $customer->name }}</a>
                    </div>
                    <div class="customer-body">
                        <a href="{{ route('customer.show',$customer->id) }}">
                            <p>{{ $customer->title }} </p>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
</div>
@include('pages._contact')
@stop

@section('styles')
<link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}">
@stop

@section('script')
<script src="{{ asset('js/swiper.min.js') }}"></script>
@stop