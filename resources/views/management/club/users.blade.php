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
            <input type="text" name="name" lay-verify="title" autocomplete="off" placeholder="请输入姓名" class="layui-input">
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
            <input type="text" name="email" lay-verify="email" autocomplete="off" placeholder="请输入邮箱" class="layui-input">
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
            <button class="layui-btn" lay-submit="" lay-filter="form-btn">确认修改</button>
        </div>
    </div>
</form>

@stop

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('layui/css/layui.css') }}">
<style>
    .product-edit-page .kt-nav-header .kt-navigetion-sections, .product-create-page .kt-nav-header .kt-navigetion-sections{
        color: #333;
    }
    .product-create-page .kt-nav-header .kt-nav-background,.product-create-page .kt-nav-header .kt-nav-background{
        background: rgba(255, 255, 255, 0.9);
        border-bottom: 1px solid rgba(200, 200, 200, 0.5);
    }
</style>
@stop

@section('script')
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/module.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/hotkeys.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/uploader.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/simditor.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/layui/layui.js') }}"></script>

<script>
    $(document).ready(function () {
        layui.use(['table', 'layer', 'form'], function () {
            var $ = layui.jquery,
                table = layui.table;
            layer = layui.layer;
            form = layui.form;
            table.init('users-table', { //转化静态表格
                //height: 'full-500'
            });
            //监听行单击事件（单击事件为：rowDouble）
            table.on('row(users-table)', function (obj) {
                var data = obj.data;
                //表单初始赋值
                form.val('user-form', {
                    "id": data.id,
                    "name": data.name,
                    "nickname": data.nickname,
                    "email": data.email,
                    "phone": data.phone,
                    "company": data.company,
                    "password": '',
                    "activated": '' + data.activated,
                })
                layer.open({
                    type: 1,
                    title: '修改用户信息 - ' + data.nickname,
                    content: $('#user-form') //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
                });
                //标注选中样式
                obj.tr.addClass('layui-table-click').siblings().removeClass('layui-table-click');
                //监听提交
                form.on('submit(form-btn)', function (data) {
                    var field = data.field;
                    if(field.password == ''){
                        delete field.password; 
                    }
                    field.activated = parseInt(field.activated);
                    $.ajax({
                        method: 'POST',
                        url: '/management/club/userstore',
                        ContentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: field,
                        success: function (data) {
                            layer.msg(data.msg);
                        }
                    })
                    return false;
                });

            });
        });
    });
    // <!-- 
    //     pasteImage —— 设定是否支持图片黏贴上传，这里我们使用 true 进行开启；
    // url —— 处理上传图片的 URL；
    // params —— 表单提交的参数，Laravel 的 POST 请求必须带防止 CSRF 跨站请求伪造的 _token 参数；
    // fileKey —— 是服务器端获取图片的键值，我们设置为 upload_file;
    // connectionCount —— 最多只能同时上传 3 张图片；
    // leaveConfirm —— 上传过程中，用户关闭页面时的提醒。
    //  -->
</script>

@stop