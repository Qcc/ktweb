@extends('layouts.app')
@section('title','找不到页面')
@section('content')
<div class="without-404-box">
    <div class="title">
        <h3>对不起，您访问的页面不存在或资源已被删除!</h3>
    </div>
    <div class="back">
        <a href="javascript:;" onClick="javascript :history.back(-1);">点击返回</a>
    </div>
</div>
@stop