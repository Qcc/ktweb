@if (count($topics))

<ul class="topics-group">
    @foreach ($topics as $topic)
    <li class="topic-item">
        <span>
            <a class="category {{ $topic->excellent?'category-excellent':'' }}" href="{{ $topic->link() }}" title="文章板块">
                {{ $topic->category->name }}
            </a>
        </span>
        <a class="title" href="{{ $topic->link() }}">
            {{ $topic->title }}
        </a>
        @if($topic->excellent)
                <span><i class="mdui-icon material-icons" title="该主题已被设置为精华" style="color:#00C853;">&#xe83a;</i></span>
        @endif
        <div class="topic-info">
            <a class="" href="{{ $topic->link() }}" title="阅读数">
                {{ $topic->view_count }}
            </a>
            <span> / </span>
            <a class="" href="{{ $topic->link() }}" title="点赞数">
                <span> {{ $topic->great_count }}
            </a>
            <span> / </span>
            <a class="" href="{{ $topic->link() }}" title="回复数">
                {{ $topic->reply_count }}
            </a>
            <span> | </span>
            <span>
                创建于 {{ $topic->created_at->diffForHumans() }}
            </span>
        </div>
    </li>
    @endforeach
</ul>

@else
<div class="empty-block">暂无数据 ~_~ </div>
@endif

{{-- 分页 --}}
<div class="pagination-box">
    {!! $topics->render() !!}
</div>