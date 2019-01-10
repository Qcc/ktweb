@extends('layouts.club')
@section('title', isset($topic->id) ? $topic->title : '新建话题')
@section('content')
<div class="mdui-container">
    <div class="article-panel">

        <div class="panel-body">
            <h2 class="head">
                <i class="kticon">&#xe67f;</i>
                @if($topic->id)
                编辑话题
                @else
                新建话题
                @endif
            </h2>

            <div class="mdui-divider"></div>

            @include('common.error')

            @if($topic->id)
            <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
                <input type="hidden" name="_method" value="PUT">
                @else
                <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
                    @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">



                    <div class="form-group select">
                        <select class="mdui-select" mdui-select name="category_id" required>
                            <option value="" hidden disabled {{ $topic->id ? '' : 'selected' }}>请选择分类</option>
                            @foreach ($categories as $value)
                            <option value="{{ $value->id }}" {{ $topic->category_id == $value->id ? 'selected' : '' }}>
                                {{$value->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group title">
                        <input class="form-control" type="text" name="title" value="{{ old('title', $topic->title ) }}"
                            placeholder="请填写标题" required />
                    </div>

                    <div class="form-group">
                        <textarea name="body" class="form-control" id="editor" rows="3" placeholder="请填入至少三个字符的内容。"
                            required>{{ old('body', $topic->body ) }}</textarea>
                    </div>

                    <div class="form-btn">
                        <button type="submit" class="mdui-btn mdui-color-theme-accent mdui-ripple">
                            <i class="kticon">&#xe61f;</i> 发布</button>
                            @can('upload_files')
                        <button class="layui-btn layui-btn-primary layui-btn-sm upload_file" title="上传附件" style="margin-left:30px;"><i class="kticon">&#xe634;</i> 上传附件</button>
                            @endcan
                    </div>
                </form>
        </div>
    </div>
</div>
<div class="select-file-box" style="display:none">

</div>
<div class="upload-file-box" style="display:none">
    <form method="post" class="upload-file-form" id="upload-file-form" style="margin:20px 40px 0;text-align: center;" action="">
        <div class="form-group " id="aetherupload-wrapper">
            <!--组件最外部需要有一个名为aetherupload-wrapper的id，用以包装组件-->
            <div class="controls">
                <input type="file" id="file" onchange="aetherupload(this,'file').success(someCallback).upload()" />
                <!--需要有一个名为file的id，用以标识上传的文件，aetherupload(file,group)中第二个参数为分组名，success方法可用于声名上传成功后的回调方法名-->
                <div class="progress " style="height: 6px;margin-bottom: 2px;margin-top: 10px;">
                    <div id="progressbar" style="background:#5FB878;;height:6px;width:0;"></div>
                    <!--需要有一个名为progressbar的id，用以标识进度条-->
                </div>
                <span style="font-size:12px;color:#aaa;" id="output"></span>
                <!--需要有一个名为output的id，用以标识提示信息-->
                <input type="hidden" name="file1" id="savedpath">
                <!--需要有一个名为savedpath的id，用以标识文件保存路径的表单字段，还需要一个任意名称的name-->
            </div>
        </div>
    </form>
    <form class="layui-form upload-file-sucess" lay-filter="upload-file-sucess" style="margin:20px 40px 0;text-align: center;display:none;" action="">
        <div class="layui-form-item">
            <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入文件名称" class="layui-input name">
            <input type="hidden" name="hash" class="upload-hash">
            <input type="hidden" name="size" class="upload-size">
            <input type="hidden" name="save_name" class="upload-save-name">
            <input type="hidden" name="path" class="upload-path">
            <input type="hidden" name="suffix" class="upload-suffix">
            <input type="hidden" name="logined" class="upload-logined">
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">下载权限</label>
            <div class="layui-input-block">
                <input type="radio" name="logined" value='false' title="开放" checked="">
                <input type="radio" name="logined" value='true' title="登录">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block" style="margin-left:0">
                <button class="layui-btn upload-btn" lay-submit="" lay-filter="upload-btn">添加</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
@stop

@section('script')
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/module.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/hotkeys.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/uploader.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/simditor.min.js') }}"></script>
<script src="{{ URL::asset('js/spark-md5.min.js') }}"></script>
<!--需要引入spark-md5.min.js-->
<script src="{{ URL::asset('js/aetherupload.js') }}"></script>
<!--需要引入aetherupload.js-->
@stop