<div id="clubbox">
  <header class="club-header">
    <div class="kt-nav-background mdui-hidden-md-up" style="margin-top: 50px;"></div>
    <div class="club-header-warp">
      <div class="mdui-container club-header-content mdui-valign">
        <div class="club-log mdui-hidden-sm-down">
          <a href="http://ktweb.test"><img src="{{ asset('images/logo-blue.png') }}" alt="沟通科技logo"></a>
        </div>
        <div class="club-nav mdui-hidden-sm-down">
          <ul class="club-nav-ul">
            <li class="{{ active_class(if_route('topics.index')) }}"><a href="{{ route('topics.index') }}">社区</a></li>
            <li class="{{ active_class((if_route('categories.show') && if_route_param('category', 1))) }}"><a href="{{ route('categories.show', 1) }}">虚拟化</a></li>
            <li class="{{ active_class((if_route('categories.show') && if_route_param('category', 2))) }}"><a href="{{ route('categories.show', 2) }}">金蝶云</a></li>
            <li class="{{ active_class((if_route('categories.show') && if_route_param('category', 3))) }}"><a href="{{ route('categories.show', 3) }}">精斗云</a></li>
            <li class="{{ active_class((if_route('categories.show') && if_route_param('category', 4))) }}"><a href="{{ route('categories.show', 4) }}">金蝶ERP</a></li>
            <li class="{{ active_class((if_route('categories.show') && if_route_param('category', 5))) }}"><a href="{{ route('categories.show', 5) }}">其他</a></li>
          </ul>
        </div>
        <div class="club-search mdui-hidden-sm-down">
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
          <a href="{{ route('notifications.notice') }}" class="notifications-badge" title="您有{{ Auth::user()->notification_count }}条未读消息">
            <i class="mdui-icon material-icons">&#xe0e1;</i>
            <span class="badge badge-{{ Auth::user()->notification_count > 0 ? 'hint' : 'fade' }} ">
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
              <a href="{{ route('users.edit', Auth::id()) }}" class="mdui-ripple">
                <i class="mdui-icon material-icons">&#xe14f;</i> 编辑资料</a>
            </li>
            @can('web_manage')
            <li class="mdui-menu-item">
              <a href="{{ route('admin.club.system') }}" class="mdui-ripple">
                <i class="mdui-icon material-icons">&#xe894;</i> 网站管理</a>
            </li>
            @endcan
            <li class="mdui-divider"></li>
            <li class="mdui-menu-item">
              <a href="{{ route('logout') }}" class="mdui-ripple" onclick="event.preventDefault();
                    document.getElementById('logout-form-pc').submit();">
                <i class="mdui-icon material-icons">&#xe0e4;</i>
                退出</a>
              <form id="logout-form-pc" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </li>
          </ul>
          @endguest
        </div>

      </div>
    </div>
    <div class="ktm-nav-warp mdui-hidden-md-up xhs_cpsq_menu" style="height: 50px;z-index: 999;position: fixed;top: 0;left: 0;background: #444;">
      <div class="mdui-hidden-md-up mdui-float-left">
        <a href="http://ktweb.test"><img src="{{ asset('images/logo-blue.png') }}" alt="沟通科技logo"></a>
      </div>
      <nav class="ktm-nav-menu mdui-hidden-md-up mdui-float-right" style="height: 50px;line-height: 50px;">
        <i class="mdui-icon material-icons kt-navigetion-sections active">&#xe3c7;</i>
        <i class="mdui-icon material-icons kt-navigetion-sections">&#xe5cd;</i>
      </nav>
      <div class="mdui-hidden-md-up ktm-nav-content animated fadeInDown">
        <ul class="ktm-menu-products">
          <li class="kt-navigetion-item"><a href="{{ route('topics.index') }}" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe1af;</i>
              社区</a></li>
          <li class="kt-navigetion-item"><a href="{{ route('categories.show',1) }}" class="kt-navigetion-sections"><i
                class="mdui-icon material-icons">&#xe918;</i>
              虚拟化</a></li>
          <li class="kt-navigetion-item"><a href="{{  route('categories.show',2) }}" class="kt-navigetion-sections"><i
                class="mdui-icon material-icons">&#xe2c2;</i>
              金蝶云</a></li>
          <li class="kt-navigetion-item"><a href="{{  route('categories.show',3) }}" class="kt-navigetion-sections"><i
                class="mdui-icon material-icons">&#xe3dd;</i>
              精斗云</a></li>
          <li class="kt-navigetion-item"><a href="{{  route('categories.show',4) }}" class="kt-navigetion-sections"><i
                class="mdui-icon material-icons">&#xe922;</i>
              金蝶ERP</a></li>
          <li class="kt-navigetion-item"><a href="{{  route('categories.show',5) }}" class="kt-navigetion-sections"><i
                class="mdui-icon material-icons">&#xe8d1;</i>
              其他</a></li>
          @guest
          <li class="kt-navigetion-btn"><a class="mdui-btn mdui-ripple mdui-color-white mdui-text-color-blue" href="{{ route('login') }}">登录</a></li>
          <li class="kt-navigetion-btn"><a class="mdui-btn mdui-color-theme-accent mdui-ripple" href="{{ route('register') }}">注册有礼<i
                class="mdui-icon material-icons">&#xe8f6;</i></a></li>
          @else
          <li class="kt-navigetion-btn"><a class="mdui-btn mdui-ripple mdui-color-white mdui-text-color-blue">个人中心</a></li>
          <li class="kt-navigetion-btn"><a class="mdui-btn mdui-color-theme-accent mdui-ripple" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">退出</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </li>
          @endguest
        </ul>
      </div>
    </div>
  </header>
</div>