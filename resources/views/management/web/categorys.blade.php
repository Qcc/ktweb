@extends('layouts.club')

@section('title', '栏目管理')

@section('content')
<div class="mdui-container useredit-box">
    <div class="mdui-row">
        <div class="mdui-col-xs-3">
            <div class="edit-item-warp">
                    @include('management._menu_web')
            </div>
        </div>
        <div class="mdui-col-xs-8">
            <div class="edit-action-warp">
                栏目管理
            </div>
        </div>
    </div>
</div>
@stop