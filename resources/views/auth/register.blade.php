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

    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
        <div class="mdui-textfield mdui-textfield-floating-label">
          <label class="mdui-textfield-label">手机号码</label>
          <input id="phone" class="mdui-textfield-input" type="text" pattern="^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|17[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$" name="phone" value="{{ old('phone') }}" required/>
          <div class="mdui-textfield-error">手机号不正确</div>
        </div>
        @if ($errors->has('phone'))
            <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('vercode') ? ' has-error' : '' }}">
        <div class="sms-input">
        <div class="mdui-textfield mdui-textfield-floating-label">
          <label class="mdui-textfield-label">验证码</label>
          <input id="vercode" class="mdui-textfield-input" type="text"  name="vercode" required/>
          <div class="mdui-textfield-error">短信验证码不正确</div>
        </div>
        @if ($errors->has('vercode'))
            <span class="help-block">
                <strong>{{ $errors->first('vercode') }}</strong>
            </span>
        @endif
        </div>
        <div class="send-sms">
        <button id="btnvercode" class="mdui-btn mdui-btn-raised mdui-ripple">获取验证码</button>
        </div>
    </div>

    <div class="form-group">
        <button id="submit" type="submit"  class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent submit">注 册</button>  
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
       var vercode = $$('#vercode');
       if(!phone.val() || !phone.val().match(/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|17[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/)){
        phone.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
        e.preventDefault();
        }
       if(!vercode.val()){
        vercode.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
        e.preventDefault();
        }
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
        var metas = $$('meta');
        var csrfToken = '';
        for (let i = 0; i < metas.length; i++) {
            if(metas[i].name ===  'csrf-token'){
                csrfToken = metas[i].content;
                break;
            }
        }
        $$.ajax({
          method: 'POST',
          url: './test.php',
          data: {
            phone: phone.val(),
            csrfToken: csrfToken
          },
          success: function (data) {
            console.log(data);
          }
        });
    })
});
 
</script>
@stop