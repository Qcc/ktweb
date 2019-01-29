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
                        <div class="email-form">
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
                                        <input type="text" name="captcha" lay-verify="required" placeholder="请输入验证码"
                                            value="{{ old('captcha') }}" autocomplete="off" class="layui-input {{ $errors->has('captcha') ? 'layui-form-danger':'' }}">
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
                    </div>
                    <div id="sms-tab" class="mdui-p-a-2 ">
                        <div class="progress-box">
                            <div>
                                <div class="step step-bumber" style="color:#9CCC65"><i class="kticon">&#xe637;</i>
                                    <p>输入手机号</p>
                                </div>
                                <div class="step step-arrow" style="color:#9CCC65"><i class="kticon">&#xe76c;</i></div>
                                <div class="step step-bumber step2"><i class="kticon">&#xe63a;</i>
                                    <p>验证身份</p>
                                </div>
                                <div class="step step-arrow step2"><i class="kticon">&#xe76c;</i></div>
                                <div class="step step-bumber step3"><i class="kticon">&#xe63b;</i>
                                    <p>重置密码</p>
                                </div>
                            </div>
                        </div>

                        <div class="phone-form">
                            <div class="help-block"></div>
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
                                        <button class="layui-btn phone-btn" lay-submit="" lay-filter="phone-btn">下一步</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="code-form">
                            <form class="layui-form" method="POST" action="{{ route('password.email') }}">
                                {{ csrf_field() }}
                                <div class="layui-form-item">
                                    <p class="telphone-box">我们已经向<span class="telphone"></span>发送了一条验证码短信</p>
                                    <div class="layui-input-block">
                                        <input type="text" name="code" lay-verify="required" autocomplete="off"
                                            placeholder="请输短信验证码" value="{{ old('code') }}" class="layui-input {{ $errors->has('code') ? 'layui-form-danger':'' }}">
                                    </div>
                                    <p class="second-box"><span class="second"></span>后重新获取</p>
                                    <a class="resend" href="javascript:;">重新发送</a>
                                </div>
                                <div class="layui-form-item">
                                    <div class="layui-input-block">
                                        <input type="password" name="password" lay-verify="required" autocomplete="off"
                                            placeholder="请输入新密码不小于6位" value="{{ old('password') }}" class="layui-input {{ $errors->has('password') ? 'layui-form-danger':'' }}">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <div class="layui-input-block">
                                        <input type="password" name="confirmpassword" lay-verify="required"
                                            autocomplete="off" placeholder="确认密码" value="{{ old('confirmpassword') }}"
                                            class="layui-input {{ $errors->has('confirmpassword') ? 'layui-form-danger':'' }}">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <div class="layui-input-block">
                                        <button class="layui-btn code-btn" lay-submit="" lay-filter="code-btn">下一步</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="password-success">
                            <img src="/images/pa_success.png" alt="成功">
                            <p class="tips">密码修改成功！</p>
                            <a href="{{ route('login') }}" class="mdui-btn mdui-color-theme-accent mdui-ripple">去登录</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection