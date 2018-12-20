@if (count($replies))

<ul class="replies-group">
    @foreach ($replies as $reply)
    <li class="replies-item">
        <a class="title" href="{{ $reply->topic->link() }}">
            {{ $reply->topic->title }} <span>
                 at {{ $reply->topic->created_at->diffForHumans() }}
                </span>
        </a>

        <div class="reply-content">
            <span class="icon">
                <i class="mdui-icon material-icons">&#xe15e;</i>
            </span>
            <a href="{{ $reply->topic->link(['#reply' . $reply->id]) }}">
                    {!! $reply->content !!}
                </a>
        </div>

        <div class="reply-time">
            <i class="mdui-icon material-icons">&#xe192;</i>
            <span>
                {{ $reply->created_at->diffForHumans() }}
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
    {!! $replies->appends(Request::except('page'))->render() !!}
</div> -->
 <div class="pagination-box mdui-hidden-xs-down">
    {!! $replies->appends(Request::except('page'))->render() !!}
</div>
<div class="pagination-simple mdui-hidden-sm-up">
    {!! $replies->appends(Request::except('page'))->render('vendor.pagination.simple-default') !!}
</div>