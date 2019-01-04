@extends('layouts.app')
@section('title', isset($news->id) ? $news->title : '新建资讯')
@section('content')
<div class="mdui-container" style="margin-top:80px;">
        @include('common.error')
    <div class="article-panel">

        <div class="panel-body">
            <h2 class="head">
                <i class="kticon">&#xe67f;</i>
                @if($news->id)
                编辑资讯
                @else
                新建资讯
                @endif
            </h2>

            <div class="mdui-divider"></div>

            <div class="edit">
                @if($news->id)
                <form action="{{ route('news.update', $news->id) }}" method="POST" accept-charset="UTF-8">
                    <input type="hidden" name="_method" value="PUT">
                    @else
                    <form action="{{ route('news.store') }}" method="POST" accept-charset="UTF-8">
                        @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group select">
                            <select class="mdui-select" mdui-select name="column_id" required>
                                <option value="" hidden disabled {{ $news->id ? '' : 'selected' }}>请选择分类</option>
                                @foreach ($columns as $value)
                                <option value="{{ $value->id }}" {{ $news->column_id == $value->id ? 'selected' : '' }}>
                                    {{$value->name }}</option>
                                @endforeach
                            </select>
                            <label class="mdui-checkbox" title="勾选此项会使用seo表中关键字替换批量生成文章" style="margin-left: 40px;">
                                    <input type="checkbox" name="seo"/>
                                    <i class="mdui-checkbox-icon"></i>
                                    SEO批量生成
                                  </label>
                        </div>

                        <div class="form-group title">
                            <input class="form-control" type="text" name="title" value="{{ old('title', $news->title ) }}"
                                placeholder="请填写标题" required />
                        </div>

                        <div class="form-group title">
                            <input class="form-control" type="text" name="keywords" value="{{ old('keywords', $news->keywords ) }}"
                                placeholder="关键词" required />
                        </div>
                        
                        <div class="form-group title">
                            <input class="form-control" type="text" name="banner" value="{{ old('banner', $news->banner ) }}"
                                placeholder="推荐轮播图（可选）" />
                                <a href="javascript:;" id="upload-banner">上传</a>
                        </div>
                        
                        <div class="form-group images">
                            <div class="layui-upload-list">
                                <img class="layui-upload-img" src="{{ old('image', $news->image ) }}" id="image">
                                <p id="status"></p>
                            </div>
                            <input type="hidden" id="image_path" name="image" value="{{ old('image', $news->image ) }}" required />
                            <a href="javascript:;" class="btn-upload" id="btn_upload">上传首图(640*400)</a>
                        </div>

                        <div class="form-group editor">
                            <textarea name="body" class="form-control" id="editor" rows="3" placeholder="请填入至少三个字符的内容。"
                                required>{{ old('body', $news->body ) }}</textarea>
                        </div>

                        <div class="form-btn">
                            <button type="submit" class="mdui-btn mdui-color-theme-accent mdui-ripple">
                                <i class="kticon">&#xe61f;</i> 发布</button>
                        </div>
                    </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
<style>
    .news-edit-page .kt-nav-header .kt-navigetion-sections, .news-create-page .kt-nav-header .kt-navigetion-sections{
        color: #333;
    }
    .news-create-page .kt-nav-header .kt-nav-background,.news-create-page .kt-nav-header .kt-nav-background{
        background: rgba(255, 255, 255, 0.9);
        border-bottom: 1px solid rgba(200, 200, 200, 0.5);
    }
    .news-create-page .ktm-logo, .news-edit-page .ktm-logo {
    background-image: url(/images/logo-blue.png);
    }
</style>
@stop

@section('script')
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/module.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/hotkeys.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/uploader.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/simditor.min.js') }}"></script>
@stop