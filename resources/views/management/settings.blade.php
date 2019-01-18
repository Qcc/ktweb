@extends('layouts.club')

@section('title', '网站设置')

@section('content')
<div class="mdui-container useredit-box">
    <div class="mdui-row">
        <div class="mdui-col-xs-3">
            <div class="edit-item-warp">
                @include('management._menu_club')
            </div>
        </div>
        <div class="mdui-col-xs-8">
            <div class="edit-action-warp">
                <div>
                    <p>全站侧边栏广告</p>
                </div>
                <table lay-filter="advertising-table" id="advertising-table">
                    <thead>
                        <tr>
                            <th lay-data="{field:'id', width:40}">ID</th>
                            <th lay-data="{field:'key', width:70}">key</th>
                            <th lay-data="{field:'link'}">链接</th>
                            <th lay-data="{field:'banner'}">图片</th>
                            <th lay-data="{field:'title'}">标题</th>
                            <th lay-data="{toolbar: '#barAction', width:110}">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($advertisings as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->key }}</td>
                            <td>{{ $item->link }}</td>
                            <td>{{ $item->banner }}</td>
                            <td>{{ $item->title }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <form class="layui-form" method="POST" action="{{ route('admin.club.setting.onlineService') }}">
                    <div class="layui-form-item">
                        <label class="layui-form-label">网站客服QQ</label>
                        <div class="layui-input-inline">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="text" name="qq" lay-verify="number" autocomplete="off" placeholder="请输入QQ号"
                                class="layui-input" value="{{ cache('online_service') }}">
                        </div>
                        <button class="layui-btn" lay-submit="" lay-filter="service-btn">保存</button>
                    </div>
                </form>
                
            </div>
        </div>

    </div>
</div>
<form class="layui-form" id="advertising-form" lay-filter="advertising-form" style="display:none;margin-right: 80px;">

    <div class="layui-form-item">
        <div class="layui-input-inline">
            <input type="hidden" name="id">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">图片</label>
        <div class="layui-input-block">
            <input type="text" name="banner" lay-verify="required" autocomplete="off" placeholder="请上传图片300*70" class="layui-input">
            <a href="javascript:;" id="upload-banner">上传</a>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">链接</label>
        <div class="layui-input-block">
            <input type="text" name="link" lay-verify="required" autocomplete="off" placeholder="请输入链接" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-block">
            <input type="text" name="title" lay-verify="required" autocomplete="off" placeholder="请输入标题" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn advertising-btn" lay-submit="" lay-filter="advertising-btn">保存</button>
        </div>
    </div>
</form>
<script type="text/html" id="barAction">
    <a class="layui-btn layui-btn-xs" lay-event="edit">修改</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delete">删除</a>
    </script>
<script type="text/html" id="toolbarAdd">
    <button class="layui-btn layui-btn-sm" lay-event="add">添加</button>
  </script>
@stop