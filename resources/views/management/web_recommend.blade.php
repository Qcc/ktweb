@extends('layouts.club')

@section('title', '主站推荐')

@section('content')
<div class="mdui-container useredit-box">
    <div class="mdui-row">
        <div class="mdui-col-xs-3">
            <div class="edit-item-warp">
                @include('management._menu_club')
            </div>
        </div>
        <div class="mdui-col-xs-8">
            <div class="edit-action-warp"  style="margin-bottom:0">
                <p>首页banner</p>
            </div>
            <table lay-filter="homebanner-table" id="homebanner-table">
                <thead>
                    <tr>
                        <th lay-data="{field:'id', width:40}">ID</th>
                        <th lay-data="{field:'link'}">按钮链接</th>
                        <th lay-data="{field:'banner'}">banner</th>
                        <th lay-data="{field:'title'}">标题</th>
                        <th lay-data="{field:'subtitle'}">按钮文字</th>
                        <th lay-data="{field:'icon1'}">图标1</th>
                        <th lay-data="{field:'icon_title1'}">图标标题1</th>
                        <th lay-data="{field:'icon_link1'}">图标链接1</th>
                        <th lay-data="{field:'icon2'}">图标2</th>
                        <th lay-data="{field:'icon_title2'}">图标标题2</th>
                        <th lay-data="{field:'icon_link2'}">图标链接2</th>
                        <th lay-data="{field:'icon3'}">图标3</th>
                        <th lay-data="{field:'icon_title3'}">图标标题3</th>
                        <th lay-data="{field:'icon_link3'}">图标链接3</th>
                        <th lay-data="{field:'icon4'}">图标4</th>
                        <th lay-data="{field:'icon_title4'}">图标标题4</th>
                        <th lay-data="{field:'icon_link4'}">图标链接4</th>
                        <th lay-data="{field:'icon5'}">图标5</th>
                        <th lay-data="{field:'icon_title5'}">图标标题5</th>
                        <th lay-data="{field:'icon_link5'}">图标链接5</th>
                        <th lay-data="{toolbar: '#barAction', width:110}">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($homebanners as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->link }}</td>
                        <td>{{ $item->banner }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->subtitle }}</td>
                        <td>{{ $item->icon1 }}</td>
                        <td>{{ $item->icon_title1 }}</td>
                        <td>{{ $item->icon_link1 }}</td>
                        <td>{{ $item->icon2 }}</td>
                        <td>{{ $item->icon_title2 }}</td>
                        <td>{{ $item->icon_link2 }}</td>
                        <td>{{ $item->icon3 }}</td>
                        <td>{{ $item->icon_title3 }}</td>
                        <td>{{ $item->icon_link3 }}</td>
                        <td>{{ $item->icon4 }}</td>
                        <td>{{ $item->icon_title4 }}</td>
                        <td>{{ $item->icon_link4 }}</td>
                        <td>{{ $item->icon5 }}</td>
                        <td>{{ $item->icon_title5 }}</td>
                        <td>{{ $item->icon_link5 }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="edit-action-warp" style="margin-bottom:0">
                <p>首页解决方案</p>
            </div>
            <table lay-filter="solutionbanner-table" id="solutionbanner-table">
                <thead>
                    <tr>
                        <th lay-data="{field:'id', width:40}">ID</th>
                        <th lay-data="{field:'link'}">链接</th>
                        <th lay-data="{field:'banner'}">banner</th>
                        <th lay-data="{field:'title'}">标题</th>
                        <th lay-data="{field:'subtitle'}">副标题</th>
                        <th lay-data="{field:'icon1'}">图标</th>
                        <th lay-data="{toolbar: '#barAction', width:110}">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($solutionbanners as $solution)
                    <tr>
                        <td>{{ $solution->id }}</td>
                        <td>{{ $solution->link }}</td>
                        <td>{{ $solution->banner }}</td>
                        <td>{{ $solution->title }}</td>
                        <td>{{ $solution->subtitle }}</td>
                        <td>{{ $solution->icon1 }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="edit-action-warp" style="margin-bottom:0">
                <p>登录页banner</p>
            </div>
            <table lay-filter="loginbanner-table" id="loginbanner-table">
                <thead>
                    <tr>
                        <th lay-data="{field:'id', width:40}">ID</th>
                        <th lay-data="{field:'link'}">链接</th>
                        <th lay-data="{field:'banner'}">banner</th>
                        <th lay-data="{toolbar: '#barAction', width:110}">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loginbanners as $loginbanner)
                    <tr>
                        <td>{{ $loginbanner->id }}</td>
                        <td>{{ $loginbanner->link }}</td>
                        <td>{{ $loginbanner->banner }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<form class="layui-form" id="homebanner-form" lay-filter="homebanner-form" style="display:none;margin-right: 80px;">
    <div class="layui-form-item">
        <div class="layui-input-inline">
            <input type="hidden" name="id">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">banner图片</label>
        <div class="layui-input-block">
            <input type="text" name="banner" lay-verify="required" autocomplete="off" placeholder="请上传图片4096*1920"
                class="layui-input">
            <a href="javascript:;" class="upload-banner">上传</a>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">按钮链接</label>
        <div class="layui-input-block">
            <input type="text" name="link" lay-verify="required" autocomplete="off" placeholder="请输入链接" class="layui-input">
        </div>
    </div>
    
    <div class="layui-form-item">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-block">
            <input type="text" name="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
            <label class="layui-form-label">按钮文字</label>
            <div class="layui-input-block">
                <input type="text" name="subtitle" lay-verify="required" autocomplete="off" placeholder="请输入链接" class="layui-input">
            </div>
        </div>
        <hr/>
    <div class="layui-form-item">
        <label class="layui-form-label">图标1</label>
        <div class="layui-input-block">
            <input type="text" name="icon1"  autocomplete="off" placeholder="请上传图片png-白色-200*200"
                class="layui-input">
            <a href="javascript:;" class="upload-banner">上传</a>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">图标标题链接1</label>
        <div class="layui-input-inline">
            <input type="text" name="icon_title1"  autocomplete="off" placeholder="请输入标题"
                class="layui-input">
        </div>
        <div class="layui-input-inline">
            <input type="text" name="icon_link1"  autocomplete="off" placeholder="请输入链接"
                class="layui-input">
        </div>
    </div>

    <hr/>

    <div class="layui-form-item">
        <label class="layui-form-label">图标2</label>
        <div class="layui-input-block">
            <input type="text" name="icon2"  autocomplete="off" placeholder="请上传图片png-白色-200*200"
                class="layui-input">
            <a href="javascript:;" class="upload-banner">上传</a>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">图标标题链接2</label>
        <div class="layui-input-inline">
            <input type="text" name="icon_title2"  autocomplete="off" placeholder="请输入标题"
                class="layui-input">
        </div>
        <div class="layui-input-inline">
            <input type="text" name="icon_link2"  autocomplete="off" placeholder="请输入链接"
                class="layui-input">
        </div>
    </div>

    <hr/>

    <div class="layui-form-item">
        <label class="layui-form-label">图标3</label>
        <div class="layui-input-block">
            <input type="text" name="icon3"  autocomplete="off" placeholder="请上传图片png-白色-200*200"
                class="layui-input">
            <a href="javascript:;" class="upload-banner">上传</a>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">图标标题链接3</label>
        <div class="layui-input-inline">
            <input type="text" name="icon_title3"  autocomplete="off" placeholder="请输入标题"
                class="layui-input">
        </div>
        <div class="layui-input-inline">
            <input type="text" name="icon_link3"  autocomplete="off" placeholder="请输入链接"
                class="layui-input">
        </div>
    </div>

    <hr/>

    <div class="layui-form-item">
        <label class="layui-form-label">图标4</label>
        <div class="layui-input-block">
            <input type="text" name="icon4"  autocomplete="off" placeholder="请上传图片png-白色-200*200"
                class="layui-input">
            <a href="javascript:;" class="upload-banner">上传</a>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">图标标题链接4</label>
        <div class="layui-input-inline">
            <input type="text" name="icon_title4"  autocomplete="off" placeholder="请输入标题"
                class="layui-input">
        </div>
        <div class="layui-input-inline">
            <input type="text" name="icon_link4"  autocomplete="off" placeholder="请输入链接"
                class="layui-input">
        </div>
    </div>

    <hr/>

    <div class="layui-form-item">
        <label class="layui-form-label">图标5</label>
        <div class="layui-input-block">
            <input type="text" name="icon5"  autocomplete="off" placeholder="请上传图片png-白色-200*200"
                class="layui-input">
            <a href="javascript:;" class="upload-banner">上传</a>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">图标标题链接5</label>
        <div class="layui-input-inline">
            <input type="text" name="icon_title5"  autocomplete="off" placeholder="请输入标题"
                class="layui-input">
        </div>
        <div class="layui-input-inline">
            <input type="text" name="icon_link5"  autocomplete="off" placeholder="请输入链接"
                class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn homebanner-btn" lay-submit="" lay-filter="homebanner-btn">保存</button>
        </div>
    </div>
</form>
<!-- 解决方案banner -->
<form class="layui-form" id="solutionbanner-form" lay-filter="solutionbanner-form" style="display:none;margin-right: 80px;">
    <div class="layui-form-item">
        <div class="layui-input-inline">
            <input type="hidden" name="id">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">banner图片</label>
        <div class="layui-input-block">
            <input type="text" name="banner" lay-verify="required" autocomplete="off" placeholder="请上传图片640*400"
                class="layui-input">
            <a href="javascript:;" class="upload-banner">上传</a>
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
            <input type="text" name="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
            <label class="layui-form-label">副标题</label>
            <div class="layui-input-block">
                <input type="text" name="subtitle" lay-verify="required" autocomplete="off" placeholder="请输入链接" class="layui-input">
            </div>
        </div>
        <hr/>
    <div class="layui-form-item">
        <label class="layui-form-label">图标</label>
        <div class="layui-input-block">
            <input type="text" name="icon1" lay-verify="required" autocomplete="off" placeholder="请上传图片png-白色-200*200"
                class="layui-input">
            <a href="javascript:;" class="upload-banner">上传</a>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn solutionbanner-btn" lay-submit="" lay-filter="solutionbanner-btn">保存</button>
        </div>
    </div>
</form>
<!-- 登录页banner -->
<form class="layui-form" id="loginbanner-form" lay-filter="loginbanner-form" style="display:none;margin-right: 80px;">
    <div class="layui-form-item">
        <div class="layui-input-inline">
            <input type="hidden" name="id">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">banner图片</label>
        <div class="layui-input-block">
            <input type="text" name="banner" lay-verify="required" autocomplete="off" placeholder="请上传图片1920*500"
                class="layui-input">
            <a href="javascript:;" class="upload-banner">上传</a>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">链接</label>
        <div class="layui-input-block">
            <input type="text" name="link" lay-verify="required" autocomplete="off" placeholder="请输入链接" class="layui-input">
        </div>
    </div>
     
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn loginbanner-btn" lay-submit="" lay-filter="loginbanner-btn">保存</button>
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