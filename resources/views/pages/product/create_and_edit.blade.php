@extends('layouts.app')
@section('title', isset($product->id) ? $product->title : '新建产品介绍')
@section('content')
<div class="mdui-container" style="margin-top:80px;">
    @include('common.error')
    <div class="article-panel">
        <div class="panel-body">
            <h2 class="head">
                <i class="kticon">&#xe67f;</i>
                @if($product->id)
                编辑产品介绍
                @else
                新建产品介绍
                @endif
            </h2>

            <div class="mdui-divider"></div>
            <div class="edit">
                @if($product->id)
                <form action="{{ route('product.update', $product->id) }}" method="POST" accept-charset="UTF-8">
                    <input type="hidden" name="_method" value="PUT">
                @else
                <form action="{{ route('product.store') }}" method="POST" accept-charset="UTF-8">
                @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group select">
                            <select class="mdui-select" mdui-select name="productcol_id" required>
                                <option value="" hidden disabled {{ $product->productcol_id ? '' : 'selected' }}>请选择分类</option>
                                @foreach ($productcol as $value)
                                <option value="{{ $value->id }}"
                                    {{ $product->productcol_id == $value->id ? 'selected' : '' }}>
                                    {{$value->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group title">
                            <input class="form-control" type="text" name="title" value="{{ old('title', $product->title ) }}"
                                placeholder="请填写标题" required />
                        </div>

                        <div class="form-group title">
                            <input class="form-control" type="text" name="keywords" value="{{ old('keywords', $product->keywords ) }}"
                                placeholder="关键词" required />
                        </div>
                        <div class="form-group icon-input">
                                <div class="layui-upload-list">
                                        <img class="layui-upload-icon" src="{{ old('icon', $product->icon ) }}" id="icon">
                                        <p id="status"></p>
                                    </div>
                                    <input type="hidden" id="icon_path" name="icon" value="{{ old('icon', $product->icon ) }}" required />
                                    <a href="javascript:;" class="btn-icon" id="btn-icon">上传功能着色图标(80*80)</a>
                        </div>
                        <div class="form-group images">
                                <div class="layui-upload-list">
                                    <img class="layui-upload-img" src="{{ old('image', $product->image ) }}" id="image">
                                    <p id="status"></p>
                                </div>
                                <input type="hidden" id="image_path" name="image" value="{{ old('image', $product->image ) }}" required />
                                <a href="javascript:;" class="btn-image" id="btn-image">上传首图(620*300)</a>
                            </div>


                        <div class="form-group point">
                            <textarea name="point" class="form-control" id="pointeditor" rows="3" placeholder="功能点，请填入至少三个字符的内容。"
                                required>{{ old('point', $product->point ) }}</textarea>
                        </div>

                        <div class="form-group">
                            <textarea name="body" class="form-control" id="editor" rows="3" placeholder="功能详情描述，请填入至少三个字符的内容。"
                                required>{{ old('body', $product->body ) }}</textarea>
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
    .product-edit-page .kt-nav-header .kt-navigetion-sections, .product-create-page .kt-nav-header .kt-navigetion-sections{
        color: #333;
    }
    .product-create-page .kt-nav-header .kt-nav-background,.product-create-page .kt-nav-header .kt-nav-background{
        background: rgba(255, 255, 255, 0.9);
        border-bottom: 1px solid rgba(200, 200, 200, 0.5);
    }
    .product-create-page .ktm-logo, .product-edit-page .ktm-logo {
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