@extends('layouts.app')
@section('title',$solution->title)

@section('content')
<div class="mdui-container" style="margin-top:70px;">
    <div class="mdui-row">

        <div class="mdui-col-xs-12 mdui-col-sm-9 topic-content">
            <div class="navigation">
                <span><a href="{{ route('home') }}">首页</a></span> /
                <span><a href="{{ route('solutions.show',$solution->solutioncol->id) }}">{{ $solution->solutioncol->name }}</a></span> /
                <span class="now">{{ $solution->title }}</span>
            </div>
            <div class="article-body">
                <div class="article-header">
                    <div class="article-title">
                        <h1 class="article-title-h1">
                            {{ $solution->title }}
                        </h1>
                    </div>
                    <div class="datetime">
                        <span>{{ $solution->updated_at->toDateString() }}</span>
                    </div>
                </div>
            </div>
            <div class="mdui-divider"></div>
            <div class="topic-body">{!! $solution->body !!}</div>
            @can('update', $solution)
            <div class="article-edit">
                <a href="{{ route('solution.edit', $solution->id) }}" class="mdui-btn mdui-ripple" role="button">
                    <i class="kticon">&#xe67f;</i> 编辑
                </a>
                <form action="{{ route('solution.destroy', $solution->id) }}" method="post">
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
                @include('pages.product.side_product',$products)
                @include('pages.customer.side_customer',$customers)
            @include('pages.side_advertising')
        </div>
    </div>
</div>
@include('pages._contact')
@stop

@section('styles')
<style>
    .solution-show-page .kt-nav-header .kt-nav-background {
        background: rgba(255, 255, 255, 0.9);
        border-bottom: 1px solid rgba(200, 200, 200, 0.5);
    }

    .solution-show-page .kt-nav-header .kt-navigetion-sections {
        color: #333;
    }
    .solution-show-page .ktm-logo {
    background-image: url(/images/logo-blue.png);
    }
</style>
@stop