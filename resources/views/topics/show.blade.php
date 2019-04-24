@extends('layouts.club')

@section('title', $topic->title)

@section('description', $topic->excerpt)
@section('keywords', $topic->keywords)

@section('content')
<div class="mdui-container club-artical">
    <div class="mdui-row">
        <div class="mdui-col-sm-3 mdui-col-xs-12">
            @include('users._user_info',['user'=>$topic->user])
            <div class="new-article-warp">
                <div class="new-article">最新发表</div>
                <div class="list">
                    @foreach($topics as $article)
                    <div class="item">
                        <span>{{ $article->created_at->diffForHumans() }} </span>
                        <a href="{{ route('topics.show',$article->id)}}" target="_blank" title="{{ $article->title}}">
                            <p>{{ $article->title }}</p>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="new-article-warp">
                <div class="new-article">推荐话题</div>
                <div class="list">
                @foreach($moreTopics as $moreTopic)
                <div class="item">
                        <span>{{ $moreTopic->created_at->diffForHumans() }} </span>
                        <a href="{{ route('topics.show',$moreTopic->id)}}" target="_blank" title="{{ $moreTopic->title}}">
                            <p>{{ $moreTopic->title }}</p>
                        </a>
                </div>
                @endforeach
                </div>
            </div>
            @include('pages.side_advertising')
            @include('pages._side_conact')
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
                            <span><i class="kticon" title="该主题已被设置为精华" style="color:#00C853;">&#xe62d;</i></span>
                            @endif
                            @if($topic->topping)
                            <span> / </span>
                            <span><i class="kticon" title="该主题已被置顶" style="color:#FF9800;">&#xe636;</i></span>
                            @endif
                        </div>
                        <div class="mdui-divider"></div>
                        <div class="topic-body">
                            {!! $topic->body !!}
                        </div>
                        @can("web_manage")
                        <div>原文地址: {{ $topic->source }}</div>
                        @endcan
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
            <hr>
            <div class="layui-row business">
                <div class="title">金蝶软件让工作更高效，免费试用！</div>
                <div class="layui-col-xs12 layui-col-md6">
                    <form class="layui-form" id="buy-form" lay-filter="buy-form" method="POST" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="type" value="终端客户">
                        <div class="layui-form-item">
                          <div class="layui-input-block">
                            <input type="text" name="name" lay-verify="required|title" autocomplete="off" placeholder="请输入姓名" class="layui-input">
                          </div>
                        </div>
                        <div class="layui-form-item">
                          <div class="layui-input-block">
                            <input type="tel" name="phone" lay-verify="required|phone" autocomplete="off" placeholder="请输入手机号" class="layui-input">
                          </div>
                        </div>
                        <div class="layui-form-item">
                          <div class="layui-input-block">
                                <button class="layui-btn buy-btn" lay-submit="" lay-filter="buy-btn">立即提交</button>
                          </div>
                        </div>
                    </form>
                </div>
                <div class="layui-col-md6">
                    <div class="jdy">
                        <div><a href="{{ route('products.show',6) }}"> 精斗云</a></div>
                        <div>精斗云为您提供完整的在线服务包，功能覆盖财务、新零售、电商、订货等领域帮助您更好地找生意、更便利地做生意、更高效地管生意， 让您的生意遍布全国</div>
                        <div><a href="{{ route('products.show',6) }}">进一步了解>></a></div>
                    </div>
                </div>
            </div>
                @include('topics._reply_list', ['replies' => $topic->replies()->with('user')->get()])
                @includeWhen(Auth::check(), 'topics._reply_box', ['topic' => $topic])
            </div>
        </div>
    </div>
</div>
<!-- 需要登录操作 -->
@include('common.require_login')
@stop