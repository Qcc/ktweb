@if (count($topics))

<ul class="media-list">
    @foreach ($topics as $topic)
    <li class="media mdui-valign">
        <div class="media-left">
            <div class="media-avatar">
                <a href="{{ route('users.show', [$topic->user_id]) }}">
                    <img class="media-object img-thumbnail" src="{{ $topic->user->avatar }}" title="{{ $topic->user->username }}"
                        alt={{ $topic->user->username }}">
                </a>
            </div>
        </div>
        <div class="media-body">
            <div class="media-heading">
                <a class="category" href="{{ route('categories.show', $topic->category->id) }}" title="{{ $topic->category->name }}">
                    <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                    {{ $topic->category->name }}
                </a>
                <a href="{{ $topic->link() }}" title="{{ $topic->title }}">
                    {{ $topic->title }}
                </a>
            </div>
        </div>
        <div class="media-footer">
            <a class="pull-right" href="{{ $topic->link() }}" title="阅读数">
                <span> {{ $topic->view_count }} </span>
            </a>
            <span> / </span>
            <a class="pull-right" href="{{ $topic->link() }}" title="点赞数">
                <span> {{ $topic->great_count }} </span>
            </a>
            <span> / </span>
            <a class="pull-right" href="{{ $topic->link() }}" title="回复数">
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