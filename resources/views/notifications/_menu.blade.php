<div class="edit-item">
    <ul class="edit-list">
        <li><a href="{{ route('notifications.notice') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('notifications.notice'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="kticon">&#xe642;</i> 通知</a></li>
        <li><a href="{{ route('notifications.message') }}" class="mdui-btn mdui-ripple {{ active_class((if_route('notifications.message') || if_route('message.conversation') || if_route('message.to')), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="kticon">&#xe6b5;</i> 私信</a></li>
        <li><a href="{{ route('notifications.system') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('notifications.system'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
            <i class="kticon">&#xe61c;</i> 系统</a></li>
    </ul>
</div>