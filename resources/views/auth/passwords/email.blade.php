@extends('layouts.app')
@section('title', '找回密码')
@section('content')
<div class="mdui-container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="reset-box">
                <div class="heading">
                    <p>找回密码</p>
                </div>

                <div class="body">

                    <div class="mdui-tab reset-password-tab" mdui-tab>
                        <a href="#email-tab" class="mdui-ripple">邮箱找回</a>
                        <a href="#sms-tab" class="mdui-ripple">短信找回</a>
                    </div>
                    <div id="email-tab" class="mdui-p-a-2 tab-content">
                        @if (session('status'))
                        <div class="help-success">
                            <i class="kticon">&#xe6b5;</i>
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="{{ count($errors)>0?'help-block':'' }}">
                            @if ($errors->has('email'))
                            <p>
                                <i class="kticon">&#xe6b9;</i>
                                <strong>邮箱不正确</strong>
                            </p>
                            @endif
                            @if ($errors->has('captcha'))
                            <p>
                                <i class="kticon">&#xe6b9;</i>
                                <strong>图形验证码不正确</strong>
                            </p>
                            @endif
                        </div>
                        <form class="layui-form" method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <input type="text" name="email" lay-verify="required|email" autocomplete="off"
                                        placeholder="请输入邮箱" value="{{ old('email') }}" class="layui-input {{ $errors->has('email') ? 'layui-form-danger':'' }}">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block input-captcha">
                                    <input type="text" name="captcha" lay-verify="required" placeholder="请输入验证码" value="{{ old('captcha') }}"
                                        autocomplete="off" class="layui-input {{ $errors->has('captcha') ? 'layui-form-danger':'' }}">
                                    <img class="captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()"
                                        title="点击图片重新获取验证码">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button class="layui-btn" lay-submit="" lay-filter="email-btn">立即提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="sms-tab" class="mdui-p-a-2">
                        <div class="progress-box">
                            <div>
                                <div class="step step-bumber"><i class="kticon">&#xe637;</i>
                                    <p>输入手机号</p>
                                </div>
                                <div class="step step-arrow"><i class="kticon">&#xe76c;</i></div>
                                <div class="step step-bumber"><i class="kticon">&#xe63a;</i>
                                    <p>验证身份</p>
                                </div>
                                <div class="step step-arrow"><i class="kticon">&#xe76c;</i></div>
                                <div class="step step-bumber"><i class="kticon">&#xe63b;</i>
                                    <p>重置密码</p>
                                </div>
                            </div>
                        </div>
                        <div class="phone-form">
                            <form class="layui-form" method="POST" action="{{ route('password.email') }}">
                                {{ csrf_field() }}
                                <div class="layui-form-item">
                                    <div class="layui-input-block">
                                        <input type="text" name="phone" lay-verify="required|phone" autocomplete="off"
                                            placeholder="请输入手机号" value="{{ old('phone') }}" class="layui-input {{ $errors->has('phone') ? 'layui-form-danger':'' }}">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <div class="layui-input-block input-captcha">
                                        <input type="text" name="captcha" lay-verify="required" placeholder="请输入验证码"
                                            value="{{ old('captcha') }}" autocomplete="off" class="layui-input {{ $errors->has('captcha') ? 'layui-form-danger':'' }}">
                                        <img class="captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()"
                                            title="点击图片重新获取验证码">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <div class="layui-input-block">
                                        <button class="layui-btn" lay-submit="" lay-filter="phone-btn">下一步</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection