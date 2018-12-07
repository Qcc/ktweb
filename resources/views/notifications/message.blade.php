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
                @if ($notifications->count())

                <div class="notification-list">
                    @foreach ($notifications as $notification)
                    @include('notifications.types._' . snake_case(class_basename($notification->type)))
                    @endforeach

                    {!! $notifications->render() !!}
                </div>

                @else
                <div class="empty-block">没有消息通知！</div>
                @endif
            </div>
        </div>
    </div>
</div>
@stop