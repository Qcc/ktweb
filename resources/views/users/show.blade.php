@extends('layouts.app')

@section('title', Auth::user()->username . ' 的个人中心')

@section('content')
<div>
    <h1> {{ $user->phone }} </h1>
    <a href="{{ route('users.edit', Auth::id()) }}">
            编辑资料
        </a>
        <div align="center">
                <img class="thumbnail img-responsive" src="{{ $user->avatar }}" width="300px" height="300px">
            </div>
        <div class="media-body">
                <hr>
                <h4><strong>个人简介</strong></h4>
                <p>{{ $user->introduction }}</p>
                <hr>
                <h4><strong>注册于</strong></h4>
                <p>{{ $user->created_at->diffForHumans() }}</p>
            </div>

            {{-- 用户发布的内容 --}}
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="{{ active_class(if_query('tab', null)) }}">
                        <a href="{{ route('users.show', $user->id) }}">Ta 的话题</a>
                    </li>
                    <li class="{{ active_class(if_query('tab', 'replies')) }}">
                            <a href="{{ route('users.show', [$user->id, 'tab' => 'replies']) }}">Ta 的回复</a>
                    </li>
                </ul>
                @if (if_query('tab', 'replies'))
                    @include('users._replies', ['replies' => $user->replies()->with('topic')->recent()->paginate(5)])
                @else
                <!-- recent() 方法在数据模型基类 app/Models/Model.php 中定义，并且使用了 本地作用域 的方式进行定义，我们的 Reply 模型，就如代码生成器所生成的数据模型一样，统一继承了此类方法 -->
                    @include('users._topics', ['topics' => $user->topics()->recent()->paginate(5)])
                @endif
            </div>
        </div>
</div>
@stop