@extends('layouts.app')
@section('title','深圳市沟通科技有限公司')

@section('content')
<div class="swiper-container">
  <div class="swiper-wrapper">
    @foreach($homebanners as $banner)
    <div class="swiper-slide blue-slide">
      <div class="banner-content" style="background-image:url('{{ $banner->banner }}')">
        <div class="title  wow fadeInUp">
          <h3>{{ $banner->title }}</h3>
        </div>
        <div class="banner-products mdui-hidden-sm-down">
          <a href="{{ $banner->icon_link1}}" class=" wow fadeInUp mdui-text-color-white-secondary">
            <i class="kticon" style="background-image:url('{{ $banner->icon1 }}')"></i>
            <span>{{ $banner->icon_title1 }}</span>
          </a>
          <a href="{{ $banner->icon_link2}}" class=" wow fadeInUp mdui-text-color-white-secondary">
            <i class="kticon" style="background-image:url('{{ $banner->icon2 }}')"></i>
            <span>{{ $banner->icon_title2 }}</span>
          </a>
          <a href="{{ $banner->icon_link3}}" class=" wow fadeInUp mdui-text-color-white-secondary">
            <i class="kticon" style="background-image:url('{{ $banner->icon3 }}')"></i>
            <span>{{ $banner->icon_title3 }}</span>
          </a>
          <a href="{{ $banner->icon_link4}}" class=" wow fadeInUp mdui-text-color-white-secondary">
            <i class="kticon" style="background-image:url('{{ $banner->icon4 }}')"></i>
            <span>{{ $banner->icon_title4 }}</span>
          </a>
          <a href="{{ $banner->icon_link5}}" class=" wow fadeInUp mdui-text-color-white-secondary">
            <i class="kticon" style="background-image:url('{{ $banner->icon5 }}')"></i>
            <span>{{ $banner->icon_title5 }}</span>
          </a>
          
        </div>
        <div class="banner-signup">
          <a  href="{{ $banner->link }}" class="mdui-btn mdui-ripple mdui-color-theme-accent btn-lg wow slideInUp" style="width: 160px;">
            {{ $banner->subtitle }}</a>
          </a>
        </div>

      </div>
    </div>
    @endforeach
  </div>
