@extends('layouts.club')

@section('title', '我的私信')

@section('content')
<div class="mdui-container useredit-box">
    <div class="mdui-row">
        <div class="mdui-col-xs-3">
            <div class="edit-item-warp">
                <div class="edit-item">
                    <ul class="edit-list">
                        <li><a href="{{ route('notifications.message') }}" class="mdui-btn mdui-ripple mdui-color-theme-accent">
                                <i class="mdui-icon material-icons">&#xe0e1;</i> 私信</a></li>
                        <li><a href="{{ route('notifications.notice') }}" class="mdui-btn  mdui-ripple">
                                <i class="mdui-icon material-icons">&#xe7f5;</i> 通知</a></li>
                        <li><a href="{{ route('notifications.system') }}" class="mdui-btn mdui-ripple"><i class="mdui-icon material-icons">&#xe050;</i>
                                系统</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="mdui-col-xs-8">
            <div class="edit-action-warp">
                <form action="{{ route('users.update', $user->id) }}" method="POST" accept-charset="UTF-8">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {{ $user->username }}

                    <div class="form-group">
                        <div class="mdui-textfield mdui-textfield-floating-label">
                            <label class="mdui-textfield-label">真实姓名</label>
                            <input class="mdui-textfield-input {{ $user->company?'disabled':'' }}" type="text" name="username"
                                {{ $user->username?'readonly':'' }} value="{{ old('username',$user->username) }}" />
                            <div class="mdui-textfield-helper">请输入姓名,保存后不能再修改，请谨慎操作</div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@stop