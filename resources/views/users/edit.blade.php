@extends('layouts.club')

@section('title', '编辑个人资料')

@section('content')
<div class="mdui-container useredit-box">
    <div class="mdui-row">
        <div class="mdui-col-xs-3">
            <div class="edit-item-warp">
                <div class="edit-item">
                    <ul class="edit-list">
                        <li><a href="{{ route('users.edit', Auth::id()) }}" class="mdui-btn mdui-color-theme-accent mdui-ripple">
                                <i class="mdui-icon material-icons">&#xe85d;</i> 账户信息</a></li>
                        <li><a href="{{ route('users.password', Auth::id()) }}" class="mdui-btn mdui-ripple">
                                <i class="mdui-icon material-icons">&#xe0da;</i> 修改密码</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="mdui-col-xs-9">
            <div class="edit-action-warp">
                <div class="edit-action">
                    @include('common.error')
                    <h2 class="title">
                        <i class="mdui-icon material-icons">&#xe8b8;</i> 编辑个人资料
                    </h2>
                    <div class="mdui-divider"></div>
                    <div class="edit-form">
                        <form action="{{ route('users.update', $user->id) }}" method="POST" accept-charset="UTF-8"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <div class="mdui-textfield mdui-textfield-floating-label">
                                    <label class="mdui-textfield-label">真实姓名</label>
                                    <input class="mdui-textfield-input {{ $user->company?'disabled':'' }}" type="text"
                                        name="name" {{ $user->name?'readonly':'' }} value="{{ old('name',$user->name) }}" />
                                    <div class="mdui-textfield-helper">请输入姓名,保存后不能再修改，请谨慎操作</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="mdui-textfield mdui-textfield-floating-label">
                                    <label class="mdui-textfield-label">昵称</label>
                                    <input class="mdui-textfield-input" type="text" name="nickname" value="{{ old('nickname',$user->nickname) }}" />
                                    <div class="mdui-textfield-helper">请输入昵称</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="mdui-textfield mdui-textfield-floating-label">
                                    <label class="mdui-textfield-label">公司或组织</label>
                                    <input class="mdui-textfield-input {{ $user->company?'disabled':'' }}" type="text"
                                        name="company" {{ $user->company?'readonly':'' }} value="{{ old('company',$user->company) }}" />
                                    <div class="mdui-textfield-helper">请输入公司名称,保存后不能再修改，请谨慎操作</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="mdui-textfield mdui-textfield-floating-label">
                                    <label class="mdui-textfield-label">电话</label>
                                    <input class="mdui-textfield-input" type="text" name="telephone" value="{{ old('telephone',$user->telephone) }}" />
                                    <div class="mdui-textfield-helper">请输入固定电话</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="mdui-textfield mdui-textfield-floating-label">
                                    <label class="mdui-textfield-label">邮箱</label>
                                    <input class="mdui-textfield-input {{ $user->email?'disabled':'' }}" type="email"
                                        name="email" {{ $user->email?'readonly':'' }} value="{{ old('email', $user->email) }}" />
                                    <div class="mdui-textfield-helper">请输入邮箱,保存后不能再修改，请谨慎操作</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mdui-textfield mdui-textfield-floating-label">
                                    <label class="mdui-textfield-label">简介</label>
                                    <textarea name="introduction" class="mdui-textfield-input" type="text">{{ old('introduction', $user->introduction) }}</textarea>
                                    <div class="mdui-textfield-helper">请输入个人简介</div>
                                </div>
                            </div>

                            <div class="form-group avatar">
                                @if($user->avatar)
                                <br>
                                <img class="thumbnail img-responsive" src="{{ $user->avatar }}" width="200" />
                                @endif
                                <input class=" " type="file" name="avatar">
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