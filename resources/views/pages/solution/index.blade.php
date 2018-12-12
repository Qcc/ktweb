@extends('layouts.app')
@section('title','沟通科技')

@section('content')
<div class="mdui-container-full">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div>
                    <img src="{{ asset('images/topics1.jpg') }}" alt="">
                </div>
            </div>
            <div class="swiper-slide">
                <div>
                    <img src="{{ asset('images/topics2.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    @include('common.error')
    <div class="mdui-container">
        <div class="news-nav">
            <ul class="column-nav-ul">
                <li class="{{ active_class(if_route('solution.index')) }}">
                    <a href="{{ route('solution.index') }}">全部</a></li>
                
                <li class="{{ active_class(if_route('columns.show') && if_route_param('column', 1)) }}">
                    <a href="{{ route('columns.show', 1) }}">沟通动态</a></li>

                <li class="{{ active_class((if_route('columns.show') && if_route_param('column', 2)), $activeClass = 'active', $inactiveClass = '') }}">
                    <a href="{{ route('columns.show', 2) }}">行业资讯</a></li>

                <li class="{{ active_class((if_route('columns.show') && if_route_param('column', 3)), $activeClass = 'active', $inactiveClass = '') }}">
                    <a href="{{ route('columns.show', 3) }}">管理智库</a></li>
            </ul>
        </div>
        <div class="mdui-divider"></div>
        <div class="mdui-row">
            @foreach($solutions as $index => $solution)
            <div class="mdui-col-xs-4">
                <div class="article-list">
                    <a href="{{ route('solution.show',$solution->id) }}" target="_blank">
                        <div class="images">
                            <img src="{{ $solution->image }}" alt="{{ $solution->title }}">
                        </div>
                        <div class="article-header">
                            <div class="article-title">
                                <h3 class="article-title-h3">
                                    {{ $solution->title }}
                                </h3>
                            </div>
                            <div class="datetime">
                                <span>{{ $solution->updated_at->toDateString() }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination-box">
            {!! $solutions->appends(Request::except('page'))->render() !!}
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