@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
@stop
@section('content')
<div class="login-form-warp">
    <div class="login-form">
    <div class="mdui-typo-subheading-opacity">用户登录</div>
    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="mdui-textfield mdui-textfield-floating-label">
                        <label class="mdui-textfield-label">手机号 / 邮箱</label>
                        <input  class="mdui-textfield-input" type="text" class="form-control" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                      <div class="mdui-textfield-error">用户名不能为空</div>
                    </div>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">密 码</label>
                    <input  class="mdui-textfield-input" id="password" type="password" class="form-control" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  <div class="mdui-textfield-error">密码不能为空</div>
                </div>
            </div>
            <div class="form-group">
                <label class="mdui-checkbox mdui-typo-caption-opacity">
                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}/>
                  <i class="mdui-checkbox-icon"></i>
                  记住密码
                </label>
                <a class="mdui-typo-caption-opacity" href="{{ route('password.request') }}">忘记密码?</a>
            </div>
            <div class="form-group">
                <button type="submit" class="submit mdui-btn mdui-color-theme-accent mdui-ripple">登 录</button>
            </div>
            <div class="form-group">
            <a class="mdui-typo-caption-opacity" href="{{ route('register') }}">还没帐号?免费注册</a>
            </div>
        </form>
     </div>
    </div>
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide red-slide">
            <a href="">
                <img  class="login-banner" src="{{ asset('images/banner1.jpg') }}" alt="">
            </a>
        </div>
        <div class="swiper-slide green-slide">
          <div class="title">Slide 2</div>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
<script>
var $$ = mdui.JQ;
$$(document).ready(function () {
	// 初始化首页轮播图
	if($$('.swiper-container').length === 1){
		var swiper = new Swiper('.swiper-container', {});
  }
});
 
</script>
@stop