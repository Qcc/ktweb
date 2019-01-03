<div class="panel panel-default">
    <div class="new-topic-btn">
        <a href="{{ route('topics.create') }}" class="mdui-btn mdui-ripple mdui-color-theme-accent">
            <i class="kticon">&#xe67f;</i> 新建话题
        </a>
    </div>
    <div class="hot-topic-box">
        <div class="head">
            <p>热门话题</p>
        </div>
        <div class="content">
            <ul class="list">
                @foreach($hottopics as $hottopic)
                <li><a href="{{ $hottopic->link() }}" title="{{ $hottopic->title }}">{{ $hottopic->title }}<i class="kticon">&#xe606;</i><span>{{ $hottopic->great_count }}</span></a> </li>
                @endforeach
            </ul>
        </div>
    </div>
    @include('pages.side_advertising')
    <div class="reply-more-box">
        <div class="head">
            <p>评论最多</p>
        </div>
        <div class="content">
            <ul class="list">
                @foreach($replysmores as $replymore)
                <li><a href="{{ $replymore->link() }}" title="{{ $replymore->title }}">{{ $replymore->title }}<i class="kticon">&#xe620;</i><span>{{ $replymore->reply_count }}</span></a> </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>