@extends('layouts.club')

@section('title', $user->nickname . ' 的个人中心')

@section('content')
<div class="mdui-container club-artical">
    <div class="mdui-row">
        <div class="mdui-col-xs-3">
            @include('users._user_info',$user)
            <div class="useraction-nav">
                <ul class="nav-tabs">
                    <li class="{{ active_class(if_query('tab', null)) }}">
                        <a href="{{ route('users.show', $user->id) }}">
                            <i class="mdui-icon material-icons">&#xe8b0;</i> 他发布的话题</a>
                    </li>
                    <li class="{{ active_class(if_query('tab', 'replies')) }}">
                        <a href="{{ route('users.show', [$user->id, 'tab' => 'replies']) }}">
                            <i class="mdui-icon material-icons">&#xe15f;</i> 他发表的回复</a>
                    </li>
                    <li class="{{ active_class(if_query('tab', 'excllent')) }}">
                        <a href="{{ route('users.show', [$user->id, 'tab' => 'excllent']) }}">
                            <i class="mdui-icon material-icons">&#xe8dc;</i> 他赞过的文章</a>
                    </li>
                    <li class="{{ active_class(if_query('tab', 'following')) }}">
                        <a href="{{ route('users.show', [$user->id, 'tab' => 'following']) }}">
                            <i class="mdui-icon material-icons">&#xe8f4;</i> 他关注的文章</a>
                    </li>
                    <li class="{{ active_class(if_query('tab', 'follows')) }}">
                        <a href="{{ route('users.show', [$user->id, 'tab' => 'follows']) }}">
                            <i class="mdui-icon material-icons">&#xe7fc;</i> 他关注的用户</a>
                    </li>
                    <li class="{{ active_class(if_query('tab', 'fans')) }}">
                        <a href="{{ route('users.show', [$user->id, 'tab' => 'fans']) }}">
                            <i class="mdui-icon material-icons">&#xe7fb;</i> 关注他的用户</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mdui-col-xs-9">
            <div class="useraction-content">
                <!-- recent() 方法在数据模型基类 app/Models/Model.php 中定义，并且使用了 本地作用域 的方式进行定义，我们的 Reply 模型，就如代码生成器所生成的数据模型一样，统一继承了此类方法 -->
                @if (if_query('tab', 'replies'))
                <!-- 发表的回复 -->
                @include('users._replies', ['replies' => $user->replies()->with('topic')->recent()->paginate(10)])
                @elseif (if_query('tab', 'excllent'))
                <!-- 赞过的话题 -->
                @include('users._topics', ['topics' => $user->topicGreats()->recent()->paginate(15)])
                @elseif (if_query('tab', 'following'))
                <!-- 关注的文章 -->
                @include('users._topics', ['topics' => $user->topicFollowings()->recent()->paginate(15)])
                @elseif (if_query('tab', 'follows'))
                <!-- 关注的人 -->
                @include('users._users', ['users' => $user->followings()->paginate(15)])
                @elseif (if_query('tab', 'fans'))
                <!-- 他的粉丝 -->
                @include('users._users', ['users' => $user->followers()->paginate(15)])
                @else
                @include('users._topics', ['topics' => $user->topics()->with('category')->recent()->paginate(15)])
                @endif
            </div>
        </div>
    </div>
</div>
@stop