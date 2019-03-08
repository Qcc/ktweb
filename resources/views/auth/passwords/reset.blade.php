@extends('layouts.app')
@section('title', '重置密码')

@section('content')
<div class="mdui-container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="reset-box">
                <div class="heading">重置密码</div>

                <div class="body">

                    <form class="layui-form" method="POST" action="{{ route('password.request') }}">
                        @if (session('status'))
                        <div class="help-success">
                            <i class="kticon">&#xe6b5;</i>
                            {{ session('status') }}
                        </div>
                        @endif
                        @if(count($errors)>0)
                        <div class="help-block">
                            @if ($errors->has('email'))
                            <p>
                                <i class="kticon">&#xe6b9;</i>
                                <strong>{{ $errors->first('email') }}</strong>
                            </p>
                            @endif
                            @if ($errors->has('password'))
                            <p>
                                <i class="kticon">&#xe6b9;</i>
                                <strong>{{ $errors->first('password') }}</strong>
                            </p>
                            @endif
                            @if ($errors->has('token'))
                            <p>
                                <i class="kticon">&#xe6b9;</i>
                                <strong>{{ $errors->first('token') }}</strong>
                            </p>
                            @endif
                            @if ($errors->has('password_confirmation'))
                            <p>
                                <i class="kticon">&#xe6b9;</i>
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </p>
                            @endif
                        </div>
                        @endif
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <input type="text" name="email" lay-verify="required|email" autocomplete="off"
                                    placeholder="请输入邮箱地址" value="{{ old('email') }}" class="layui-input {{ $errors->has('email') ? 'layui-form-danger':'' }}">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <input type="password" name="password" lay-verify="required" autocomplete="off" placeholder="请输入密码"
                                    value="" class="layui-input {{ $errors->has('password') ? 'layui-form-danger':'' }}">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <input type="password" name="password_confirmation" lay-verify="required" autocomplete="off"
                                    placeholder="确认密码" value="" class="layui-input {{ $errors->has('password_confirmation') ? 'layui-form-danger':'' }}">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" lay-submit="" lay-filter="password-btn">确认修改</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection