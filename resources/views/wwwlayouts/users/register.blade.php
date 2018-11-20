<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>用户注册-深圳市沟通科技有限公司</title>
  <link rel="stylesheet" href="/css/mdui.min.css" type="text/css">
  <link rel="stylesheet" href="/css/style.css" type="text/css">

</head>
<body class="mdui-theme-primary-pink mdui-theme-accent-pink">
<div class="mdui-container register-warp">
  <div class="mdui-row">
  <div class="mdui-col-xs-12 register-item">
    <div class="kt-log">
      <img src="/images/logo-blue.png" alt="沟通科技logo">
    </div>
  </div>
  <div class="mdui-col-xs-12 register-item">
    <h1 class="mdui-typo-display-1-opacity register-title">用户注册</h1>
    <div class="mdui-typo">
      <hr/>
    </div>
  </div>
    <div class="mdui-col-xs-12 register-item">
      <div class="register-form">
        <form method="POST" action="{{ route('users.store') }}">
          {{ csrf_field() }}
          <div class="mdui-textfield mdui-textfield-floating-label">
            <label class="mdui-textfield-label">请输入手机号</label>
            <input class="mdui-textfield-input" name="phone" value="{{ old('phone') }}" pattern="^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$" type="text" required/>
            <div class="mdui-textfield-error">手机号不正确</div>
          </div>
          
              <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">请输入验证码</label>
                <input class="mdui-textfield-input" name="password" value="{{ old('password') }}" type="text" pattern="^.*(?=.{6,})(?=.*[a-zA-Z]).*$" required/>
                <div class="mdui-textfield-error">密码至少 6 位，且包含大小写字母</div>
                <div class="mdui-textfield-helper">请输入至少 6 位，且包含字母的密码</div>
              </div>

          <div class="lock-drag">
            <div class="bg"></div>
              <div class="text" onselectstart="return false;">请拖动滑块来完成验证</div>
            <div class="btn" id="btn">&gt;&gt;</div>
          </div>

          <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">注册</button>     
        </form>
      </div>
    </div>

  </div>
</div>
<div class="mdui-text-color-grey copyright">
  <p class="txt-center">深圳市沟通科技有限公司 · 版权所有 电话：0755-26525890 地址：深圳市南山区科技园南区W1-B栋5楼</p>
  <p class="txt-center"><small>KouTon © 2000-2018 粤ICP备09149236 号</small></p>
</div>
<script src="/js/mdui.min.js"></script>
<script src="/js/register.js"></script>
</body>
</html>
