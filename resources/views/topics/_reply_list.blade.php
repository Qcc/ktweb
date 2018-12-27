<div class="reply-list">
    <div class="mdui-divider">
        <div class="reply-count">
            <i class="kticon">&#xe620;</i> 讨论数量 {{ count($replies)}}
        </div>
    </div>
    <div class="reply-feed">
        @foreach ($replies as $index => $reply)
        <div class="reply-item" name="reply{{ $reply->id }}" id="reply{{ $reply->id }}">
            <div class="avatar-left">
                <a href="{{ route('users.show', [$reply->user_id]) }}">
                    <img alt="{{ $reply->user->name }}" src="{{ $reply->user->avatar }}" />
                </a>
            </div>

            <div class="reply-infos ">
                <div class="reply-heading">
                    <a href="{{ route('users.show', [$reply->user_id]) }}" title="{{ $reply->user->nickname }}">
                        <b>{{ $reply->user->nickname }}</b>
                    </a>
                    <span class="introduction"> {{ $reply->user->introduction }} </span>
                    <a class="reply-reply" replay-user="{{ $reply->user->nickname }}" replay-link="{{ route('users.show',$reply->user->id) }}" title="回复{{ $reply->user->nickname }}" href="javascript:;"><i class="kticon">&#xe60c;</i></a>
                </div>
                <div class="reply-content topic-body">
                    {!! $reply->content !!}
                    <div class="reply-time" title="回复时间"><i class="kticon">&#xe631;</i> {{
                        $reply->created_at->diffForHumans() }}</div>
                </div>
                <div class="reply-footer">
                    <div class="reply-excellent">
                        <button class="mdui-btn mdui-ripple"> <i class="kticon">&#xe606;</i> 点赞</button>
                    </div>
                    <div class="reply-report">
                        <button class="mdui-btn mdui-ripple club-reply-report" reply-item="reply{{ $reply->id }}"> <i class="kticon">&#xe651;</i> 举报</button>
                    </div>
                    @can('destroy', $reply)
                    <div class="reply-delete">
                        <form action="{{ route('replies.destroy', $reply->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="mdui-btn mdui-ripple">
                                <i class="kticon">&#xe625;</i> 删除
                            </button>
                        </form>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>