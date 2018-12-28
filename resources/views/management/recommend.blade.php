@extends('layouts.club')

@section('title', '社区推荐')

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
                            <p>社区首页banner</p>
                        </div>
                        <table lay-filter="clubbanner-table" id="clubbanner-table">
                                <thead>
                                    <tr>
                                        <th lay-data="{field:'id', width:40}">ID</th>
                                        <th lay-data="{field:'key', width:70}">key</th>
                                        <th lay-data="{field:'link'}">链接</th>
                                        <th lay-data="{field:'banner'}">banner</th>
                                        <th lay-data="{field:'title'}">标题</th>
                                        <th lay-data="{field:'subtitle'}">副标题</th>
                                        <th lay-data="{toolbar: '#barAction', width:110}">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clubbanners as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->key }}</td>
                                        <td>{{ $item->link }}</td>
                                        <td>{{ $item->banner }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->subtitle }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
            </div>
        </div>
    </div>
</div>
<form class="layui-form" id="clubbanner-form" lay-filter="clubbanner-form" style="display:none;margin-right: 80px;">

        <div class="layui-form-item">
            <div class="layui-input-inline">
                <input type="hidden" name="id" >
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-inline">
                <input type="hidden" name="key" value="club_banner">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">图片</label>
            <div class="layui-input-block">
                <input type="text" name="banner" lay-verify="required"
                    autocomplete="off" placeholder="请上传图片1920*400" class="layui-input">
                    <a href="javascript:;" id="upload-banner">上传</a>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">链接</label>
            <div class="layui-input-block">
                <input type="text" name="link" lay-verify="required"
                    autocomplete="off" placeholder="请输入链接" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
                <input type="text" name="title"
                    autocomplete="off" placeholder="请输入标题" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">副标题</label>
            <div class="layui-input-block">
                <input type="text" name="subtitle"
                    autocomplete="off" placeholder="请输入副标题" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn clubbanner-btn" lay-submit="" lay-filter="clubbanner-btn">保存</button>
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