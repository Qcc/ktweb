<div class="edit-item">
    <ul class="edit-list">
        <li><a href="{{ route('admin.club.system') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.club.system'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="mdui-icon material-icons">&#xe7f5;</i> 运行状态</a></li>
        <li><a href="{{ route('admin.club.users') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.club.users'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="mdui-icon material-icons">&#xe7fc;</i> 用户管理</a></li>
        <li><a href="{{ route('admin.club.roles') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.club.roles'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="mdui-icon material-icons">&#xe7ef;</i> 角色管理</a></li>
        <li><a href="{{ route('admin.club.articles') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.club.articles'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="mdui-icon material-icons">&#xe1db;</i> 文章管理</a></li>
        <li><a href="{{ route('admin.club.replys') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.club.replys'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="mdui-icon material-icons">&#xe8af;</i> 回复管理</a></li>
        <li><a href="{{ route('admin.club.recommend') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.club.recommend'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="mdui-icon material-icons">&#xe413;</i> 推荐管理</a></li>
        <li><a href="{{ route('admin.club.settings') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.club.settings'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="mdui-icon material-icons">&#xe8b8;</i> 社区设置</a></li>
    </ul>
</div>

