@extends('layouts.app')
@section('title','沟通科技')

@section('content')
<div class="topic-body">{!! $news->body !!}</div>
@can('update', $news)
<div class="article-edit">
    <a href="{{ route('news.edit', $news->id) }}" class="mdui-btn mdui-ripple" role="button">
        <i class="mdui-icon material-icons">&#xe3c9;</i> 编辑
    </a>
    <form action="{{ route('news.destroy', $news->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" class="mdui-btn mdui-ripple" style="margin-left: 6px">
            <i class="mdui-icon material-icons">&#xe92b;</i>
            删除
        </button>
    </form>
</div>
@endcan
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
</style>
@stop