<div class="media xhs_sp_media">
    <div class="avatar pull-left xhs_noti_sp">
        <a href="{{ route('users.show', $notification->data['user_id']) }}">
        <img class="media-object img-thumbnail" alt="{{ $notification->data['user_nickname'] }}" src="{{ $notification->data['user_avatar'] }}"/>
        </a>
    </div>

    <div class="infos xhs_sp_infos">
        <div class="media-heading">
            <a href="{{ route('users.show', $notification->data['user_id']) }}">{{ $notification->data['user_nickname'] }}</a>
            评论了
            <a href="{{ $notification->data['topic_link'] }}">{{ $notification->data['topic_title'] }}</a>

            {{-- 回复删除按钮 --}}
            <span class="meta pull-right mdui-hidden-sm-down" title="{{ $notification->created_at }}">
                <span class="glyphicon glyphicon-clock" aria-hidden="true"></span>
                {{ $notification->created_at->diffForHumans() }}
            </span>
        </div>
        <div class="mdui-hidden-md-up" style="padding: 3px 0;">                
            <span class="meta" title="{{ $notification->created_at }}">
                <span class="glyphicon glyphicon-clock" aria-hidden="true"></span>
                {{ $notification->created_at->diffForHumans() }}
            </span>
        </div>
        <div class="reply-content">
            {!! $notification->data['reply_content'] !!}
        </div>
    </div>
    <div style="clear: both;"></div>
</div>
<hr>