<div class="notifications-box  xhs_sp_media">
        <div class="avatar pull-left">
            <img class="media-object img-thumbnail" alt="重要商机" src="\images\tips.png"  style="width:48px;height:48px;"/>
        </div>
    
        <div class="infos  xhs_sp_infos">
            <div class="media-heading">
                收到了新的商机，请在30分钟内联系客户！
                <a href="{{ $notification->data['business_link'] }}" target="_blank">查看</a>
    
                {{-- 回复删除按钮 --}}
                <span class="meta pull-right" title="{{ $notification->created_at }}">
                    <span class="glyphicon glyphicon-clock" aria-hidden="true"></span>
                    {{ $notification->created_at->diffForHumans() }}
                </span>
            </div>
            <div class="notifucation-content">
                <span>{{ $notification->data['business_city'] }}</span> 
                <span>
                    {{ $notification->data['business_type'] }}
                </span>
                <span>
                        {{ $notification->data['business_name'] }}
                </span>

            </div>
        </div>
        <a href="javascript:;" data_id = "{{ $notification->id }}" class="notifications-del" title="删除通知"><i class="kticon">&#xe625;</i></a>
    </div>