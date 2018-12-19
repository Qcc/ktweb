@extends('layouts.app')
@section('title','商机分配')

@section('content')
<div class="mdui-container partnerinfo">
    <div class="partner-warp partner-warp-check mdui-shadow-20">
        <div class="title">
            <p>联系客户结果</p>
            @if($business->comment)
            <p class="last">{{ $business->user->name }} 在 {{ $business->updated_at->diffForHumans() }}联系了客户</p>
            @else
            <p class="last">请在{{ $business->created_at->addMinutes(30) }}之前联系客户</p>
            @endif
            <div class="mdui-divider"></div>
        </div>
       
        <div class="message">
            <span>城市 </span>
            <span>{{ $business->city }}</span>
            <span>/ 联系人 </span>
            <b>{{ $business->name }}</b>
            <span>/ 电话 </span>
            <span>{{ $business->phone }}</span>
        </div>
        @if($business->comment)
            <div class="comment">
                <p>反馈: {{ $business->comment }}</p>
            </div>
            <div class="delete">
            <form action="{{ route('business.destroy', $business->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="mdui-btn mdui-color-theme-accent mdui-ripple" style="margin-left: 6px">
                  <i class="mdui-icon material-icons">&#xe92b;</i>
                  关闭
                </button>
              </form>
            </div>
        @else
        <form action="{{ route('business.update', $business->id) }}" method="POST" accept-charset="UTF-8">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <textarea type="text" name="comment" row='10' value="{{ old('comment') }}" placeholder="联系结果" ></textarea>
            </div>

            <div class="form-group">
                <button submit class="mdui-btn mdui-color-theme-accent mdui-ripple" id="partner">
                    <i class="mdui-icon material-icons">&#xe163;</i> 已经联系</button>
            </div>
        </form>
        @endif
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