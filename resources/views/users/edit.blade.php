@extends('layouts.club')

@section('title', Auth::user()->username . ' 的个人中心')

@section('content')
<div>
    <h1> {{ $user->phone }} </h1>
    @include('common.error')
    <h4>
            <i class="glyphicon glyphicon-edit"></i> 编辑个人资料
        </h4>

        <form action="{{ route('users.update', $user->id) }}" method="POST" accept-charset="UTF-8"
                enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="name-field">姓名</label>
                    <input class="form-control" type="text" name="username" id="name-field" value="{{ old('username', $user->username) }}" />
                </div>
                <div class="form-group">
                    <label for="email-field">邮 箱</label>
                    <input class="form-control" type="text" name="email" id="email-field" value="{{ old('email', $user->email) }}" />
                </div>
                <div class="form-group">
                    <label for="introduction-field">个人简介</label>
                    <textarea name="introduction" id="introduction-field" class="form-control" rows="3">{{ old('introduction', $user->introduction) }}</textarea>
                </div>
                <div class="form-group">
                        <label for="" class="avatar-label">用户头像</label>
                        <input type="file" name="avatar">
    
                        @if($user->avatar)
                            <br>
                            <img class="thumbnail img-responsive" src="{{ $user->avatar }}" width="200" />
                        @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
@stop

