@extends('layouts.app')
@section('title','合作伙伴')

@section('content')
<div class="mdui-container-full partner">
    <div class="partner-bg">
        <div class="head">
            <p class="title">携手沟通科技共掘企业服务领域蓝海市场</p>
            <p class="name">“沟通科技合伙人”全国火热招募中...</p>
            <a href="{{ route('business.info') }}" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple">申请加入</a>
        </div>
    </div>
    <div class="mdui-container">
        <div class="mdui-row partner-list">
            <div class="mdui-col-xs-3">
                <div class="icon"><i class="mdui-icon material-icons">&#xe7f0;</i></div>
                <div class="title">
                    <p>技术和服务支持</p>
                </div>
                <div class="info">
                    <p>专项技术领域获得沟通科技专业架构师团队的技术支持，在垂直市场获得领先优势。</p>
                </div>
            </div>
            <div class="mdui-col-xs-3">
                <div class="icon"><i class="mdui-icon material-icons">&#xe413;</i></div>
                <div class="title">
                    <p>市场和营销支持</p>
                </div>
                <div class="info">
                    <p>客户沙龙、研讨会，行业展会，沟通科技用户大会等丰富的市场和营销机会。</p>
                </div>
            </div>
            <div class="mdui-col-xs-3">
                <div class="icon"><i class="mdui-icon material-icons">&#xe03f;</i></div>
                <div class="title">
                    <p>培训支持</p>
                </div>
                <div class="info">
                    <p>专属合作伙伴拓展经理提供业务支持和商务支持，帮助您在云计算领域取得成功</p>
                </div>
            </div>
            <div class="mdui-col-xs-3">
                <div class="icon"><i class="mdui-icon material-icons">&#xe6c5;</i></div>
                <div class="title">
                    <p>管理支持</p>
                </div>
                <div class="info">
                    <p>提供基于市场营销，实施服务，团队建设，运营管理等各方面的标准化支持辅导</p>
                </div>
            </div>
        </div>
    </div>

</div>
@stop