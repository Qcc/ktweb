@extends('layouts.club')

@section('title', '用户管理')

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
                <form class="layui-form" method="get" action="{{ route('admin.club.users') }}">
                    <div class="layui-form-item">
                        <div class="layui-input-inline">
                            <input type="text" name="phone" lay-verify="required|phone" autocomplete="off" placeholder="请输入手机号"
                                class="layui-input">
                        </div>
                        <div class="layui-input-inline">
                            <button class="layui-btn" lay-submit="" lay-filter="search-user"><i class="kticon">&#xe60e;</i> 查找用户</button>
                        </div>
                    </div>
                </form>
                <table lay-filter="users-table" id="users-table">
                    <thead>
                        <tr>
                            <th lay-data="{field:'id', width:50}">ID</th>
                            <th lay-data="{field:'avatar', width:60}">头像</th>
                            <th lay-data="{field:'name', width:80}">姓名</th>
                            <th lay-data="{field:'nickname', width:80}">昵称</th>
                            <th lay-data="{field:'activated', width:60,templet: '#actTpl'}">状态</th>
                            <th lay-data="{field:'email', width:100}">邮箱</th>
                            <th lay-data="{field:'phone', width:100}">手机</th>
                            <th lay-data="{field:'company', width:150}">公司</th>
                            <th lay-data="{field:'telephone', width:150}">固定电话</th>
                            <th lay-data="{field:'introduction', width:150}">介绍</th>
                            <th lay-data="{field:'created_at', minWidth: 180}">注册时间</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><img src="{{ $user->avatar }}" alt="头像" style="width:24px;height:24px"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->nickname }}</td>
                            <td>{{ $user->activated }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->company }}</td>
                            <td>{{ $user->telephone }}</td>
                            <td>{{ $user->introduction }}</td>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-box">
                    {!! $users->appends(Request::except('page'))->render() !!}
            </div>
        </div>
    </div>
</div>

<form class="layui-form" id="user-form" action="" lay-filter="user-form" style="display:none;margin-right: 80px;">
    <div class="layui-form-item">
        <div class="layui-input-inline">
            <input type="hidden" name="id">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">姓名</label>
        <div class="layui-input-block">
            <input type="text" name="name" autocomplete="off" placeholder="请输入姓名" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">昵称</label>
        <div class="layui-input-block">
            <input type="text" name="nickname" autocomplete="off" placeholder="请输入昵称" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">手机</label>
        <div class="layui-input-block">
            <input type="text" name="phone" lay-verify="required|phone" autocomplete="off" placeholder="请输入手机" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">邮箱</label>
        <div class="layui-input-block">
            <input type="text" name="email" autocomplete="off" placeholder="请输入邮箱" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">公司</label>
        <div class="layui-input-block">
            <input type="text" name="company" autocomplete="off" placeholder="请输入公司" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-block">
            <input type="password" name="password" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item" pane="">
        <div class="layui-input-block">
            <input type="radio" name="activated" value="1" title="正常">
            <input type="radio" name="activated" value="0" title="禁用">
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn submit" lay-submit="" lay-filter="form-btn">确认修改</button>
        </div>
    </div>
</form>

@stop