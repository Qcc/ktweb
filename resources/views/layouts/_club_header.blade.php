<header class="club-header">
  <div class="club-header-warp">
    <div class="mdui-container club-header-content mdui-valign">
      <div class="club-log">
        <a href="http://ktweb.test"><img src="{{ asset('images/logo-blue.png') }}" alt="沟通科技logo"></a>
      </div>
      <div class="club-nav">
        <ul class="club-nav-ul">
          <li class="{{ active_class(if_route('topics.index')) }}"><a href="{{ route('topics.index') }}">社区</a></li>
          <li class="{{ active_class((if_route('categories.show') && if_route_param('category', 1))) }} }}"><a href="{{ route('categories.show', 1) }}">虚拟化</a></li>
          <li class="{{ active_class((if_route('categories.show') && if_route_param('category', 2))) }} }}"><a href="{{ route('categories.show', 2) }}">金蝶云</a></li>
          <li class="{{ active_class((if_route('categories.show') && if_route_param('category', 3))) }} }}"><a href="{{ route('categories.show', 3) }}">精斗云</a></li>
          <li class="{{ active_class((if_route('categories.show') && if_route_param('category', 4))) }} }}"><a href="{{ route('categories.show', 4) }}">金蝶ERP</a></li>
          <li class="{{ active_class((if_route('categories.show') && if_route_param('category', 5))) }} }}"><a href="{{ route('categories.show', 5) }}">其他</a></li>
        </ul>
      </div>
      <div class="club-search">
        <div class="mdui-textfield mdui-textfield-expandable">
          <button class="mdui-textfield-icon mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">search</i></button>
          <input class="mdui-textfield-input" type="text" placeholder="请输入搜索内容" />
          <button class="mdui-textfield-close mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">close</i></button>
        </div>
      </div>
      <div class="mdui-hidden-sm-down club-longin">
        @guest
        <a class="mdui-btn mdui-ripple mdui-color-white mdui-text-color-blue" href="{{ route('login') }}">登录</a>
        <a class="mdui-btn mdui-color-theme-accent mdui-ripple" href="{{ route('register') }}">注册有礼<i class="mdui-icon material-icons mdui-icon-right">&#xe8f6;</i></a>
        @else
        <a href="{{ route('notifications.message') }}" class="notifications-badge">
          <span class="badge badge-{{ Auth::user()->notification_count > 0 ? 'hint' : 'fade' }} " title="您有{{ Auth::user()->notification_count }}条未读消息">
            {{ Auth::user()->notification_count }}
          </span>
        </a>
        <a class="club-avatar" href="javascript:;" mdui-menu="{target: '#user-menu'}">
          <img class="avatar" src="{{ Auth::user()->avatar }}" alt="">
          {{ Auth::user()->nickname }}
        </a>
        <ul class="mdui-menu mdui-menu-cascade" id="user-menu">
          <li class="mdui-menu-item">
            <a href="{{ route('users.show', Auth::id()) }}" class="mdui-ripple">
              <i class="mdui-icon material-icons">&#xe7ff;</i> 个人中心</a>
          </li>
          <li class="mdui-menu-item">
            <a href="{{ route('users.edit', Auth::id()) }}"   class="mdui-ripple">
              <i class="mdui-icon material-icons">&#xe14f;</i> 编辑资料</a>
          </li>
          <li class="mdui-divider"></li>
          <li class="mdui-menu-item">
            <a href="{{ route('logout') }}" class="mdui-ripple" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <i class="mdui-icon material-icons">&#xe0e4;</i>
              退出</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </li>
        </ul>
        @endguest
      </div>
    </div>
  </div>
</header>