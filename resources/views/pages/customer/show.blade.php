@extends('layouts.app')
@section('title',$customer->title)

@section('content')
<div class="mdui-container" style="margin-top:70px;">
    <div class="mdui-row">

        <div class="mdui-col-xs-9 topic-content">
            <div class="navigation">
                <span><a href="{{ route('home') }}">首页</a></span> /
                <span><a href="{{ route('customers.show',$customer->customercol->id) }}">{{ $customer->customercol->name }}</a></span> /
                <span class="now">{{ $customer->title }}</span>
            </div>
            <div class="article-body">
                <div class="article-header">
                    <div class="article-title">
                        <h1 class="article-title-h1">
                            {{ $customer->title }}
                        </h1>
                    </div>
                    <div class="datetime">
                        <span>{{ $customer->updated_at->toDateString() }}</span>
                        <span> {{ $customer->user->nickname }} </span>
                    </div>
                </div>
            </div>
            <div class="mdui-divider"></div>
            <div class="topic-body">{!! $customer->body !!}</div>
            @can('update', $customer)
            <div class="article-edit">
                <a href="{{ route('customer.edit', $customer->id) }}" class="mdui-btn mdui-ripple" role="button">
                    <i class="mdui-icon material-icons">&#xe3c9;</i> 编辑
                </a>
                <form action="{{ route('customer.destroy', $customer->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="mdui-btn mdui-ripple" style="margin-left: 6px">
                        <i class="mdui-icon material-icons">&#xe92b;</i>
                        删除
                    </button>
                </form>
            </div>
            @endcan
        </div>
        <div class="mdui-col-xs-3">
            @include('pages.side_page')
            @include('pages.side_page')
            @include('pages.side_advertising')
        </div>
    </div>
</div>
@include('pages._contact')
@stop

@section('styles')
<style>
    .customer-show-page .kt-nav-header .kt-nav-background {
        background: rgba(255, 255, 255, 0.9);
        border-bottom: 1px solid rgba(200, 200, 200, 0.5);
    }

    .customer-show-page .kt-nav-header .kt-navigetion-sections {
        color: #333;
    }
</style>
@stop