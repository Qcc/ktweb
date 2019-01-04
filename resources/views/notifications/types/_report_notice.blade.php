<div class="notifications-box  xhs_sp_media">
    <div class="avatar pull-left">
        <img class="media-object img-thumbnail" alt="重要商机" src="\images\report.png" style="width:48px;height:48px;" />
    </div>

    <div class="infos  xhs_sp_infos">
        <div class="media-heading">
            用户举报了{{ $notification->data['report_type'] }}，请尽快处理！
            <a href="{{ $notification->data['report_link'] }}" target="_blank">查看</a>

            {{-- 回复删除按钮 --}}
            <span class="meta pull-right" title="{{ $notification->created_at }}">
                <span class="glyphicon glyphicon-clock" aria-hidden="true"></span>
                {{ $notification->created_at->diffForHumans() }}
            </span>
        </div>
        <div class="notifucation-content">
            <span>{{ $notification->data['report_reason'] }}</span>
            <span>
                {{ $notification->data['report_other'] }}
            </span>


        </div>
    </div>
    <a href="javascript:;" data_id = "{{ $notification->id }}" class="notifications-del" title="删除通知"><i class="kticon">&#xe625;</i></a>
</div>