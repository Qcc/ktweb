@if (count($topics))

<ul class="topics-group">
    @foreach ($topics as $topic)
    <li class="topic-item">
        <span style="max-width: 120px;display: inline-block;">
            <a class="category xhs_article_list {{ $topic->excellent?'category-excellent':'' }}" href="{{ $topic->link() }}" title="文章板块">
                {{ $topic->category->name }}
            </a>
        </span>
        <a class="title xhs_article_tit"  href="{{ $topic->link() }}">
            {{ $topic->title }}
        </a>
        @if($topic->excellent)
                <span><i class="kticon" title="该主题已被设置为精华" style="color:#00C853;">&#xe62d;</i></span>
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
<!-- <div class="pagination-box">
    {!! $topics->render() !!}
</div> -->
 <div class="pagination-box mdui-hidden-xs-down">
    {!! $topics->appends(Request::except('page'))->render() !!}
</div>
<div class="pagination-simple mdui-hidden-sm-up">
    {!! $topics->appends(Request::except('page'))->render('vendor.pagination.simple-default') !!}
</div>