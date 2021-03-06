@extends('layouts.app')
@section('title',$product->title)
@section('description', $product->excerpt)
@section('keywords', $product->keywords)

@section('content')
<div class="mdui-container" style="margin-top:70px;">
    <div class="mdui-row">

        <div class="mdui-col-xs-12 mdui-col-sm-9 topic-content">
            <div class="navigation">
                <span><a href="{{ route('home') }}">首页</a></span> /
                <span><a href="{{ route('products.show',$product->productcol->id) }}">{{ $product->productcol->name }}</a></span> /
                <span class="now">{{ $product->title }}</span>
            </div>
            <div class="article-body">
                <div class="article-header">
                    <div class="article-title">
                        <h1 class="article-title-h1">
                            {{ $product->title }}
                        </h1>
                    </div>
                    <div class="datetime">
                        <span>{{ $product->updated_at->toDateString() }}</span>
                        <span> {{ $product->user->nickname }} </span>
                    </div>
                </div>
            </div>
            <div class="mdui-divider"></div>
            <div class="topic-body">{!! $product->body !!}</div>
            @can('update', $product)
            <div class="article-edit">
                <a href="{{ route('product.edit', $product->id) }}" class="mdui-btn mdui-ripple" role="button">
                    <i class="kticon">&#xe67f;</i> 编辑
                </a>
                <form action="{{ route('product.destroy', $product->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="mdui-btn mdui-ripple" style="margin-left: 6px">
                        <i class="kticon">&#xe625;</i>
                        删除
                    </button>
                </form>
            </div>
            @endcan
        </div>
        <div class="mdui-col-xs-12 mdui-col-sm-3">
            @include('pages.solution.side_solution',$sulotions)
            @include('pages.customer.side_customer',$customers)
            @include('pages.side_advertising')
        </div>
    </div>
</div>
@include('pages._contact')
@stop

@section('styles')
<style>
    .product-show-page .kt-nav-header .kt-nav-background {
        background: rgba(255, 255, 255, 0.9);
        border-bottom: 1px solid rgba(200, 200, 200, 0.5);
    }

    .product-show-page .kt-nav-header .kt-navigetion-sections {
        color: #333;
    }
    .product-show-page .ktm-logo {
    background-image: url(/images/logo-blue.png);
    }
</style>
@stop