@if (count($topics))

<ul class="media-list">
    @foreach ($tops as $topic)
    <li class="media mdui-valign xhs_sp_topiclist">
        <div class="media-left">
            <div class="media-avatar">
                <a href="{{ route('users.show', [$topic->user_id]) }}">
                    <img class="media-object img-thumbnail" src="{{ $topic->user->avatar }}" title="{{ $topic->user->nickname }}"
                        alt={{ $topic->user->nickname }}">
                </a>
            </div>
        </div>
        <div class="media-body">
            <div class="media-heading">
                <a class="category"  style="background:#FF9800;" href="{{ route('categories.show', $topic->category->id) }}" title="{{ $topic->category->name }}">
                    {{ $topic->category->name }}
                </a>
                <a class="topic_a_tit" href="{{ $topic->link() }}" title="{{ $topic->title }}">
                    {{ $topic->title }}
                </a>
                @if($topic->excellent)
                <span><i class="mdui-icon material-icons" title="该主题已被设置为精华" style="color:#00C853;">&#xe83a;</i></span>
                @endif
                <span><i class="mdui-icon material-icons" title="该主题已被置顶" style="color:#FF9800;">&#xeb45;</i></span>
            </div>
        </div>
        <div class="media-footer">
           
            <a class="" href="{{ $topic->link() }}" title="阅读数">
                <span> {{ $topic->view_count }} </span>
            </a>
            <span> / </span>
            <a class="" href="{{ $topic->link() }}" title="点赞数">
                <span> {{ $topic->great_count }} </span>
            </a>
            <span> / </span>
            <a class="" href="{{ $topic->link() }}" title="回复数">
                <span> {{ $topic->reply_count }} </span>
            </a>
            <span> | </span>
            <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
            <span class="timeago" title="最后活跃于">{{ $topic->updated_at->diffForHumans() }}</span>
        </div>
    </li>

    <div class="mdui-typo">
        <hr />
    </div>

    @endforeach
    @foreach ($topics as $topic)
    <li class="media mdui-valign xhs_sp_topiclist">
        <div class="media-left">
            <div class="media-avatar">
                <a href="{{ route('users.show', [$topic->user_id]) }}">
                    <img class="media-object img-thumbnail" src="{{ $topic->user->avatar }}" title="{{ $topic->user->nickname }}"
                        alt={{ $topic->user->nickname }}">
                </a>
            </div>
        </div>
        <div class=" media-body">
            <div class="media-heading">
                <a class="category {{ $topic->excellent ?'category-excellent':''}}" href="{{ route('categories.show', $topic->category->id) }}" title="{{ $topic->category->name }}">
                    {{ $topic->category->name }}
                </a>
                <a class="topic_a_tit" href="{{ $topic->link() }}" title="{{ $topic->title }}">
                    {{ $topic->title }}
                </a>
                @if($topic->excellent)
                <span><i class="mdui-icon material-icons" title="该主题已被设置为精华" style="color:#00C853;">&#xe83a;</i></span>
                @endif
            </div>
        </div>
        <div class="media-footer">           
            <a class="" href="{{ $topic->link() }}" title="阅读数">
                <span> {{ $topic->view_count }} </span>
            </a>
            <span> / </span>
            <a class="" href="{{ $topic->link() }}" title="点赞数">
                <span> {{ $topic->great_count }} </span>
            </a>
            <span> / </span>
            <a class="" href="{{ $topic->link() }}" title="回复数">
                <span> {{ $topic->reply_count }} </span>
            </a>
            <span> | </span>
            <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
            <span class="timeago" title="最后活跃于">{{ $topic->updated_at->diffForHumans() }}</span>
        </div>
    </li>

    @if ( ! $loop->last)
    <div class="mdui-typo">
        <hr />
    </div>
    @endif

    @endforeach
</ul>

@else
<div class="empty-block">暂无数据 ~_~ </div>
@endif