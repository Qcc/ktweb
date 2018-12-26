@extends('layouts.app')
@section('title','填写联系方式')

@section('content')
<div class="mdui-container partnerinfo">
    <div class="partner-warp mdui-shadow-20">
        <div class="title">
            <p>立刻申请工作人员联系我</p>
            <p>请留下您的信息与联系方式</p>
        </div>
        <form  method="POST" accept-charset="UTF-8">

            <div class="form-group">
                <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="姓名" required />
            </div>
            <div class="form-group">
                <input id="phone" type="text" name="phone" value="{{ old('phone') }}" placeholder="电话"
                    required />
            </div>
            <div class="form-group">
                <input id="city" type="text" name="city" value="{{ old('city') }}" placeholder="城市" />
            </div>
            <p class="fiald"></p>
            <div class="form-group">
                <a href="javascript:;" class="mdui-btn mdui-color-theme-accent mdui-ripple" id="partner">
                    <i class="kticon">&#xe61f;</i> 提交申请</a>
            </div>
        </form>
        <div class="success">
            <div>
                <i class="kticon">&#xe676;</i>
                <p>提交成功!</p>
                <p class="msg"></p>
            </div>
        </div>
    </div>
</div>
@stop

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
<style>
    .business-info-page .kt-nav-header .kt-navigetion-sections,
    .business-info-page .kt-nav-header .kt-navigetion-sections {
        color: #333;
    }

    .business-info-page .kt-nav-header .kt-nav-background,
    .business-info-page .kt-nav-header .kt-nav-background {
        background: rgba(255, 255, 255, 0.9);
        border-bottom: 1px solid rgba(200, 200, 200, 0.5);
    }
</style>
@stop