@extends('layouts.app')
@section('title','沟通科技')

@section('content')
<div class="mdui-container-full">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach($banners as $banner)
            <div class="swiper-slide">
                <a href="{{ $banner->link() }}" style="background-image:url('{{ $banner->banner }}')"></a>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
    @include('common.error')
    <div class="mdui-container">
        <div class="news-nav">
            <ul class="column-nav-ul">
                <li class="{{ active_class(if_route('news.index'), $activeClass = 'active', $inactiveClass = '') }}">
                    <a href="{{ route('news.index') }}">全部</a></li>
                    @foreach($columns as $column)
                <li class="{{ active_class(if_route('columns.show') && if_route_param('column', $column->id), $activeClass = 'active', $inactiveClass = '') }}">
                    <a href="{{ $column->link() }}">{{ $column->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="mdui-divider"></div>
        <div class="mdui-row">
            @foreach($newss as $index => $news)
            <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-4">
                <div class="article-list">
                    <a href="{{ $news->link() }}" target="_blank">
                        <div class="images">
                            <img src="{{ $news->image }}" alt="{{ $news->title }}">
                        </div>
                        <div class="article-header">
                            <div class="article-title">
                                <h3 class="article-title-h3">
                                    {{ $news->title }}
                                </h3>
                            </div>
                            <div class="datetime">
                                <span>{{ $news->updated_at->toDateString() }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination-box">
            {!! $newss->appends(Request::except('page'))->render() !!}
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
    var swiper = new Swiper('.swiper-container', {
        loop: true,
        autoplay: true,
        pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
        },
    });
</script>
@stop