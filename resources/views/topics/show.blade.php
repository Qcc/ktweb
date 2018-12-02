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
<script>
    var $$ = mdui.JQ;
    $$(document).ready(function () {
        // 点赞
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
        //加关注 取消关注 粉丝
        $$(".user-follower").on("click",function(){
            var id = $$('#author_id').attr('data_id');
            $$.ajax({
                method: 'POST',
                url: '/users/followers/action',
                ContentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function (data) {
                    var data = JSON.parse(data);
                    if(data.result){
                        $$('.user-follower').empty().append("<i class='mdui-icon material-icons'>&#xe5ca;</i> 已关注").attr('title','取消关注将不会再收到他的动态');
                    }else{
                        $$('.user-follower').empty().append("<i class='mdui-icon material-icons'>&#xe145;</i> 加关注").attr('title','关注后能收到他的最新动态');
                    }
                }
            })
        });
        //加关注 取消关注 文章
        $$(".topic-follower").on("click",function(){
            var id = $$('#topic_id').attr('data_id');
            $$.ajax({
                method: 'POST',
                url: '/topic/followers/action',
                ContentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function (data) {
                    var data = JSON.parse(data);
                    if(data.result){
                        $$('.topic-follower').empty().append("<i class='mdui-icon material-icons'>&#xe5ca;</i> 已关注").attr('title','取消关注将不会再收到新的回复通知');
                    }else{
                        $$('.topic-follower').empty().append("<i class='mdui-icon material-icons'>&#xe145;</i> 加关注").attr('title','关注后能收到文章的最新回复通知');
                    }
                }
            })
        });
    });
</script>
@stop