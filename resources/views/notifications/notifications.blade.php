@extends('layouts.club')

@section('title','我的通知')

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