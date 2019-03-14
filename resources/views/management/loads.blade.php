@extends('layouts.club')

@section('title', '批量发布文章')

@section('content')
<div class="mdui-container">
    <div class="mdui-row">
        <div class="mdui-col-xs-3">
            <div class="edit-item-warp">
                @include('management._menu_club')
            </div>
        </div>
        <div class="mdui-col-xs-8">
            <div class="edit-action-warp">
                <div class="layui-btn-group demoTable">
                    <button class="layui-btn check-data" style="background-color:#536dfe"><i class="kticon">&#xe64d;</i> 格式化数据</button>
                    <button class="layui-btn send-club" style="background-color:#536dfe"><i class="kticon">&#xe648;</i> 发布到社区</button>
                    <button class="layui-btn send-hy" style="background-color:#536dfe"><i class="kticon">&#xe64b;</i> 发布到行业新闻</button>
                    <button class="layui-btn send-zhik" style="background-color:#536dfe"><i class="kticon">&#xe64b;</i> 发布到管理智库</button>
                    <button class="layui-btn delete-temp-article" style="background-color:#536dfe"><i class="kticon">&#xe6b9;</i> 删除</button>
                </div>
                <table lay-filter="articles-table" id="articles-table">
                    <thead>
                        <tr>
                            <th lay-data="{checkbox:true,fixed: 'left'}"></th>
                            <th lay-data="{field:'id', width:50}">ID</th>
                            <th lay-data="{field:'category', width:60}">分类</th>
                            <th lay-data="{field:'title'}">标题</th>
                            <th lay-data="{field:'body', width:80}">正文</th>
                            <th lay-data="{field:'content1', width:100}">回复1</th>
                            <th lay-data="{toolbar: '#barAction', width:110}">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($temparticles as $index => $article)
                        <tr>
                            <td></td>
                            <td>{{ $article->id }}</td>
                            <td>{{ $article->category }}</td>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->body }}</td>
                            <td>{{ $article->content1 }}</td>
                            <td>{{ $article->content2 }}</td>
                            <td>{{ $article->content3 }}</td>
                            <td>{{ $article->content4 }}</td>
                            <td>{{ $article->content5 }}</td>
                            <td>{{ $article->content6 }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-box">
                {!! $temparticles->appends(Request::except('page'))->render() !!}
            </div>
        </div>
    </div>
</div>
<div id="body-views" style="display:none;padding: 20px;">
    <div class="topic-body">

    </div>
</div>
<script type="text/html" id="barAction">
    <a class="layui-btn layui-btn-xs" lay-event="view">预览</a>
    <a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="delete">删除</a>
</script>
@stop