@extends('layouts.app')
@section('title', isset($solution->id) ? $solution->title : '新建解决方案')
@section('content')
<div class="mdui-container" style="margin-top:80px;">
    <div class="article-panel">

        <div class="panel-body">
            <h2 class="head">
                <i class="kticon">&#xe67f;</i>
                @if($solution->id)
                编辑解决方案
                @else
                新建解决方案
                @endif
            </h2>

            <div class="mdui-divider"></div>
            <div class="edit">
                @include('common.error')
                @if($solution->id)
                <form action="{{ route('solution.update', $solution->id) }}" method="POST" accept-charset="UTF-8">
                    <input type="hidden" name="_method" value="PUT">
                    @else
                    <form action="{{ route('solution.store') }}" method="POST" accept-charset="UTF-8">
                        @endif

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group select">
                            <select class="mdui-select" mdui-select name="solutioncol_id" required>
                                <option value="" hidden disabled {{ $solution->id ? '' : 'selected' }}>请选择分类</option>
                                @foreach ($solutioncol as $value)
                                <option value="{{ $value->id }}"
                                    {{ $solution->solutioncol_id == $value->id ? 'selected' : '' }}>
                                    {{$value->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group title">
                            <input class="form-control" type="text" name="title" value="{{ old('title', $solution->title ) }}"
                                placeholder="请填写标题" required />
                        </div>

                        <div class="form-group title">
                            <input class="form-control" type="text" name="keywords" value="{{ old('keywords', $solution->keywords ) }}"
                                placeholder="关键词" required />
                        </div>
                        <div class="form-group icon">
                            <div class="layui-upload-list">
                                <img class="layui-upload-icon" src="{{ old('icon', $solution->icon ) }}" id="icon">
                                <p id="status"></p>
                            </div>
                            <input type="hidden" id="icon_path" name="icon" value="{{ old('icon', $solution->icon ) }}"
                            required />
                            <a href="javascript:;" class="btn-icon" id="btn-icon">上传方案着色图标(80*80)</a>
                        </div>
                        <div class="form-group images">
                            <div class="layui-upload-list">
                                <img class="layui-upload-img" src="{{ old('image', $solution->image ) }}" id="image">
                                <p id="status"></p>
                            </div>
                            <input type="hidden" id="image_path" name="image" value="{{ old('image', $solution->image ) }}"
                            required />
                            <a href="javascript:;" class="btn-image" id="btn-image">上传首图(620*300)</a>
                        </div>

                        <div class="form-group point">
                            <textarea name="point" class="form-control" id="pointeditor" rows="3" placeholder="功能点，请填入至少三个字符的内容。"
                                required>{{ old('point', $solution->point ) }}</textarea>
                        </div>

                        <div class="form-group">
                            <textarea name="body" class="form-control" id="editor" rows="3" placeholder="请填入至少三个字符的内容。"
                                required>{{ old('body', $solution->body ) }}</textarea>
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
    .solution-edit-page .kt-nav-header .kt-navigetion-sections, .solution-create-page .kt-nav-header .kt-navigetion-sections{
        color: #333;
    }
    .solution-create-page .kt-nav-header .kt-nav-background,.solution-create-page .kt-nav-header .kt-nav-background{
        background: rgba(255, 255, 255, 0.9);
        border-bottom: 1px solid rgba(200, 200, 200, 0.5);
    }
    .solution-create-page .ktm-logo, .solution-edit-page .ktm-logo {
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