<header class="club-header">
      <div class="kt-nav-log mdui-typo-title mdui-inline mdui-m-l-5 mdui-hidden-sm-down">
        <a href="/" class="kt-navigetion-sections">沟通科技</a>
      </div>
      <nav>
        <ul class="nav navbar-nav">
          <li class="active"><a href="{{ route('topics.index') }}">话题</a></li>
          <li><a href="{{ route('categories.show', 1) }}">分享</a></li>
          <li><a href="{{ route('categories.show', 2) }}">教程</a></li>
          <li><a href="{{ route('categories.show', 3) }}">问答</a></li>
          <li><a href="{{ route('categories.show', 4) }}">公告</a></li>
      </ul>
      </nav>
      <nav class="kt-nav-login mdui-hidden-sm-down">
        @guest
        <a class="mdui-btn mdui-ripple mdui-color-white mdui-text-color-blue" href="{{ route('login') }}">登录</a>
        <a class="mdui-btn mdui-color-theme-accent mdui-ripple" href="{{ route('register') }}">注册有礼<i class="mdui-icon material-icons mdui-icon-right">&#xe8f6;</i></a>
        @else
        <a class="kt-navigetion-sections" href="javascript:;" mdui-menu="{target: '#user-menu'}">
          <img  class="avatar" src="{{ Auth::user()->avatar }}" alt="">
                {{ Auth::user()->username ?? hiddenPhone(Auth::user()->phone) }}
        </a>
        <ul class="mdui-menu mdui-menu-cascade" id="user-menu">
          <li class="mdui-menu-item">
            <a href="{{ route('users.show', Auth::id()) }}" class="mdui-ripple">
            <i class="mdui-icon material-icons">&#xe7ff;</i>
            个人中心</a>
          </li>
          <li class="mdui-divider"></li>
          <li class="mdui-menu-item">
          <a href="{{ route('logout') }}" class="mdui-ripple"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <i class="mdui-icon material-icons">&#xe0e4;</i>
              退出</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
          </li>
        </ul>
        @endguest
      </nav>
 
  </header>