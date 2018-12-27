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
                    </div>
                </form>
        </div>
    </div>
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

<script>
    $(document).ready(function () {
        var editor = new Simditor({
            textarea: $('#editor'),
            toolbar: ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color',
                '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|',
                'indent', 'outdent', 'alignment'
            ],
            upload: {
                url: "{{ route('topics.upload_image') }}",
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