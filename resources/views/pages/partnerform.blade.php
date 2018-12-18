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

            <div class="form-group">
                <a href="javascript:;" class="mdui-btn mdui-color-theme-accent mdui-ripple" id="partner">
                    <i class="mdui-icon material-icons">&#xe163;</i> 提交申请</a>
            </div>
        </form>
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

@section('script')
<script>
    $$(document).ready(function () {
        //加关注 取消关注 粉丝
    $$("#partner").on("click", function () {
        $$(this).attr('disabled', true);
        var name = $$('#name').val();
        var phone = $$('#phone').val();
        var city = $$('#city').val();
        $$.ajax({
            method: 'POST',
            url: '/business/store',
            ContentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                name: name,
                phone: phone,
                city: city,
            },
            success: function (data) {
                var data = JSON.parse(data);
                console.log(data);
                if (data.status) {
                } else {
                     
                }
                $$('#partner').removeAttr('disabled');
            }
        })
    });
    });
</script>

@stop