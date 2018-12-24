@extends('layouts.club')

@section('title', $topic->title)

@section('description', $topic->excerpt)

@section('content')
<div class="mdui-container club-artical">
    <div class="mdui-row">
        <div class="mdui-col-sm-3 mdui-col-xs-12">
            @include('users._user_info',['user'=>$topic->user])
            <div class="new-article-warp">
                <div class="new-article">最新发表</div>
                <div class="list">
                    @foreach($topics as $topic)
                    <div class="item">
                        <span>{{ $topic->created_at->diffForHumans() }} </span>
                        <a href="{{ route('topics.show',$topic->id)}}" target="_blank" title="{{ $topic->title}}">
                            <p>{{ $topic->title }}</p>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @include('pages.side_advertising')
        </div>
        <div class="mdui-col-sm-9  mdui-col-xs-12 topic-content">
            <div class="article-warp">
                <div class="article-body">
                    <div class="article-header">
                        <div class="article-title">
                            <h1 class="article-title-h1">
                                {{ $topic->title }}
                            </h1>
                        </div>
                        @guest
                        <div class="article-like-guest xhs_zan_hide" mdui-dialog="{target: '#require-login'}" title="喜欢就点个赞吧">
                            <div class="heart"></div>
                            @else
                            <div class="article-like excellent" title="喜欢就点个赞吧">
                                <div class="heart {{ Auth::user()->isTopicGreat($topic->id)?'heartAnimation':'' }}"></div>
                                @endguest
                                <div class="likeCount" id="likeCount">{{ count($topic->topicGreats) }}</div>
                            </div>
                        </div>

                        <div class="article-meta mdui-typo-body-1-opacity">
                            创建于 {{ $topic->created_at->diffForHumans() }}
                            <span> / </span>
                            阅读数 {{ $topic->view_count }}
                            <span> / </span>
                            回复数 {{ $topic->reply_count }}
                            <span> / </span>
                            更新于 {{ $topic->updated_at->diffForHumans() }}
                            @if($topic->excellent)
                            <span> / </span>
                            <span><i class="mdui-icon material-icons" title="该主题已被设置为精华" style="color:#00C853;">&#xe83a;</i></span>
                            @endif
                            @if($topic->topping)
                            <span> / </span>
                            <span><i class="mdui-icon material-icons" title="该主题已被置顶" style="color:#FF9800;">&#xeb45;</i></span>
                            @endif
                        </div>
                        <div class="mdui-divider"></div>
                        <div class="topic-body">
                            {!! $topic->body !!}
                        </div>
                    </div>
                    @if($topic->excellent)
                    <div class="article-excellent">
                        <div class="excel-title">本主题已被设置为精华帖!</div>
                        <p class="excel-name">由 {{ $topic->excellent_user }} 于 {{ $topic->excellent_time }} 添加</p>
                    </div>
                    @endif
                    @include('topics._follow_topic',$topic)
                </div>
            </div>
            @include('topics._execllent_list',['users' => $topic->topicGreats,'topic'=>$topic])
            {{-- 用户回复列表 --}}
            <div class="replay-warp">
                <!-- 视条件加载模版
            话题回复功能只允许登录用户使用，未登录用户不显示即可。 -->
                @include('topics._reply_list', ['replies' => $topic->replies()->with('user')->get()])
                @includeWhen(Auth::check(), 'topics._reply_box', ['topic' => $topic])
            </div>
        </div>
    </div>
</div>
<!-- 需要登录操作 -->
@include('common.require_login')
@endsection

@section('script')
<script src="{{ asset('js/laydate.js')}}"></script>
<script>
    var $$ = mdui.JQ;
    $$(document).ready(function () {

    });
</script>
@stop