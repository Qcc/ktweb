@extends('layouts.club')

@section('title', isset($category) ? $category->name : '社区')

@section('content')
@if (!isset($category))
<div class="mdui-container-full club-banner xhs_topic_swiper">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach($clubbanners as $item)
            <div class="swiper-slide">
                <div class="swiper-item" style="background-image:url('{{ $item->banner }}')">
                    <a href="{{ $item->link }}" title="{{ $item->title }}"></a>
                </div>

            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
@endif
<div class="club-warp mdui-container">
    <div class="mdui-row">

        <div class="mdui-col-sm-9 mdui-col-xs-12 topic-list">
            @if (isset($category))
            <div class="category-comment" style="background-image:url('{{ $category->icon }}')">
                <div class="cell">
                    <h3>{{ $category->name }} </h3>
                    <p>{{ $category->description }}</p>
                </div>
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
                    {{-- 话题列表 $tops 为置顶文章--}}
                    @include('topics._topic_list', ['topics' => $topics,'tops'=>$tops])
                    {{-- 分页 --}}
                    <div class="pagination-box mdui-hidden-xs-down">
                        {!! $topics->appends(Request::except('page'))->render() !!}
                    </div>
                    <div class="pagination-simple mdui-hidden-sm-up">
                        {!! $topics->appends(Request::except('page'))->render('vendor.pagination.simple-default') !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="mdui-col-sm-3 sidebar mdui-hidden-sm-down">
            @include('topics._sidebar')
            @include('pages._side_conact')
        </div>
    </div>
</div>

@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}">
@stop

@section('script')
<script src="{{ asset('js/swiper.min.js') }}"></script>
@stop