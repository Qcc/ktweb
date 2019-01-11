@extends('layouts.app')
@section('title', '找回密码')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="mdui-tab" mdui-tab>
                        <a href="#email-tab" class="mdui-ripple">邮箱找回</a>
                        <a href="#sms-tab" class="mdui-ripple">短信找回</a>
                    </div>
                    <div id="email-tab" class="mdui-p-a-2">
                        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">邮箱地址</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                        required>

                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        发送重置密码邮件
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="sms-tab" class="mdui-p-a-2">短信找回</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection