@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/register.css') }}">
@stop
@section('content')
<div class="mdui-container">
    <div class="panel-default">
        <div class="panel-heading mdui-typo-display-1-opacity">用户注册</div>

    <div class="panel-body mdui-center">
        <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

    <div class="form-group">
        <div class="mdui-textfield mdui-textfield-floating-label{{ $errors->has('phone') ? ' mdui-textfield-invalid-html5' : '' }}">
          <label class="mdui-textfield-label">手机号码</label>
          <input id="phone" class="mdui-textfield-input" type="text" pattern="^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|17[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$" name="phone" value="{{ old('phone') }}" required/>
          @if ($errors->has('phone'))
              <div class="mdui-textfield-error">{{ $errors->first('phone') }}</div>
          @else
              <div class="mdui-textfield-error">手机号不正确</div>
          @endif
        </div>
    </div>

    <div class="form-group" style="display:none;">
        <div class="sms-input">
        <div class="mdui-textfield mdui-textfield-floating-label{{ $errors->has('vercode') ? ' mdui-textfield-invalid-html5' : '' }}">
          <label class="mdui-textfield-label">短信验证码</label>
          <input id="vercode" class="mdui-textfield-input" type="text"  name="vercode" />
          @if ($errors->has('vercode'))
              <div class="mdui-textfield-error">{{ $errors->first('vercode') }}</div>
          @else
              <div class="mdui-textfield-error">短信验证码不正确</div>
          @endif
        </div>

        </div>
        <div class="send-sms">
        <button id="btnvercode" class="mdui-btn mdui-btn-raised mdui-ripple">获取验证码</button>
        </div>
    </div>

    <div class="form-group">
        <div class="captcha-input">
        <div class="mdui-textfield mdui-textfield-floating-label{{ $errors->has('vercode') ? ' mdui-textfield-invalid-html5' : '' }}">
          <label class="mdui-textfield-label">图形验证码</label>
          <input id="captcha" class="mdui-textfield-input" type="text"  name="captcha" required/>
          @if ($errors->has('captcha'))
              <div class="mdui-textfield-error">{{ $errors->first('captcha') }}</div>
          @else
              <div class="mdui-textfield-error">图形证码不正确</div>
          @endif
        </div>
        </div>

        <div class="captcha-img">
        <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码">
        </div>
    </div>
   
    <div class="form-group">
        <button id="submit" type="submit"  class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent submit">立 即 注 册</button>  
    </div>
    
    <div class="form-group kt-register">
        <a class="mdui-typo-caption-opacity" href="{{ route('login') }}">已有账户？点击登录</button>  
    </div>
    </form>
              
    </div>
</div>
<div class="mdui-text-color-grey copyright mdui-hidden-xs-down">
  <p class="txt-center">深圳市沟通科技有限公司 · 版权所有 电话：0755-26525890 地址：深圳市南山区科技园南区W1-B栋5楼</p>
  <p class="txt-center"><small>KouTon © 2000-2018 粤ICP备09149236 号</small></p>
</div>
@endsection
@section('script')
<script>
var $$ = mdui.JQ;
$$(document).ready(function () {
    
    $$('#submit').on('click',function(e){
        var phone = $$('#phone');
       var captcha = $$('#captcha');
       if(!phone.val() || !phone.val().match(/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|17[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/)){
          phone.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
          e.preventDefault();
          return false;
        }
       if(!captcha.val()){
          captcha.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
          e.preventDefault();
          return false;
        }
        $$.ajax({
          method: 'POST',
          url: '/ajax/captcha',
          headers: {'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')},
          data: {
            captcha: captcha.val()
          },
          success: function (data) {
            if(JSON.parse(data).captcha){
                $$('#submit').text('下 一 步');
            }
          }
        });
        return false;
    });
    var getCodeBtn = $$('#btnvercode');
    getCodeBtn.on('click',function(e){
        var phone = $$('#phone');
        if(!phone.val() || !phone.val().match(/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|17[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/)){
            phone.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
            e.preventDefault();
            return false;
        }
        getCodeBtn.attr('disabled',true);
        var num = 60;
        var  interval = setInterval(() => {
            if(num < 0){
                clearInterval(interval);
                getCodeBtn.removeAttr('disabled');
                getCodeBtn.text("获取验证码");
                return;
            }
            getCodeBtn.text("("+ num +")重新获取");
            num--;
        }, 1000);
    })
});
 
</script>
@stop