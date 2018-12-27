@extends('layouts.club')

@section('title', '修改账户密码')

@section('content')
<div class="mdui-container useredit-box">
    <div class="mdui-row">
        <div class="mdui-col-sm-3 mdui-col-xs-12">
            <div class="edit-item-warp">
                <div class="edit-item">
                    <ul class="edit-list">
                        <li><a href="{{ route('users.edit', Auth::id()) }}" class="mdui-btn mdui-ripple"><i class="kticon">&#xe74d;</i>
                                账户信息</a></li>
                        <li><a href="{{ route('users.password', Auth::id()) }}" class="mdui-btn mdui-color-theme-accent mdui-ripple"><i
                                    class="kticon">&#xe622;</i> 修改密码</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="mdui-col-sm-8 mdui-col-xs-12">
            <div class="edit-action-warp">
                <div class="edit-action">
                    @include('common.error')
                    <h2 class="title">
                        <i class="kticon">&#xe622;</i> 修改账户密码
                    </h2>
                    <div class="mdui-divider"></div>
                    <div class="edit-form">
                        <form action="{{ route('users.uppwd', $user->id) }}" method="POST" accept-charset="UTF-8"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <div class="mdui-textfield mdui-textfield-floating-label">
                                    <label class="mdui-textfield-label">原密码</label>
                                    <input class="mdui-textfield-input" type="password" name="oldpassword" />
                                    <div class="mdui-textfield-helper">请输入旧密码</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mdui-textfield mdui-textfield-floating-label">
                                    <label class="mdui-textfield-label">新密码</label>
                                    <input class="mdui-textfield-input" type="password" name="password" />
                                    <div class="mdui-textfield-helper">请输入新密码</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="mdui-textfield mdui-textfield-floating-label">
                                    <label class="mdui-textfield-label">确认密码</label>
                                    <input class="mdui-textfield-input" type="password" name="password_confirmation" />
                                    <div class="mdui-textfield-helper">请确认新密码</div>
                                </div>
                            </div>

                            <div class="form-btn">
                                <button type="submit" class="mdui-btn mdui-color-theme-accent mdui-ripple">保存</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop