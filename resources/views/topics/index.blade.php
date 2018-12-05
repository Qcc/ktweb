@extends('layouts.club')

@section('title', isset($category) ? $category->name : '社区')

@section('content')
@if (!isset($category))
<div class="mdui-container-full club-banner">
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
</div>
@endif
<div class="club-warp mdui-container">
    <div class="mdui-row">

        <div class="mdui-col-xs-9 topic-list">

            @if (isset($category))
            <div class="alert alert-info" role="alert">
                {{ $category->name }} ：{{ $category->description }}
            </div>
            @endif

            <div class="club-panel">
                <div class="panel-heading mdui-clearfix">
                    <ul class="club-nav-pills">
                        <!-- Request::url() 获取的是当前请求的 URL -->
                        <li role="presentation" class="active"><a class="mdui-text-color-blue" href="{{ Request::url() }}?order=default">最后回复</a></li>
                        <li role="presentation"><a class="mdui-text-color-blue" href="{{ Request::url() }}?order=recent">最新发布</a></li>
                    </ul>
                </div>

                <div class="club-panel-body">
                    {{-- 话题列表  $tops 为置顶文章--}}
                    @include('topics._topic_list', ['topics' => $topics,'tops'=>$tops])
                    {{-- 分页 --}}
                    <div class="pagination-box">
                        {!! $topics->appends(Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="mdui-col-xs-3 sidebar">
            @include('topics._sidebar')
        </div>
    </div>
</div>

@endsection

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