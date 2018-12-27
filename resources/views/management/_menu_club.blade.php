<div class="edit-item">
        <ul class="edit-list">
                <li><a href="{{ route('admin.club.system') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.club.system'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                                <i class="kticon">&#xe60f;</i> 运行状态</a></li>
                @can('manage_users')
                <li><a href="{{ route('admin.club.users') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.club.users'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                                <i class="kticon">&#xe623;</i> 用户管理</a></li>
                @endcan
                @can('manage_roles')
                <li><a href="{{ route('admin.club.roles') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.club.roles'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                                <i class="kticon">&#xe624;</i> 角色管理</a></li>
                @endcan
                <li><a href="{{ route('admin.club.column') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.club.column'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                                <i class="kticon">&#xe6a5;</i> 类目管理</a></li>
                <li><a href="{{ route('admin.club.web_recommend') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.club.web_recommend'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                                <i class="kticon">&#xe616;</i> 主站推荐</a></li>
                <li><a href="{{ route('admin.club.recommend') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.club.recommend'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                                <i class="kticon">&#xe611;</i> 社区推荐</a></li>
                <li><a href="{{ route('admin.club.settings') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.club.settings'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                                <i class="kticon">&#xe607;</i> 网站设置</a></li>
        </ul>
</div>