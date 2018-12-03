@extends('layouts.club')

@section('title', $topic->title)

@section('description', $topic->excerpt)

@section('content')
<div class="mdui-container club-artical">
    <div class="mdui-row">

        <div class="mdui-col-xs-3">
            <div class="usercard-warp">
                <div class="usercard-body">
                    <div class="usercard-header">
                        <div class="usercard-avatar">
                            <a href="{{ route('users.show', $topic->user->id) }}">
                                <img class="thumbnail img-responsive" src="{{ $topic->user->avatar }}" width="300px"
                                    height="300px">
                            </a>
                        </div>
                        <div class="usercard-name">
                            <div class="name mdui-typo-title-opacity">
                                {{ $topic->user->username }}
                            </div>
                            <div class="mdui-typo-body-1-opacity">
                                {{ $topic->user->introduction }}
                            </div>
                        </div>
                    </div>
                    <div class="usercard-favorites mdui-row">
                        <div class="mdui-col-xs-3">
                            <p>文章</p>
                            <p>{{ $topic->user->topics()->count() }}</p>
                        </div>
                        <div class="mdui-col-xs-3">
                            <a href="{{ route('users.followings',$topic->user) }}">
                                <p>粉丝</p>
                                <p>{{ count($topic->user->followers) }}</p>
                            </a>
                        </div>
                        <div class="mdui-col-xs-3">
                            <a href="{{ route('users.followers',$topic->user) }}">
                                <p>关注</p>
                                <p>{{ count($topic->user->followings) }}</p>
                            </a>
                        </div>
                        <div class="mdui-col-xs-3">
                            <p>喜欢</p>
                            <p>24</p>
                        </div>
                    </div>
                    @include('users._follow_users',['user' => $topic->user])

                </div>
            </div>
        </div>
    </div>

    <div class="mdui-col-xs-9 topic-content">
        <div class="article-warp">
            <div class="article-body">
                <div class="article-header">
                    <div class="article-title">
                        <h1 class="article-title-h1">
                            {{ $topic->title }}
                        </h1>
                    </div>
                    <div class="article-like" title="喜欢就点个赞吧">
                        <div class="heart" id="like" style="background-position: left center;"></div>
                        <div class="likeCount" id="likeCount">4</div>
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
                </div>
                <div class="mdui-typo">
                    <hr />
                </div>
                <div class="topic-body">
                    {!! $topic->body !!}
                </div>
                @include('topics._follow_topic',$topic)
            </div>
        </div>


        {{-- 用户回复列表 --}}
        <div class="panel panel-default topic-reply">
            <div class="panel-body">
                <!-- 视条件加载模版
                话题回复功能只允许登录用户使用，未登录用户不显示即可。 -->
                @includeWhen(Auth::check(), 'topics._reply_box', ['topic' => $topic])
                @include('topics._reply_list', ['replies' => $topic->replies()->with('user')->get()])
            </div>
        </div>

    </div>
</div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/laydate.js')}}"></script>
<script>
    var $$ = mdui.JQ;
    $$(document).ready(function () {
        
    });
</script>
@stop