</div>
<section>
  <div class="mdui-container">
    <div class="mdui-typo mdui-text-center">
      <h2>企业上云，就用金蝶云</h2>
      <h4>沟通科技，助力企业数字化创新</h4>
    </div>
    <div class="mdui-row-xs-5">
      <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-3 wow fadeInUp">
        <div class="mdui-card">
          <div class="mdui-card-header">
            <img class="mdui-card-header-logo" src="/images/logo-blue.png" />
          </div>
          <div class="mdui-card-primary">
            <div class="mdui-card-primary-title">智慧桌面RAS</div>
            <div class="mdui-card-primary-subtitle">新一代的应用虚拟化接入平台，安装软件即可打通内外网，实现安全、高效、敏捷的企业应用交付。</div>
          </div>
          <div class="mdui-card-content">累计交付客户</div>
          <div class="mdui-card-content-number mdui-text-color-blue"><span id="ctbs">1</span>+</div>
          <div class="mdui-card-actions">
            <button class="mdui-btn mdui-btn-dense mdui-color-theme-accent mdui-ripple">免费试用</button>
            <a class="mdui-text-color-blue mdui-float-right">查看详情<i class="kticon">&#xe638;</i></a>
          </div>
        </div>
      </div>
      <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-3 wow fadeInUp">
        <div class="mdui-card">
          <div class="mdui-card-header">
            <img class="mdui-card-header-logo" src="/images/qk.png" />
          </div>
          <div class="mdui-card-primary">
            <div class="mdui-card-primary-title">成长型企业云管理平台</div>
            <div class="mdui-card-primary-subtitle">企业级人工智能应用平台，实时的业务和实时数据洞察力，打破组织边界，满足企业个性化需求。</div>
          </div>
          <div class="mdui-card-content">企业IT成本费用</div>
          <div class="mdui-card-content-number mdui-text-color-blue">-<span id="kingdee">1</span>%</div>
          <div class="mdui-card-actions">
            <button class="mdui-btn mdui-btn-dense mdui-color-theme-accent mdui-ripple">免费试用</button>
            <a class="mdui-text-color-blue mdui-float-right">查看详情<i class="kticon">&#xe638;</i></a>
          </div>
        </div>
      </div>
      <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-3 wow fadeInUp">
        <div class="mdui-card">
          <div class="mdui-card-header">
            <img class="mdui-card-header-logo" src="/images/stwo-1.png" />
          </div>
          <div class="mdui-card-primary">
            <div class="mdui-card-primary-title">移动办公APP</div>
            <div class="mdui-card-primary-subtitle">连接员工，连接业务，连接客户，企业实现扁平化沟通。</div>
          </div>
          <div class="mdui-card-content">激活企业员工</div>
          <div class="mdui-card-content-number mdui-text-color-blue">+<span id="yzj"></span>%</div>
          <div class="mdui-card-actions">
            <button class="mdui-btn mdui-btn-dense mdui-color-theme-accent mdui-ripple">免费试用</button>
            <a class="mdui-text-color-blue mdui-float-right">查看详情<i class="kticon">&#xe638;</i></a>
          </div>
        </div>
      </div>
      <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-3 wow fadeInUp">
        <div class="mdui-card">
          <div class="mdui-card-header">
            <img class="mdui-card-header-logo" src="/images/jdy-1.png" />
          </div>
          <div class="mdui-card-primary">
            <div class="mdui-card-primary-title">小微企业云服务APP</div>
            <div class="mdui-card-primary-subtitle">财务业务高效集成，多部门数据共享，一站式云管理，随时随地打理生意。</div>
          </div>
          <div class="mdui-card-content">财务工作效率</div>
          <div class="mdui-card-content-number mdui-text-color-blue">+<span id="jdy">1</span>%</div>
          <div class="mdui-card-actions">
            <button class="mdui-btn mdui-btn-dense mdui-color-theme-accent mdui-ripple">免费试用</button>
            <a class="mdui-text-color-blue mdui-float-right">查看详情<i class="kticon">&#xe638;</i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="mdui-container">
    <div class="mdui-typo mdui-text-center">
      <h2>他们都在使用金蝶</h2>
      <h4>想要知道金蝶如何数字化您的企业，选择查看最新解决方案</h4>
    </div>
    <div class="mdui-row">
      <div class="mdui-col-md-2 mdui-col-sm-4 mdui-col-xs-6">
        <a href="" class="wow fadeInUp mdui-text-center solution-item  mdui-text-color-grey-600">
          <i class="kticon mdui-text-color-cyan">&#xe61e;</i>
          <p class="mdui-typo-title">远程接入</p>
        </a>
      </div>
      <div class="mdui-col-md-2 mdui-col-sm-4 mdui-col-xs-6">
        <a href="" class="wow fadeInUp mdui-text-center solution-item  mdui-text-color-grey-600">
          <i class="kticon mdui-text-color-yellow">&#xe62a;</i>
          <p class="mdui-typo-title">财务管理</p>
        </a>
      </div>
      <div class="mdui-col-md-2 mdui-col-sm-4 mdui-col-xs-6">
        <a href="" class="wow fadeInUp mdui-text-center solution-item mdui-text-color-grey-600">
          <i class="kticon mdui-text-color-orange">&#xe621;</i>
          <p class="mdui-typo-title">生产制造</p>
        </a>
      </div>
      <div class="mdui-col-md-2 mdui-col-sm-4 mdui-col-xs-6">
        <a href="" class="wow fadeInUp mdui-text-center solution-item mdui-text-color-grey-600">
          <i class="kticon mdui-text-color-red">&#xe65a;</i>
          <p class="mdui-typo-title">零售</p>
        </a>
      </div>
      <div class="mdui-col-md-2 mdui-col-sm-4 mdui-col-xs-6">
        <a href="" class="wow fadeInUp mdui-text-center solution-item mdui-text-color-grey-600">
          <i class="kticon mdui-text-color-light-green">&#xe63c;</i>
          <p class="mdui-typo-title">快消品</p>
        </a>
      </div>
      <div class="mdui-col-md-2 mdui-col-sm-4 mdui-col-xs-6">
        <a href="" class="wow fadeInUp mdui-text-center solution-item mdui-text-color-grey-600">
          <i class="kticon mdui-text-color-indigo">&#xe64a;</i>
          <p class="mdui-typo-title">供应链</p>
        </a>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="mdui-container-fluid">
    <div class="mdui-row img-solution-warp">
      @foreach($solutionbanners as $solution)
      <div class="wow fadeInLeft img-solution-item mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-4">
        <div class="img-solution-background mdui-color-grey"></div>
        <img src="{{ $solution->banner }}" alt="{{ $solution->title }}">
        <div class="img-solution-content  mdui-text-color-white">
          <i class="kticon" style="background-image:url('{{ $solution->icon1 }}')"></i>
          <h3 class="mdui-typo-headline">{{ $solution->title }}</h3>
          <p class="mdui-typo-subheading">{{ $solution->subtitle }}</p>
        </div>
        <a href="{{ $solution->link }}" class="link mdui-btn mdui-btn-raised mdui-ripple mdui-color-white">了解详情</a>
      </div>
      @endforeach
    </div>
  </div>
</section>
<section>
  <!-- 沟通动态 行业新闻 管理智库 -->
  @include('pages._news',['kouton'=>$kouton,'industry'=>$industry,'think'=>$think])
</section>
@include('pages._contact')
@stop