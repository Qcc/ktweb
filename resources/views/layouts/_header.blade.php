<header class="kt-nav-header">
    <div class="kt-nav-background"></div>
    <div class="kt-nav-warp">
      <div class="kt-nav-log mdui-typo-title mdui-inline mdui-m-l-5 mdui-hidden-sm-down">
        <a href="/" class="kt-navigetion-sections">沟通科技</a>
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
        <a class="kt-navigetion-sections" href="javascript:;" mdui-menu="{target: '#user-menu'}">
          <img  class="avatar" src="{{ Auth::user()->avatar }}" alt="">
                {{ Auth::user()->nickname }}
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

    </div>
    <div class="mdui-container-fluid kt-menu-warp">
      <!-- 产品菜单 -->
      <div class="kt-menu-panl animated fadeInDown">
        <div class="mdui-row">
          <div class="mdui-col-xs-8">
            <ul class="navigation-product">
              <li class="navigetion-sections-title"><a href="" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe1af;</i>
                  应用虚拟化</a></li>
              <li class="kt-navigetion-item"><a href=""></a> CTBS高级版</li>
              <li class="kt-navigetion-item"><a href=""></a> CTBS企业版</li>
              <li class="navigetion-sections-title"><a href="" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe918;</i>
                  应用接入</a></li>
              <li class="kt-navigetion-item"><a href=""></a>云桌面RAS</li>
            </ul>
            <ul class="navigation-product">
              <li class="navigetion-sections-title"><a href="" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe3dd;</i>
                  金蝶云</a></li>
              <li class="kt-navigetion-item"><a href=""></a> 金蝶云·星空</li>
              <li class="kt-navigetion-item"><a href=""></a> 金蝶云·苍穹</li>
              <li class="kt-navigetion-item"><a href=""></a> 精斗云</li>
              <li class="kt-navigetion-item"><a href=""></a> 云之家</li>
            </ul>
            <ul class="navigation-product">
              <li class="navigetion-sections-title"><a href="" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe62f;</i>
                  ERP</a></li>
              <li class="kt-navigetion-item"><a href=""></a> 金蝶EAS</li>
              <li class="kt-navigetion-item"><a href=""></a> 金蝶K3</li>
              <li class="kt-navigetion-item"><a href=""></a> 金蝶KIS系列</li>
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
              <li class="navigetion-sections-title"><a href="" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe7f1;</i>
                  制造业</a></li>
              <li class="kt-navigetion-item"><a href=""></a> 工业制造</li>
              <li class="kt-navigetion-item"><a href=""></a> 电子</li>
              <li class="kt-navigetion-item"><a href=""></a> 食品</li>
              <li class="kt-navigetion-item"><a href=""></a> 日化</li>
              <li class="kt-navigetion-item"><a href=""></a> 家具</li>
            </ul>
            <ul class="navigation-product">
              <li class="navigetion-sections-title"><a href="" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe7fb;</i>
                  服务行业</a></li>
              <li class="kt-navigetion-item"><a href=""></a> 汽车经销</li>
              <li class="kt-navigetion-item"><a href=""></a> 餐饮连锁</li>
              <li class="kt-navigetion-item"><a href=""></a> 教育机构</li>
              <li class="kt-navigetion-item"><a href=""></a> 财税服务</li>
              <li class="kt-navigetion-item"><a href=""></a> 金融服务</li>
            </ul>
            <ul class="navigation-product">
              <li class="navigetion-sections-title"><a href="" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe8d1;</i>
                  零售业</a></li>
              <li class="kt-navigetion-item"><a href=""></a> 电商企业</li>
              <li class="kt-navigetion-item"><a href=""></a> 全渠道零售</li>
            </ul>
            <ul class="navigation-product">
              <li class="navigetion-sections-title"><a href="" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe885;</i>
                  政府机构</a></li>
              <li class="kt-navigetion-item"><a href=""></a> 政府部门</li>
              <li class="kt-navigetion-item"><a href=""></a> 企事业单位</li>
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
        <a href="/" class=" ktm-logo kt-navigetion-sections">沟通科技</a>
      </div>
      <nav class="ktm-nav-menu mdui-hidden-md-up mdui-float-right">
        <i class="mdui-icon material-icons kt-navigetion-sections active">&#xe3c7;</i>
        <i class="mdui-icon material-icons kt-navigetion-sections">&#xe5cd;</i>
      </nav>
      <div class="mdui-hidden-md-up ktm-nav-content animated fadeInDown">
        <ul class="ktm-menu-products">
          <li class="kt-navigetion-item"><a href="" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe1af;</i>
              CTBS应用虚拟化</a></li>
          <li class="kt-navigetion-item"><a href="" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe918;</i>
              智慧桌面RAS</a></li>
          <li class="kt-navigetion-item"><a href="" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe2c2;</i>
              金蝶云·苍穹</a></li>
          <li class="kt-navigetion-item"><a href="" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe3dd;</i>
              金蝶云·星空</a></li>
          <li class="kt-navigetion-item"><a href="" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe922;</i>
              金蝶ERP</a></li>
          <li class="kt-navigetion-item"><a href="" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe8d1;</i>
              精斗云</a></li>
          <li class="kt-navigetion-item"><a href="" class="kt-navigetion-sections"><i class="mdui-icon material-icons">&#xe2be;</i>
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