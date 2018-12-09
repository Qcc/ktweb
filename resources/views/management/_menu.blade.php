<div class="edit-item">
    <ul class="edit-list">
        <li><a href="{{ route('admin.index') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.index'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="mdui-icon material-icons">&#xe7f5;</i> 运行状态</a></li>
        <li><a href="{{ route('notifications.message') }}" class="mdui-btn mdui-ripple {{ active_class((if_route('notifications.message') || if_route('message.conversation') || if_route('message.to')), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="mdui-icon material-icons">&#xe7fc;</i> 用户管理</a></li>
        <li><a href="{{ route('notifications.system') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('notifications.system'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="mdui-icon material-icons">&#xe7ef;</i> 角色管理</a></li>
        <li><a href="{{ route('notifications.system') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('notifications.system'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="mdui-icon material-icons">&#xe1db;</i> 文章管理</a></li>
        <li><a href="{{ route('notifications.system') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('notifications.system'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="mdui-icon material-icons">&#xe8af;</i> 回复管理</a></li>
        <li><a href="{{ route('notifications.system') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('notifications.system'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="mdui-icon material-icons">&#xe413;</i> 推荐管理</a></li>
        <li><a href="{{ route('notifications.system') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('notifications.system'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="mdui-icon material-icons">&#xe8b8;</i> 站点设置</a></li>
    </ul>
</div>