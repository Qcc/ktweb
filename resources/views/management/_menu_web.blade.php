<div class="edit-item">
    <ul class="edit-list">
        <li><a href="{{ route('admin.web.system') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.web.system'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="mdui-icon material-icons">&#xe7f5;</i> 运行状态</a></li>
        <li><a href="{{ route('admin.web.create') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.web.create'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="mdui-icon material-icons">&#xe3c9;</i> 新闻管理</a></li>
        <li><a href="{{ route('admin.web.categorys') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.web.categorys'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="mdui-icon material-icons">&#xe1db;</i> 栏目管理</a></li>
        <li><a href="{{ route('admin.web.recommend') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.web.recommend'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="mdui-icon material-icons">&#xe413;</i> 推荐管理</a></li>
        <li><a href="{{ route('admin.web.settings') }}" class="mdui-btn mdui-ripple {{ active_class(if_route('admin.web.settings'), $activeClass = 'mdui-color-theme-accent', $inactiveClass = '') }} ">
                <i class="mdui-icon material-icons">&#xe8b8;</i> 主站设置</a></li>
    </ul>
</div>