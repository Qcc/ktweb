@extends('layouts.club')

@section('title', '我的私信')

@section('content')
<div class="mdui-container useredit-box">
    <div class="mdui-row">
        <div class="mdui-col-xs-3">
            <div class="edit-item-warp">
                @include('notifications._menu')
            </div>
        </div>
        <div class="mdui-col-xs-8">
            <div class="edit-action-warp">
                <div class="edit-action">
                    @include('common.error')
                    <h2 class="title">
                        <i class="mdui-icon material-icons">&#xe8b8;</i> 发私信
                    </h2>
                    <div class="mdui-divider"></div>
                    <div class="send-avatar">
                        <a href="{{ route('users.show',$user->id) }}" title="发送信息给{{ $user->nickname }}">
                            <img src="{{ $user->avatar}}" alt="用户头像">
                            {{ $user->nickname }}
                        </a>
                    </div>
                    <form action="{{ route('message.send', $user->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">


                        <div class="form-group">
                            <textarea class="form-control" id="message-editor" placeholder="说点儿什么吧!" name="message">
                                        {{ old('message') }}
                                </textarea>
                        </div>
                        <div class="form-btn">
                            <button type="submit" class="mdui-btn mdui-color-theme-accent mdui-ripple">
                                <i class="mdui-icon material-icons">&#xe163;</i> 发送</button>
                        </div>
                    </form>
                    <div class="mdui-divider"></div>
                    @include('notifications._message_list',['messages'=>$conversation->messages])
                </div>
            </div>
        </div>
    </div>
</div>
@stop


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
            textarea: $('#message-editor'),
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