<div class="notifications-box  xhs_sp_media">
    <div class="avatar pull-left">
        <a href="{{ route('users.show', $notification->data['user_id']) }}">
            <img class="media-object img-thumbnail" alt="{{ $notification->data['user_nickname'] }}" src="{{ $notification->data['user_avatar'] }}"
                style="width:48px;height:48px;" />
        </a>
    </div>

    <div class="infos  xhs_sp_infos">
        <div class="media-heading">
            <a href="{{ route('users.show', $notification->data['user_id']) }}" target="_blank">{{
                $notification->data['user_nickname'] }}</a>
            给你发送了站内消息
            <a href="{{ $notification->data['message_link'] }}" target="_blank">查看</a>

            {{-- 回复删除按钮 --}}
            <span class="meta pull-right" title="{{ $notification->created_at }}">
                <span class="glyphicon glyphicon-clock" aria-hidden="true"></span>
                {{ $notification->created_at->diffForHumans() }}
            </span>
        </div>
        <div class="notifucation-content">
            {!! $notification->data['message_content'] !!}
        </div>
    </div>
    <a href="javascript:;" data_id="{{ $notification->id }}" class="notifications-del" title="删除通知"><i class="kticon">&#xe625;</i></a>
</div>