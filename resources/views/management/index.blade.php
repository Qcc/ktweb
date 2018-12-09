@extends('layouts.club')

@section('title', '我的私信')

@section('content')
<div class="mdui-container useredit-box">
    <div class="mdui-row">
        <div class="mdui-col-xs-3">
            <div class="edit-item-warp">
                    @include('management._menu')
            </div>
        </div>
        <div class="mdui-col-xs-8">
            <div class="edit-action-warp">
                暂无内容
            </div>
        </div>
    </div>
</div>
@stop