<header class="kt-nav-header">
    <div class="kt-nav-background"></div>
    <div class="kt-nav-warp">
      <div class="kt-nav-log mdui-typo-title mdui-inline mdui-m-l-5 mdui-hidden-sm-down">
        <a href="{{ route('home') }}" class="kt-navigetion-sections">沟通科技</a>
      </div>
      <nav class="kt-nav mdui-typo-title mdui-inline mdui-hidden-sm-down kt-menu-tab-head ">
        <a href="javascript:;" class="kt-products mdui-m-l-5 mdui-m-r-3 kt-navigetion-sections mdui-typo-title">
          <i class="mdui-icon material-icons ">&#xe14c;</i>
          <i class="mdui-icon material-icons ">&#xe3c7;</i>
          产品
        </a>
        <a href="javascript:;" class="kt-solutions mdui-m-l-3 mdui-m-r-3 kt-navigetion-sections mdui-typo-title">
          <i class="mdui-icon material-icons">&#xe14c;</i>
          <i class="mdui-icon material-icons">&#xe1bd;</i>
          解决方案
        </a>
        <a href="" class="mdui-m-l-3 mdui-m-r-3 kt-navigetion-sections mdui-typo-title">
          合作伙伴</a>
        <a href="{{ route('topics.index') }}" class="mdui-m-l-3 mdui-m-r-3 kt-navigetion-sections mdui-typo-title">
          产品社区</a>
      </nav>
      <nav class="kt-nav-login mdui-hidden-sm-down">
        @guest
        <a class="mdui-btn mdui-ripple mdui-color-white mdui-text-color-blue" href="{{ route('login') }}">登录</a>
        <a class="mdui-btn mdui-color-theme-accent mdui-ripple" href="{{ route('register') }}">注册有礼<i class="mdui-icon material-icons mdui-icon-right">&#xe8f6;</i></a>
        @else
        @role('Founder')
        <a href="javascript:;" style="margin: 0 10px;" mdui-menu="{target: '#user-article'}" class="kt-navigetion-sections " title="新建主站资讯">发布资讯<i class="mdui-icon material-icons">&#xe5c5;</i></a>
        @endrole
        <a class="kt-navigetion-sections" href="javascript:;" mdui-menu="{target: '#user-menu'}">
          <img  class="avatar" src="{{ Auth::user()->avatar }}" alt="">
          {{ Auth::user()->nickname }}
          <i class="mdui-icon material-icons">&#xe5c5;</i>      
        </a>
        <ul class="mdui-menu mdui-menu-cascade" id="user-menu">
          <li class="mdui-menu-item">
            <a href="{{ route('users.show', Auth::id()) }}" class="mdui-ripple">
            <i class="mdui-icon material-icons">&#xe7ff;</i>
            个人中心</a>
          </li>
          @role('Founder')
          <li class="mdui-menu-item">
            <a href="{{ route('admin.club.system') }}"   class="mdui-ripple">
            <i class="mdui-icon material-icons">&#xe8b8;</i> 社区管理</a>
          </li>
          <li class="mdui-menu-item">
            <a href="{{ route('admin.web.system') }}"   class="mdui-ripple">
              <i class="mdui-icon material-icons">&#xe894;</i> 网站管理</a>
          </li>
          @endrole
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
        <!-- 新建主站资讯 -->
        <ul class="mdui-menu mdui-menu-cascade" id="user-article">
          <li class="mdui-menu-item">
            <a href="{{ route('news.create') }}" title="沟通动态|行业新闻|管理智库" class="mdui-ripple">
              <i class="mdui-icon material-icons">&#xe80b;</i>
            主站资讯</a>
          </li>
          <li class="mdui-menu-item">
            <a href="{{ route('product.create') }}" title="产品相关文章"  class="mdui-ripple">
              <i class="mdui-icon material-icons">&#xe02f;</i>
            产品功能</a>
          </li>
          <li class="mdui-menu-item">
            <a href="{{ route('solution.create') }}" title="行业解决方案" class="mdui-ripple">
              <i class="mdui-icon material-icons">&#xe8fd;</i>
            解决方案</a>
          </li>
          <li class="mdui-menu-item">
            <a href="{{ route('customer.create') }}" title="产品客户案例文章" class="mdui-ripple">
              <i class="mdui-icon material-icons">&#xe153;</i>
            客户案例</a>
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
              <li class="navigetion-sections-title"><a href="{{ route('products.show',1) }}" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe1af;</i>
                  应用虚拟化</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('products.show',1) }}"> CTBS高级版</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('products.show',2) }}"> CTBS企业版</a></li>
              <li class="navigetion-sections-title"><a href="" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe918;</i>
                  应用接入</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('products.show',3) }}">云桌面RAS</a></li>
            </ul>
            <ul class="navigation-product">
              <li class="navigetion-sections-title"><a href="{{ route('products.show',4) }}" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe3dd;</i>
                  金蝶云</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('products.show',4) }}"> 金蝶云·星空</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('products.show',5) }}"> 金蝶云·苍穹</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('products.show',6) }}"> 精斗云</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('products.show',7) }}"> 云之家</a></li>
            </ul>
            <ul class="navigation-product">
              <li class="navigetion-sections-title"><a href="{{ route('products.show',8) }}" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe62f;</i>
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
              <i class="mdui-icon material-icons">&#xe61d;</i>
              <tel>400-0755-799</tel> , <tel>(0755) 2652-5890</tel>
            </div>
            <div class="kt-navigetion-sections">
              <a class="mdui-btn mdui-color-theme-accent mdui-ripple btn-lg" href=""><i class="kticon kticon-qq mdui-icon-left "></i>
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
              <li class="navigetion-sections-title"><a href="{{ route('solutions.show',1) }}" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe7f1;</i>
                  制造业</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('solutions.show',1) }}"> 工业制造</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('solutions.show',2) }}"> 电子</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('solutions.show',3) }}"> 食品</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('solutions.show',4) }}"> 日化</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('solutions.show',5) }}"> 家具</a></li>
            </ul>
            <ul class="navigation-product">
              <li class="navigetion-sections-title"><a href="{{ route('solutions.show',6) }}" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe7fb;</i>
                  服务行业</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('solutions.show',6) }}"> 汽车经销</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('solutions.show',7) }}"> 餐饮连锁</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('solutions.show',8) }}"> 教育机构</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('solutions.show',9) }}"> 财税服务</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('solutions.show',10) }}"> 金融服务</a></li>
            </ul>
            <ul class="navigation-product">
              <li class="navigetion-sections-title"><a href="{{ route('solutions.show',11) }}" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe8d1;</i>
                  零售业</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('solutions.show',11) }}"> 电商企业</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('solutions.show',12) }}"> 全渠道零售</a></li>
            </ul>
            <ul class="navigation-product">
              <li class="navigetion-sections-title"><a href="{{ route('solutions.show',13) }}" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe885;</i>
                  政府机构</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('solutions.show',13) }}"> 政府部门</a></li>
              <li class="kt-navigetion-item"><a href="{{ route('solutions.show',14) }}"> 企事业单位</a></li>
            </ul>
          </div>
          <div class="mdui-col-xs-4">
            <div class="kt-navigetion-sections ">
              <h4>售前咨询</h4>
            </div>
            <div class="kt-navigetion-sections">
              <i class="mdui-icon material-icons">&#xe61d;</i>
              <tel>400-0755-799</tel> , <tel>(0755) 2652-5890</tel>
            </div>
            <div class="kt-navigetion-sections">
              <a class="mdui-btn mdui-color-theme-accent mdui-ripple btn-lg" href=""><i class="kticon kticon-qq mdui-icon-left"></i>
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
        <a href="{{ route('home') }} " class=" ktm-logo kt-navigetion-sections">沟通科技</a>
      </div>
      <nav class="ktm-nav-menu mdui-hidden-md-up mdui-float-right">
        <i class="mdui-icon material-icons kt-navigetion-sections active">&#xe3c7;</i>
        <i class="mdui-icon material-icons kt-navigetion-sections">&#xe5cd;</i>
      </nav>
      <div class="mdui-hidden-md-up ktm-nav-content animated fadeInDown">
        <ul class="ktm-menu-products">
          <li class="kt-navigetion-item"><a href="{{ route('products.show',1) }}" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe1af;</i>
              CTBS应用虚拟化</a></li>
          <li class="kt-navigetion-item"><a href="{{ route('products.show',3) }}" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe918;</i>
              智慧桌面RAS</a></li>
          <li class="kt-navigetion-item"><a href="{{ route('products.show',4) }}" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe2c2;</i>
              金蝶云·苍穹</a></li>
          <li class="kt-navigetion-item"><a href="{{ route('products.show',5) }}" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe3dd;</i>
              金蝶云·星空</a></li>
          <li class="kt-navigetion-item"><a href="{{ route('products.show',10) }}" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe922;</i>
              金蝶ERP</a></li>
          <li class="kt-navigetion-item"><a href="{{ route('products.show',6) }}" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe8d1;</i>
              精斗云</a></li>
          <li class="kt-navigetion-item"><a href="{{ route('products.show',7) }}" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe2be;</i>
              云之家</a></li>
          @guest
          <li class="kt-navigetion-btn"><a class="mdui-btn mdui-ripple mdui-color-white mdui-text-color-blue" href="{{ route('login') }}">登录</a></li>
          <li class="kt-navigetion-btn"><a class="mdui-btn mdui-color-theme-accent mdui-ripple" href="{{ route('register') }}">注册有礼<i class="mdui-icon material-icons">&#xe8f6;</i></a></li>
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