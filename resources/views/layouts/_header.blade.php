<header class="kt-nav-header">
  <div class="kt-nav-background"></div>
  <div class="kt-nav-warp">
    <div class="kt-nav-log mdui-inline mdui-m-l-5 mdui-hidden-sm-down">
      <a href="{{ route('home') }}" class="kt-navigetion-sections ktm-logo"></a>
    </div>
    <nav class="kt-nav mdui-typo-title mdui-inline mdui-hidden-sm-down kt-menu-tab-head ">
      <a href="javascript:;" class="kt-products mdui-m-l-5 mdui-m-r-3 kt-navigetion-sections mdui-typo-title">
        <i class="kticon">&#xe6b9;</i>
        <i class="kticon">&#xe653;</i>
        产品
      </a>
      <a href="javascript:;" class="kt-solutions mdui-m-l-3 mdui-m-r-3 kt-navigetion-sections mdui-typo-title">
        <i class="kticon">&#xe6b9;</i>
        <i class="kticon">&#xe62b;</i>
        解决方案
      </a>
      <a href="{{ route('business.show') }}" class="mdui-m-l-3 mdui-m-r-3 kt-navigetion-sections mdui-typo-title">
        合作伙伴</a>
      <a href="{{ route('topics.index') }}" class="mdui-m-l-3 mdui-m-r-3 kt-navigetion-sections mdui-typo-title">
        产品社区</a>
    </nav>
    <nav class="kt-nav-login mdui-hidden-sm-down">
      @guest
      <a class="mdui-btn mdui-ripple mdui-color-white mdui-text-color-blue" href="{{ route('login') }}">登录</a>
      <a class="mdui-btn mdui-color-theme-accent mdui-ripple" href="{{ route('register') }}">注册有礼<i class="kticon">&#xe655;</i></a>
      @else
      @role('站长')
      <a href="javascript:;" style="margin: 0 10px;" mdui-menu="{target: '#user-article'}" class="kt-navigetion-sections "
        title="新建主站资讯">发布资讯<i class="kticon">&#xe658;</i></a>
      @endrole
      <a class="kt-navigetion-sections" href="javascript:;" mdui-menu="{target: '#user-menu'}">
        <img class="avatar" src="{{ Auth::user()->avatar }}" alt="">
        {{ Auth::user()->nickname }}
        <i class="kticon">&#xe615;</i>
      </a>
      <ul class="mdui-menu mdui-menu-cascade" id="user-menu">
        <li class="mdui-menu-item">
          <a href="{{ route('users.show', Auth::id()) }}" class="mdui-ripple">
            <i class="kticon">&#xe643;</i>
            个人中心</a>
        </li>
        <!-- 新建主站资讯 -->
        @can('manage_contents')
        <li class="mdui-menu-item">
          <a href="javascript:;" title="发布主站文章" class="mdui-ripple">
            <i class="kticon">&#xe658;</i>
            发布资讯 <i class="kticon">&#xe615;</i></a>
          <ul class="mdui-menu mdui-menu-cascade">
            <li class="mdui-menu-item">
              <a href="{{ route('news.create') }}" title="沟通动态|行业新闻|管理智库" class="mdui-ripple">
                <i class="kticon">&#xe658;</i>
                新闻动态</a>
            </li>
            <li class="mdui-menu-item">
              <a href="{{ route('product.create') }}" title="产品相关文章" class="mdui-ripple">
                <i class="kticon">&#xe653;</i>
                产品功能</a>
            </li>
            <li class="mdui-menu-item">
              <a href="{{ route('solution.create') }}" title="行业解决方案" class="mdui-ripple">
                <i class="kticon">&#xe62b;</i>
                解决方案</a>
            </li>
            <li class="mdui-menu-item">
              <a href="{{ route('customer.create') }}" title="产品客户案例文章" class="mdui-ripple">
                <i class="kticon">&#xe623;</i>
                客户案例</a>
            </li>
          </ul>
        </li>

        @endcan
        @can('web_manage')
        <li class="mdui-menu-item">
          <a href="{{ route('admin.club.system') }}" class="mdui-ripple">
            <i class="kticon">&#xe616;</i> 网站管理</a>
        </li>
        @endcan
        <li class="mdui-divider"></li>
        <li class="mdui-menu-item">
          <a href="{{ route('logout') }}" class="mdui-ripple" onclick="event.preventDefault();
              document.getElementById('logout-form-pc').submit();">
            <i class="kticon">&#xe899;</i>
            退出</a>
          <form id="logout-form-pc" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </li>
      </ul>
      @endguest
    </nav>
  </div>
  <div class="mdui-container-fluid kt-menu-warp">
    <!-- 产品菜单 -->
    <div class="kt-menu-panl animated fadeInDown">
      <div class="mdui-row">
        <div class="mdui-col-xs-8">
          <ul class="navigation-product">
            <li class="navigetion-sections-title"><a href="{{ route('products.show',1) }}" class="kt-navigetion-sections"><i
                  class="kticon">&#xe6a5;</i>
                应用虚拟化</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('products.show',1) }}"> CTBS高级版</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('products.show',2) }}"> CTBS企业版</a></li>
            <li class="navigetion-sections-title"><a href="" class="kt-navigetion-sections"><i class="kticon">&#xe61e;</i>
                应用接入</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('products.show',3) }}">云桌面RAS</a></li>
          </ul>
          <ul class="navigation-product">
            <li class="navigetion-sections-title"><a href="{{ route('products.show',4) }}" class="kt-navigetion-sections"><i
                  class="kticon">&#xe661;</i>
                金蝶云</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('products.show',4) }}"> 金蝶云·星空</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('products.show',5) }}"> 金蝶云·苍穹</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('products.show',6) }}"> 精斗云</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('products.show',7) }}"> 云之家</a></li>
          </ul>
          <ul class="navigation-product">
            <li class="navigetion-sections-title"><a href="{{ route('products.show',8) }}" class="kt-navigetion-sections"><i
                  class="kticon">&#xe6a5;</i>
                ERP</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('products.show',8) }}"> 金蝶EAS</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('products.show',9) }}"> 金蝶K3</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('products.show',10) }}"> 金蝶KIS系列</a></li>
          </ul>
        </div>
        <div class="mdui-col-xs-4">
          <div class="kt-navigetion-sections ">
            <h4>售前咨询</h4>
          </div>
          <div class="kt-navigetion-sections">
            <i class="kticon">&#xe60a;</i>
            <tel>400-0755-799</tel> , <tel>(0755) 2652-5890</tel>
          </div>
          <div class="kt-navigetion-sections">
            <a class="mdui-btn mdui-color-theme-accent mdui-ripple btn-lg" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ cache('online_service')??'100934166' }}&site=qq&menu=yes"><i class="kticon">&#xe63e;</i>
              联系销售顾问</a>
          </div>
          <div class="kt-navigetion-sections-tips ">
            * 在线交谈可咨询售前、售后等问题，在您开始使用沟通科技产品时，售前顾问和售后技术支持工程师可帮助您解决遇到的任何使用问题
          </div>
          <div class="kt-navigetion-sections">售前顾问咨询 09:00 - 18:00 (工作时间)</div>
        </div>
      </div>
    </div>
    <!-- 产品菜单结束 -->
    <!-- 解决方案菜单 -->
    <div class="kt-menu-panl animated fadeInDown">
      <div class="mdui-row">
        <div class="mdui-col-xs-8">
          <ul class="navigation-product">
            <li class="navigetion-sections-title"><a href="{{ route('solutions.show',1) }}" class="kt-navigetion-sections"><i
                  class="kticon">&#xe607;</i>
                制造业</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('solutions.show',1) }}"> 工业制造</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('solutions.show',2) }}"> 电子</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('solutions.show',3) }}"> 食品</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('solutions.show',4) }}"> 日化</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('solutions.show',5) }}"> 家具</a></li>
          </ul>
          <ul class="navigation-product">
            <li class="navigetion-sections-title"><a href="{{ route('solutions.show',6) }}" class="kt-navigetion-sections"><i
                  class="kticon">&#xe61b;</i>
                服务行业</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('solutions.show',6) }}"> 汽车经销</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('solutions.show',7) }}"> 餐饮连锁</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('solutions.show',8) }}"> 教育机构</a></li>
          </ul>
          <ul class="navigation-product">
            <li class="navigetion-sections-title"><a href="{{ route('solutions.show',9) }}" class="kt-navigetion-sections"><i
                  class="kticon">&#xe6e5;</i>
                零售业</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('solutions.show',9) }}"> 电商企业</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('solutions.show',10) }}"> 全渠道零售</a></li>
          </ul>
          <ul class="navigation-product">
            <li class="navigetion-sections-title"><a href="{{ route('solutions.show',11) }}" class="kt-navigetion-sections"><i
                  class="kticon">&#xe646;</i>
                更多方案</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('solutions.show',11) }}"> 产品方案</a></li>
            <li class="kt-navigetion-item"><a href="{{ route('solutions.show',12) }}"> 其他行业</a></li>
          </ul>
        </div>
        <div class="mdui-col-xs-4">
          <div class="kt-navigetion-sections ">
            <h4>售前咨询</h4>
          </div>
          <div class="kt-navigetion-sections">
            <i class="kticon">&#xe60a;</i>
            <tel>400-0755-799</tel> , <tel>(0755) 2652-5890</tel>
          </div>
          <div class="kt-navigetion-sections">
            <a class="mdui-btn mdui-color-theme-accent mdui-ripple btn-lg" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ cache('online_service')??'100934166' }}&site=qq&menu=yes"><i class="kticon">&#xe63e;</i>
              联系销售顾问</a>
          </div>
          <div class="kt-navigetion-sections-tips ">
            * 在线交谈可咨询售前、售后等问题，在您开始使用沟通科技产品时，售前顾问和售后技术支持工程师可帮助您解决遇到的任何使用问题
          </div>
          <div class="kt-navigetion-sections">售前顾问咨询 09:00 - 18:00 (工作时间)</div>
        </div>
      </div>
    </div>
    <!-- 解决方案菜单结束 -->
  </div>
  <div class="ktm-nav-warp">
    <div class="mdui-hidden-md-up mdui-float-left">
      <a href="{{ route('home') }} " class=" ktm-logo kt-navigetion-sections"></a>
    </div>
    <nav class="ktm-nav-menu mdui-hidden-md-up mdui-float-right">
      <i class="kticon kt-navigetion-sections active">&#xe60b;</i>
      <i class="kticon kt-navigetion-sections">&#xe6b9;</i>
    </nav>
    <div class="mdui-hidden-md-up ktm-nav-content animated fadeInDown">
      <ul class="ktm-menu-products">
        <li class="kt-navigetion-item"><a href="{{ route('products.show',1) }}" class="kt-navigetion-sections"><i class="kticon">&#xeab8;</i>
            CTBS应用虚拟化</a></li>
        <li class="kt-navigetion-item"><a href="{{ route('products.show',3) }}" class="kt-navigetion-sections"><i class="kticon">&#xe61e;</i>
            智慧桌面RAS</a></li>
        <li class="kt-navigetion-item"><a href="{{ route('products.show',4) }}" class="kt-navigetion-sections"><i class="kticon">&#xe619;</i>
            金蝶云·苍穹</a></li>
        <li class="kt-navigetion-item"><a href="{{ route('products.show',5) }}" class="kt-navigetion-sections"><i class="kticon">&#xe661;</i>
            金蝶云·星空</a></li>
        <li class="kt-navigetion-item"><a href="{{ route('products.show',10) }}" class="kt-navigetion-sections"><i
              class="kticon">&#xe6a5;</i>
            金蝶ERP</a></li>
        <li class="kt-navigetion-item"><a href="{{ route('products.show',6) }}" class="kt-navigetion-sections"><i class="kticon">&#xe605;</i>
            精斗云</a></li>
        <li class="kt-navigetion-item"><a href="{{ route('products.show',7) }}" class="kt-navigetion-sections"><i class="kticon">&#xe67b;</i>
            云之家</a></li>
        @guest
        <li class="kt-navigetion-btn"><a class="mdui-btn mdui-ripple mdui-color-white mdui-text-color-blue" href="{{ route('login') }}">登录</a></li>
        <li class="kt-navigetion-btn"><a class="mdui-btn mdui-color-theme-accent mdui-ripple" href="{{ route('register') }}">注册有礼<i
              class="kticon">&#xe655;</i></a></li>
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