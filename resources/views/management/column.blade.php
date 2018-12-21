@extends('layouts.club')

@section('title', '类目管理')

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


                <div class="layui-tab" lay-filter="column-tab">
                    <ul class="layui-tab-title">
                        <li class="layui-this">社区分类</li>
                        <li>产品</li>
                        <li>解决方案</li>
                        <li>客户案例</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">
                            <table lay-filter="categorys-table" id="categorys-table">
                                <thead>
                                    <tr>
                                        <th lay-data="{field:'id', width:70}">ID</th>
                                        <th lay-data="{field:'name'}">名称</th>
                                        <th lay-data="{field:'icon'}">图标</th>
                                        <th lay-data="{field:'description'}">介绍</th>
                                        <th lay-data="{field:'created_at'}">创建时间</th>
                                        <th lay-data="{toolbar: '#barAction', width:220}">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categorys as $index => $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->icon }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>{{ $category->created_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="layui-tab-item">
                            <table class="layui-table" lay-filter="producttable" id="producttable"></table>
                        </div>
                        <div class="layui-tab-item">
                            <table class="layui-table" lay-filter="solutiontable" id="solutiontable"></table>
                        </div>
                        <div class="layui-tab-item">
                            <table class="layui-table" lay-filter="customertable" id="customertable"></table>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>

<script type="text/html" id="barAction">
    <a class="layui-btn layui-btn-xs layui-btn-warm" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delete">删除</a>
</script>
<script type="text/html" id="toolbarAdd">
    <button class="layui-btn layui-btn-sm" lay-event="add">添加</button>
</script>
@stop