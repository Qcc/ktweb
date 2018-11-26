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
                    <li class="active"><a href="#">Ta 的话题</a></li>
                    <li><a href="#">Ta 的回复</a></li>
                </ul>
                @include('users._topics', ['topics' => $user->topics()->recent()->paginate(5)])
            </div>
        </div>
</div>
@stop