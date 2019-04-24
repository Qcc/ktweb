@extends('layouts.app')
@section('title',$news->title)
@section('description', $news->excerpt)
@section('keywords', $news->keywords)

@section('content')
<div class="mdui-container" style="margin-top:70px;">
    <div class="mdui-row">

        <div class="mdui-col-xs-12 mdui-col-sm-9 topic-content">
            <div class="navigation">
                <span><a href="{{ route('home') }}">首页</a></span> /
                <span><a href="{{ $news->column->link() }}">{{ $news->column->name }}</a></span> /
                <span class="now">{{ $news->title }}</span>
            </div>
            <div class="article-body">
                <div class="article-header">
                    <div class="article-title">
                        <h1 class="article-title-h1">
                            {{ $news->title }}
                        </h1>
                    </div>
                    <div class="datetime">
                        <span>{{ $news->updated_at->toDateString() }}</span>
                        <span> {{ $news->user->nickname }} </span>
                    </div>
                </div>
            </div>
            <div class="mdui-divider"></div>
            <div class="topic-body">{!! $news->body !!}</div>
            @can('update', $news)
            <div class="article-edit">
                <a href="{{ route('news.edit', $news->id) }}" class="mdui-btn mdui-ripple" role="button">
                    <i class="kticon">&#xe67f;</i> 编辑
                </a>
                <form action="{{ route('news.destroy', $news->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="mdui-btn mdui-ripple" style="margin-left: 6px">
                        <i class="kticon">&#xe625;</i>
                        删除
                    </button>
                </form>
            </div>
            @endcan
            <div class="layui-row">
                    <div class="layui-col-xs6">
                @if($pagination['previous'])
                  <p>上一篇：<a href="{{ $pagination['previous']->link() }}">{{ $pagination['previous']->title }}</a></p>
                @endif
                    </div>
                    <div class="layui-col-xs6">
                @if($pagination['next'])
                  <p style="text-align: right;">下一篇：<a href="{{ $pagination['next']->link() }}">{{ $pagination['next']->title }}</a></p>
                @endif
                    </div>
            </div>
            <hr>
            <div class="layui-row business">
                <div class="title">金蝶软件让工作更高效，免费试用！</div>
                <div class="layui-col-xs12 layui-col-md6">
                    <form class="layui-form" id="buy-form" lay-filter="buy-form" method="POST" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="type" value="终端客户">
                        <div class="layui-form-item">
                          <div class="layui-input-block">
                            <input type="text" name="name" lay-verify="required|title" autocomplete="off" placeholder="请输入姓名" class="layui-input">
                          </div>
                        </div>
                        <div class="layui-form-item">
                          <div class="layui-input-block">
                            <input type="tel" name="phone" lay-verify="required|phone" autocomplete="off" placeholder="请输入手机号" class="layui-input">
                          </div>
                        </div>
                        <div class="layui-form-item">
                          <div class="layui-input-block">
                                <button class="layui-btn buy-btn" lay-submit="" lay-filter="buy-btn">立即提交</button>
                          </div>
                        </div>
                    </form>
                </div>
                <div class="layui-col-md6">
                    <div class="jdy">
                        <div><a href="{{ route('products.show',6) }}"> 精斗云</a></div>
                        <div>精斗云为您提供完整的在线服务包，功能覆盖财务、新零售、电商、订货等领域帮助您更好地找生意、更便利地做生意、更高效地管生意， 让您的生意遍布全国</div>
                        <div><a href="{{ route('products.show',6) }}">进一步了解>></a></div>
                    </div>
                </div>
            </div>
            <div class="moore-news">
                <div class="title">更多文章</div>
                <hr>
                @foreach($morePage as $moreNews)
                    <div class="layui-row news ">
                        <div class="layui-col-xs12 layui-col-md3 left"><a href="{{ $moreNews->link() }}" target="_blank"><img src="{{ $moreNews->image }}" alt="{{ $moreNews->title }}"></a></div>
                        <div class="layui-col-xs12 layui-col-md9 right">
                            <div class="title"><a href="{{ $moreNews->link() }}" target="_blank">{{ $moreNews->title }}</a></div>
                            <div class="exp">{{ $moreNews->excerpt }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mdui-col-xs-12 mdui-col-sm-3">
                @include('pages.side_advertising')
                @include('pages.product.side_product',$products)
                @include('pages.customer.side_customer',$customers)
        </div>
    </div>
</div>
@stop

@section('styles')
<style>
    .news-show-page .kt-nav-header .kt-nav-background {
        background: rgba(255, 255, 255, 0.9);
        border-bottom: 1px solid rgba(200, 200, 200, 0.5);
    }

    .news-show-page .kt-nav-header .kt-navigetion-sections {
        color: #333;
    }
    .news-show-page .ktm-logo {
    background-image: url(/images/logo-blue.png);
    }
</style>
@stop