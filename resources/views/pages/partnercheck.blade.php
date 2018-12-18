@extends('layouts.app')
@section('title','商机分配')

@section('content')
<div class="mdui-container partnerinfo">
    <div class="partner-warp mdui-shadow-20">
        <div class="title">
            <p>联系客户结果</p>
            <p></p>
        </div>
        <div>
            <span>客户区域</span>
            <span>{{ $business->city }}</span>
            <span> - </span>
            <b>{{ $business->name }}</b>
            <span> / </span>
            <span>{{ $business->phone }}</span>

        </div>
        <form action="{{ route('business.update', $business->id) }}" method="POST" accept-charset="UTF-8">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <textarea type="text" name="coment" row='10' value="{{ old('coment') }}" placeholder="联系结果" ></textarea>
            </div>

            <div class="form-group">
                <button submit class="mdui-btn mdui-color-theme-accent mdui-ripple" id="partner">
                    <i class="mdui-icon material-icons">&#xe163;</i> 已经联系</button>
            </div>
        </form>
    </div>
</div>
@stop

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
<style>
    .business-check-page .kt-nav-header .kt-navigetion-sections,
    .business-check-page .kt-nav-header .kt-navigetion-sections {
        color: #333;
    }

    .business-check-page .kt-nav-header .kt-nav-background,
    .business-check-page .kt-nav-header .kt-nav-background {
        background: rgba(255, 255, 255, 0.9);
        border-bottom: 1px solid rgba(200, 200, 200, 0.5);
    }
</style>
@stop