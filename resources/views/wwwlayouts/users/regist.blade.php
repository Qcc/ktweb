@extends('wwwlayouts.default')
@section('title','管理资讯')

@section('content')
<h1>注册</h1>
<form method="POST" action="{{ route('users.store') }}">
{{ csrf_field() }}
<div class="mdui-textfield mdui-textfield-floating-label">
  <label class="mdui-textfield-label">手机号</label>
  <input class="mdui-textfield-input" name="phone" value="{{ old('phone') }}" type="text" required/>
  <div class="mdui-textfield-error">手机号不能为空</div>
</div>

<div class="mdui-textfield mdui-textfield-floating-label">
  <label class="mdui-textfield-label">Password</label>
  <input class="mdui-textfield-input" name="password" value="{{ old('password') }}" type="text" pattern="^.*(?=.{6,})(?=.*[a-zA-Z]).*$" required/>
  <div class="mdui-textfield-error">密码至少 6 位，且包含大小写字母</div>
  <div class="mdui-textfield-helper">请输入至少 6 位，且包含字母的密码</div>
</div>
<button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">注册</button>     
      </form>
@stop