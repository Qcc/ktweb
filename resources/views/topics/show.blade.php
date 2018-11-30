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
                        <div class="mdui-col-xs-4">
                            <p>文章</p>
                            <p>10</p>
                        </div>
                        <div class="mdui-col-xs-4">
                            <p>粉丝</p>
                            <p>40</p>
                        </div>
                        <div class="mdui-col-xs-4">
                            <p>喜欢</p>
                            <p>24</p>
                        </div>
                    </div>
                    <div class="usercard-message">
                        <div class="mdui-btn-group">
                            <button class="mdui-btn mdui-ripple"><i class="mdui-icon material-icons">&#xe0e1;</i> 发私信</button>
                            <button class="mdui-btn mdui-ripple"><i class="mdui-icon material-icons">&#xe145;</i> 加关注</button>
                        </div>
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
                    <a href="" class="mdui-btn mdui-ripple">
                            <i class="mdui-icon material-icons">&#xe417;</i>关注
                    </a>
                    <a href="" class="mdui-btn mdui-ripple">
                            <i class="mdui-icon material-icons">&#xe8b2;</i>举报
                    </a>
                    <a href="" class="mdui-btn mdui-ripple">
                            <i class="mdui-icon material-icons">&#xe25a;</i>置顶
                    </a>
                    <a href="" class="mdui-btn mdui-ripple">
                            <i class="mdui-icon material-icons">&#xe83a;</i>精华
                    </a>
                    @can('update', $topic)
                    <div class="operate">
                        <a href="{{ route('topics.edit', $topic->id) }}" class="mdui-btn mdui-ripple" role="button">
                                <i class="mdui-icon material-icons">&#xe3c9;</i> 编辑
                        </a>

                        <form action="{{ route('topics.destroy', $topic->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="mdui-btn mdui-ripple" style="margin-left: 6px">
                                    <i class="mdui-icon material-icons">&#xe92b;</i>
                                删除
                            </button>
                        </form>
                    </div>
                    @endcan

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
<script>
    var $$ = mdui.JQ;
    $$(document).ready(function () {
        $$(document).ready(function () {
            $$('#like').on("click", function () {
                var A = $$(this).attr("id");
                var B = A.split("like");
                var messageID = B[1];
                var C = parseInt($$("#likeCount" + messageID).html());
                $$(this).css("background-position", "")
                var D = $$(this).attr("rel");

                if (D === 'like') {
                    $$("#likeCount" + messageID).html(C + 1);
                    $$(this).addClass("heartAnimation").attr("rel", "unlike");

                } else {
                    $$("#likeCount" + messageID).html(C - 1);
                    $$(this).removeClass("heartAnimation").attr("rel", "like");
                    $$(this).css("background-position", "left");
                }
            });
        });
    });
</script>
@stop