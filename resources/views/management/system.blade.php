@extends('layouts.club')

@section('title', '运行状态')

@section('content')
<div class="mdui-container useredit-box">
    <div class="mdui-row">
        <div class="mdui-col-xs-3">
            <div class="edit-item-warp">
                    @include('management._menu_club')
            </div>
        </div>
        <div class="mdui-col-xs-8">
            <div class="edit-action-warp">
                <p>PHP程式版本：{{PHP_VERSION}}</p>   
                <p>ZEND版本： {{zend_version()}}</p>
                <p>MySQL数据库持续连接 ： {{@get_cfg_var("mysql.allow_persistent")?"是 ":"否"}}</p>
                <p>MySQL最大连接数： {{@get_cfg_var("mysql.max_links")==-1 ? "不限" : @get_cfg_var("mysql.max_links")}}</p>
                <p>服务器操作系统： {{PHP_OS}}</p>
                <p>服务器端信息： {{$_SERVER ['SERVER_SOFTWARE']}}</p>
                <p>最大上传限制： {{get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传附件"}}</p>
                <p>最 大执行时间： {{get_cfg_var("max_execution_time")."秒 "}}</p>
                <p>脚本运行占用最大内存： {{get_cfg_var ("memory_limit")?get_cfg_var("memory_limit"):"无" }}</p>
                <p>获得服务器系统时区 {{  config("app.timezone")}}</p>
                <p>获得服务器系统时间 {{date("Y-m-d G:i:s")}}</p>
            </div>
        </div>
    </div>
</div>
@stop