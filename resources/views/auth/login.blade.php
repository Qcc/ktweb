@extends('layouts.app')
@section('title', '用户登录')
@section('content')
<div class="login-form-warp xhs_login_pad" style="margin-top:60px;">
    <div class="login-form">
        <div class="mdui-typo-subheading-opacity login-title">用户登录</div>
        <div class="login-body">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="mdui-textfield mdui-textfield-floating-label
                    {{ $errors->has('phone') ? ' mdui-textfield-invalid-html5' : '' }}
                    {{ $errors->has('email') ? ' mdui-textfield-invalid-html5' : '' }}
                    ">
                        <label class="mdui-textfield-label">手机号 / 邮箱</label>
                        <input id="phone" class="mdui-textfield-input" type="text" class="form-control" name="phone"
                            value="{{ old('phone') }}" required>
                        @if ($errors->has('phone'))
                        <div class="mdui-textfield-error">{{ $errors->first('phone') }}</div>
                        @elseif ($errors->has('email'))
                        <div class="mdui-textfield-error">{{ $errors->first('email') }}</div>
                        @else
                        <div class="mdui-textfield-error">用户名不能为空</div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="mdui-textfield mdui-textfield-floating-label {{ $errors->has('password') ? ' mdui-textfield-invalid-html5' : '' }}">
                        <label class="mdui-textfield-label">密 码</label>
                        <input id="password" class="mdui-textfield-input" id="password" type="password" class="form-control"
                            name="password" required>
                        @if ($errors->has('password'))
                        <div class="mdui-textfield-error">{{ $errors->first('password') }}</div>
                        @else
                        <div class="mdui-textfield-error">密码不能为空</div>
                        @endif

                    </div>
                </div>

                <div class="form-group">
                    <label class="mdui-checkbox mdui-typo-caption-opacity">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />
                        <i class="mdui-checkbox-icon"></i>
                        记住密码
                    </label>
                    <a class="mdui-typo-caption-opacity remember-pwd" href="{{ route('password.request') }}">忘记密码?</a>
                </div>
                <div class="form-group">
                    <button id="submit" type="submit" class="submit mdui-btn mdui-color-theme-accent mdui-ripple">登 录</button>
                </div>
                <div class="kt-register form-group">
                    <a class="mdui-typo-caption-opacity" href="{{ route('register') }}">还没帐号?免费注册</a>
                </div>
            </form>
        </div>
    </div>
    <div class="swiper-container mdui-hidden-xs-down">
        <div class="swiper-wrapper">
            @foreach($loginbanners as $loginbanner)
            <div class="swiper-slide">
                <a href="{{ $loginbanner->link }}"  style="background-image:url('{{ $loginbanner->banner }}')">
                </a>
            </div>
            @endforeach
        </div>
        <!-- 如果需要分页器 -->
        <div class="swiper-pagination"></div>
    </div>
    <div class="login-footer mdui-hidden-xs-down mdui-text-color-grey">
        <p class="txt-center">深圳市沟通科技有限公司 · 版权所有 电话：0755-26525890 地址：深圳市南山区科技园南区W1-B栋5楼</p>
        <p class="txt-center"><small>KouTon © 2000-2018 粤ICP备09149236 号</small></p>
    </div>
</div>
@endsection
