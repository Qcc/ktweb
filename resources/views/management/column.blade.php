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
                        <li>SEO城市</li>
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
                        <div class="layui-tab-item">
                            <table class="layui-table" lay-filter="seotable" id="seotable"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 产品 解决方案 客户案例 修改form -->
<form class="layui-form" id="pro_solu_cus_form" action="" lay-filter="pro_solu_cus_form" style="display:none;margin-right: 80px;">
    <div class="layui-form-item">
        <div class="layui-input-inline">
            <input type="hidden" name="id">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-block">
            <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入名称" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">图标</label>
        <div class="layui-input-block">
            <input type="text" name="icon" lay-verify="required" placeholder="请上传图标(80*80)" class="layui-input">
            <a href="javascript:;" id="upload-icon">上传</a>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-block">
            <input type="text" name="title" lay-verify="required" autocomplete="off" placeholder="请输入标题" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">大图</label>
        <div class="layui-input-block">
            <input type="text" name="banner"  lay-verify="required" placeholder="请上传大图(1920*464)" class="layui-input">
            <a href="javascript:;" id="upload-banner">上传</a>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">介绍</label>
        <div class="layui-input-block">
            <textarea name="description" lay-verify="required" placeholder="请输入介绍" class="layui-textarea"></textarea>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn pro_solu_cus_form_btn" lay-submit="" lay-filter="pro_solu_cus_form_btn">确认</button>
        </div>
    </div>
</form>

<!-- 修改社区类目form -->
<form class="layui-form" id="club_form" action="" lay-filter="club_form" style="display:none;margin-right: 80px;">
    <div class="layui-form-item">
        <div class="layui-input-inline">
            <input type="hidden" name="id">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">名称</label>
        <div class="layui-input-block">
            <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入名称" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">首图</label>
        <div class="layui-input-block">
            <input type="text" name="icon" lay-verify="required" placeholder="请上传首图(960*200)" class="layui-input">
            <a href="javascript:;" id="upload-club-icon">上传</a>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">介绍</label>
        <div class="layui-input-block">
            <textarea name="description" lay-verify="required" placeholder="请输入介绍" class="layui-textarea"></textarea>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn club_form_btn" lay-submit="" lay-filter="club_form_btn">确认</button>
        </div>
    </div>
</form>
<!-- seo城市 -->
<form class="layui-form" id="seo_form" action="" lay-filter="seo_form" style="display:none;margin-right: 80px;">
    <div class="layui-form-item">
        <div class="layui-input-inline">
            <input type="hidden" name="id">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">名称</label>
        <div class="layui-input-block">
            <input type="text" name="city" lay-verify="required" autocomplete="off" placeholder="请输入城市名称" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn seo_form_btn" lay-submit="" lay-filter="seo_form_btn">确认</button>
        </div>
    </div>
</form>

<script type="text/html" id="barAction">
    <a class="layui-btn layui-btn-xs layui-btn-warm" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delete">删除</a>
</script>
<script type="text/html" id="toolbarAdd">
    <button class="layui-btn layui-btn-sm" lay-event="add">添加</button>
</script>
@stop