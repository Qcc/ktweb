@extends('layouts.club')

@section('title', '角色管理')

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
                <table lay-filter="roles-table" id="roles-table">
                    <thead>
                        <tr>
                            <th lay-data="{field:'id', width:100}">ID</th>
                            <th lay-data="{field:'name'}">名称</th>
                            <th lay-data="{field:'created_at'}">创建时间</th>
                            <th lay-data="{toolbar: '#barAction'}">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $index => $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>用户列表</p>
                <table class="layui-table" lay-filter="usertable" id="usertable">
                </table>
                <p>权限列表</p>
                <table class="layui-table" lay-filter="permissiontable" id="permissiontable">
                </table>
            </div>
        </div>
    </div>
</div>
<form class="layui-form" id="roles-form" action="" lay-filter="roles-form" style="display:none;margin-right: 80px;">
    <div class="layui-form-item">
        <div class="layui-input-inline">
            <input type="hidden" name="id">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">角色名称</label>
        <div class="layui-input-block">
            <input type="text" name="name" lay-verify="title" autocomplete="off" placeholder="请输入角色名称" class="layui-input">
        </div>
    </div>
</form>
<script type="text/html" id="barAction">
    <a class="layui-btn layui-btn-xs layui-btn-warm" lay-event="users">角色用户</a>
    <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="permission">角色权限</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delete">删除</a>
  </script>
@stop