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
    <div class="mdui-container">
        <div class="featrue-warp">

        </div>
        <div class="mdui-divider"></div>
        <div class="mdui-row">
            @foreach($products as $index => $product)
            @if($loop->index < 4) <div class="mdui-col-xs-3">
                <div class="article-list">
                    <a href="{{ route('product.show',$product->id) }}" target="_blank">
                        <div class="images">
                            <img src="{{ $product->icon }}" alt="{{ $product->title }}">
                        </div>
                        <div class="article-header">
                            <div class="article-title">
                                <h3 class="article-title-h3">
                                    {{ $product->title }}
                                </h3>
                            </div>
                            <div class="datetime">
                                <span>{{ $product->updated_at->toDateString() }}</span>
                            </div>
                        </div>
                    </a>
                </div>
        </div>
        @endif
        @if($loop->index == 4)
        <div class="mdui-col-xs-6">
            <div class="article-list">
                <a href="{{ route('product.show',$product->id) }}" target="_blank">
                    <div class="images">
                        <img src="{{ $product->image }}" alt="{{ $product->title }}">
                    </div>
                </a>
            </div>
            <div class="mdui-col-xs-6">
                <div class="article-header">
                    <div class="article-title">
                        <h3 class="article-title-h3">
                            {{ $product->title }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($loop->index == 5)
        <div class="mdui-col-xs-6">
            <div class="mdui-col-xs-6">
                <div class="article-header">
                    <div class="article-title">
                        <h3 class="article-title-h3">
                            {{ $product->title }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="article-list">
                <a href="{{ route('product.show',$product->id) }}" target="_blank">
                    <div class="images">
                        <img src="{{ $product->image }}" alt="{{ $product->title }}">
                    </div>
                </a>
            </div>

        </div>
        @endif
        @endforeach
    </div>
    <div class="pagination-box">
        {!! $products->appends(Request::except('page'))->render() !!}
    </div>
</div>
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