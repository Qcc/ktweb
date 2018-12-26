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
                        </div>

                        <div class="form-group title">
                            <input class="form-control" type="text" name="title" value="{{ old('title', $news->title ) }}"
                                placeholder="请填写标题" required />
                        </div>

                        <div class="form-group title">
                            <input class="form-control" type="text" name="keywords" value="{{ old('keywords', $news->keywords ) }}"
                                placeholder="关键词" required />
                        </div>
                        <div class="form-group images">
                            <div class="layui-upload-list">
                                <img class="layui-upload-img" src="{{ old('image', $news->image ) }}" id="image">
                                <p id="status"></p>
                                <a href="javascript:;" class="btn-upload" id="btn_upload">上传首图(640*400)</a>
                            </div>
                            <input type="hidden" id="image_path" name="image" value="{{ old('image', $news->image ) }}" required />
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
<link rel="stylesheet" type="text/css" href="{{ asset('layui/css/layui.css') }}">
<style>
    .news-edit-page .kt-nav-header .kt-navigetion-sections, .news-create-page .kt-nav-header .kt-navigetion-sections{
        color: #333;
    }
    .news-create-page .kt-nav-header .kt-nav-background,.news-create-page .kt-nav-header .kt-nav-background{
        background: rgba(255, 255, 255, 0.9);
        border-bottom: 1px solid rgba(200, 200, 200, 0.5);
    }
</style>
@stop

@section('script')
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/module.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/hotkeys.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/uploader.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/simditor.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/layui/layui.js') }}"></script>

<script>
    $(document).ready(function () {
        var editor = new Simditor({
            textarea: $('#editor'),
            toolbar: ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color',
                '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|',
                'indent', 'outdent', 'alignment'
            ],
            upload: {
                url: "{{ route('news.upload_image') }}",
                //工具条都包含哪些内容
                params: {
                    _token: '{{ csrf_token() }}'
                },
                fileKey: 'upload_file',
                connectionCount: 3,
                leaveConfirm: '文件上传中，关闭此页面将取消上传。'
            },
            pasteImage: true,
        });
        layui.use(['upload','layer'], function () {
            var $ = layui.jquery,
                upload = layui.upload;

            //普通图片上传
            var uploadInst = upload.render({
                elem: '#btn_upload',
                url: "{{ route('news.upload_image') }}",
                field: 'upload_file',
                accept: 'images',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                before: function (obj) {
                    //预读本地文件示例，不支持ie8
                    obj.preview(function (index, file, result) {
                        $('#image').attr('src', result); //图片链接（base64）
                    });
                },
                done: function (res) {
                    //如果上传失败
                    if (res.code > 0) {
                        return layer.msg('上传失败');
                    }
                    $('#image_path').val(res.data.src);
                },
                error: function () {
                    //演示失败状态，并实现重传
                    var demoText = $('#status');
                    demoText.html(
                        '<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs image-reload">重试</a>'
                    );
                    demoText.find('.image-reload').on('click', function () {
                        uploadInst.upload();
                    });
                }
            });
        });
    });
    // <!-- 
    //     pasteImage —— 设定是否支持图片黏贴上传，这里我们使用 true 进行开启；
    // url —— 处理上传图片的 URL；
    // params —— 表单提交的参数，Laravel 的 POST 请求必须带防止 CSRF 跨站请求伪造的 _token 参数；
    // fileKey —— 是服务器端获取图片的键值，我们设置为 upload_file;
    // connectionCount —— 最多只能同时上传 3 张图片；
    // leaveConfirm —— 上传过程中，用户关闭页面时的提醒。
    //  -->
</script>

@stop