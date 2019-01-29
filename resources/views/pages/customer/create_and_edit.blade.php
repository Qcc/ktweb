@extends('layouts.app')
@section('title', isset($customer->id) ? $customer->title : '新建客户案例')
@section('content')
<div class="mdui-container" style="margin-top:80px;">
    <div class="article-panel">

        <div class="panel-body">
            <h2 class="head">
                <i class="kticon">&#xe67f;</i>
                @if($customer->id)
                编辑客户案例
                @else
                新建客户案例
                @endif
            </h2>

            <div class="mdui-divider"></div>
            <div class="edit">
                @include('common.error')
                @if($customer->id)
                <form action="{{ route('customer.update', $customer->id) }}" method="POST" accept-charset="UTF-8">
                    <input type="hidden" name="_method" value="PUT">
                    @else
                    <form action="{{ route('customer.store') }}" method="POST" accept-charset="UTF-8">
                        @endif

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">



                        <div class=" form-group customer-select">
                            <select class="mdui-select" mdui-select name="customercol_id" required>
                                <option value="" hidden disabled {{ $customer->customercol_id ? '' : 'selected' }}>请选择客户行业</option>
                                @foreach ($customercol as $value)
                                <option value="{{ $value->id }}"
                                    {{ $customer->customercol_id == $value->id ? 'selected' : '' }}>
                                    {{$value->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class=" form-group customer-select">
                            <select class="mdui-select" mdui-select name="productcol_id" required>
                                <option value="" hidden disabled {{ $customer->id ? '' : 'selected' }}>请选择相关产品</option>
                                @foreach ($productcol as $value)
                                <option value="{{ $value->id }}"
                                    {{ $customer->productcol_id == $value->id ? 'selected' : '' }}>
                                    {{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" form-group customer-select">
                            <select class="mdui-select" mdui-select name="solutioncol_id" required>
                                <option value="" hidden disabled {{ $customer->id ? '' : 'selected' }}>请选择相关解决方案</option>
                                @foreach ($solutioncol as $value)
                                <option value="{{ $value->id }}"
                                    {{ $customer->solutioncol_id == $value->id ? 'selected' : '' }}>
                                    {{$value->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group title">
                            <input class="form-control" type="text" name="name" value="{{ old('name', $customer->name ) }}"
                                placeholder="请填公司名称" required />
                        </div>

                        <div class="form-group title">
                            <input class="form-control" type="text" name="title" value="{{ old('title', $customer->title ) }}"
                                placeholder="请填写标题" required />
                        </div>

                        <div class="form-group title">
                            <input class="form-control" type="text" name="keywords" value="{{ old('keywords', $customer->keywords ) }}"
                                placeholder="关键词" required />
                        </div>
                        <div class="form-group title">
                            <input class="form-control" type="text" name="banner" value="{{ old('banner', $customer->banner ) }}"
                                placeholder="banner推荐1920*464 可选" />
                                <a href="javascript:;" id="upload-banner">上传</a>
                        </div>

                        <div class="form-group images" style="top:0">
                            <div class="layui-upload-list">
                                <img class="layui-upload-img" src="{{ old('image', $customer->image ) }}" id="image">
                                <p id="status"></p>
                            </div>
                            <input type="hidden" id="image_path" name="image" value="{{ old('image', $customer->image ) }}"
                            required />
                            <a href="javascript:;" class="btn-image" id="btn-image">上传首图(620*300)</a>
                        </div>

                        <div class="form-group">
                            <textarea name="body" class="form-control" id="editor" rows="3" placeholder="请填入至少三个字符的内容。"
                                required>{{ old('body', $customer->body ) }}</textarea>
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
    .customer-edit-page .kt-nav-header .kt-navigetion-sections, .customer-create-page .kt-nav-header .kt-navigetion-sections{
        color: #333;
    }
    .customer-create-page .kt-nav-header .kt-nav-background,.customer-create-page .kt-nav-header .kt-nav-background{
        background: rgba(255, 255, 255, 0.9);
        border-bottom: 1px solid rgba(200, 200, 200, 0.5);
    }
    .customer-create-page .ktm-logo, .customer-edit-page .ktm-logo {
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