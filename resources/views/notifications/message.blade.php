@extends('layouts.club')

@section('title', '我的私信')

@section('content')
<div class="mdui-container useredit-box">
    <div class="mdui-row">
        <div class="mdui-col-sm-3 mdui-col-xs-12">
            <div class="edit-item-warp">
                    @include('notifications._menu')
            </div>
        </div>
        <div class="mdui-col-sm-8 mdui-col-xs-12">
            <div class="edit-action-warp">
                @if ($conversations->count())
                        @include('notifications._chat_list',['messages'=>$conversations])
                @else
                <div class="empty-block">还没有私信通知！</div>
                @endif
            </div>
        </div>
    </div>
</div>
@stop