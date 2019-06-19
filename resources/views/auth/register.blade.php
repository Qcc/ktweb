@extends('layouts.app')
@section('title', '用户注册')
@section('content')
<div class="mdui-container">
    <div class="panel-default">
        <div class="panel-heading mdui-typo-display-1-opacity">用户注册</div>
        <div class="registry-body mdui-center">
            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="form-group form-group-phone">
                    <div class="mdui-textfield mdui-textfield-floating-label{{ $errors->has('phone') ? ' mdui-textfield-invalid-html5' : '' }}">
                        <label class="mdui-textfield-label">手机号码</label>
                        <input id="phone" class="mdui-textfield-input" type="text" pattern="^(1[0-9])\d{9}$"
                            name="phone" value="{{ old('phone') }}" disabled required />
                            暂停注册，如有疑问请致电8009996619
                        @if ($errors->has('phone'))
                        <div class="mdui-textfield-error">{{ $errors->first('phone') }}</div>
                        @else
                        <div class="mdui-textfield-error">手机号不正确</div>
                        @endif
                    </div>
                </div>

                <p class="sendsms-title mdui-typo-body-1-opacity"></p>
                <div class="form-group form-group-sms">
                    <div class="sms-input">
                        <div class="mdui-textfield mdui-textfield-floating-label{{ $errors->has('vercode') ? ' mdui-textfield-invalid-html5' : '' }}">
                            <label class="mdui-textfield-label">短信验证码</label>
                            <input id="vercode" class="mdui-textfield-input" type="text" required name="vercode" />
                            <div class="mdui-textfield-error">短信验证码不正确</div>
                            <div class="mdui-spinner mdui-spinner-colorful smscode-check-icon"></div>
                            <i class="kticon smscode-success-icon">&#xe659;</i>
                        </div>
                    </div>
                    
                    <div class="sms-input">
                        <div class="mdui-textfield mdui-textfield-floating-label">
                            <label class="mdui-textfield-label">密码</label>
                            <input id="password" class="mdui-textfield-input" type="password" pattern="^.*(?=.{6,25}).*$" required name="password" />
                            <div class="mdui-textfield-error">请输入至少 6 位</div>
                        </div>
                    </div>
                </div>
                <div class="send-sms">
                    <p class="sendsmstips mdui-typo-body-1-opacity"></p>
                </div>

                <div class="form-group form-group-captcha">
                    <div class="captcha-input">
                        <div class="mdui-textfield mdui-textfield-floating-label{{ $errors->has('captcha') ? ' mdui-textfield-invalid-html5' : '' }}">
                            <label class="mdui-textfield-label">图形验证码</label>
                            <input id="captcha" class="mdui-textfield-input" type="text" name="captcha" required />
                            @if ($errors->has('captcha'))
                            <div class="mdui-textfield-error">{{ $errors->first('captcha') }}</div>
                            @else
                            <div class="mdui-textfield-error">图形证码不正确</div>
                            @endif
                            <div class="mdui-spinner mdui-spinner-colorful captcha-check-icon"></div>
                            <i class="kticon captcha-success-icon">&#xe659;</i>
                        </div>
                    </div>

                    <div class="captcha-img">
                        <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()"
                            title="点击图片重新获取验证码">
                    </div>
                </div>

                <div class="form-group">
                    <button id="submit" type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent submit">
                        立 即 注 册</button>
                </div>

                <div class="form-group kt-register">
                    <a class="mdui-typo-caption-opacity" href="{{ route('login') }}">已有账户？点击登录</a>
                </div>
            </form>
        </div>
    </div>
    <div class="mdui-text-color-grey copyright mdui-hidden-xs-down">
        <p class="txt-center">深圳市沟通科技有限公司 · 版权所有 电话：0755-26525890 地址：深圳市南山区科技园南区W1-B栋5楼</p>
        <p class="txt-center"><small>KouTon © 2000-2018 粤ICP备09149236 号</small></p>
    </div>
</div>
@endsection
