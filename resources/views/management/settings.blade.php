@extends('layouts.club')

@section('title', '社区设置')

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
                    <p>全站广告</p>
                </div>
                <table lay-filter="advertising-table" id="advertising-table">
                        <thead>
                            <tr>
                                <th lay-data="{field:'id', width:70}">ID</th>
                                <th lay-data="{field:'link'}">链接</th>
                                <th lay-data="{field:'banner'}">图片</th>
                                <th lay-data="{toolbar: '#barAction', width:260}">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($advertisings as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->link }}</td>
                                <td>{{ $item->banner }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
<form class="layui-form" id="advertising-form" lay-filter="advertising-form" style="display:none;margin-right: 80px;">

        <div class="layui-form-item">
            <label class="layui-form-label">图片</label>
            <div class="layui-input-block">
                <input type="text" name="img" lay-verify="required"
                    autocomplete="off" placeholder="请上传图片300*70" class="layui-input">
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