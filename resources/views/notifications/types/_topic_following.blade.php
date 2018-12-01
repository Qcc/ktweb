<div class="media">
        <div class="avatar pull-left">
            <a href="{{ route('users.show', $notification->data['user_id']) }}">
            <img class="media-object img-thumbnail" alt="{{ $notification->data['user_username'] }}" src="{{ $notification->data['user_avatar'] }}"  style="width:48px;height:48px;"/>
            </a>
        </div>
    
        <div class="infos">
            <div class="media-heading">
                <a href="{{ route('users.show', $notification->data['user_id']) }}">{{ $notification->data['user_username'] }}</a>
                发表新的话题
                <a href="{{ $notification->data['topic_link'] }}">{{ $notification->data['topic_title'] }}</a>
    
                {{-- 回复删除按钮 --}}
                <span class="meta pull-right" title="{{ $notification->created_at }}">
                    <span class="glyphicon glyphicon-clock" aria-hidden="true"></span>
                    {{ $notification->created_at->diffForHumans() }}
                </span>
            </div>
            <div class="reply-content">
                {!! $notification->data['topic_excerpt'] !!}
            </div>
        </div>
    </div>
    <hr>