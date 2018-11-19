@extends('wwwlayouts.default')
@section('title','管理资讯')

@section('content')
<section>

    <div class="swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide blue-slide">
          <div class="banner-cell">
            <div class="banner-content">
              <div class="title  wow fadeInUp">
                <h3>每天超过 <span id="enterprises">1</span>+ 企业 <span id="users">1</span>+ 用户在使用沟通科技提供的应用虚拟化服务</h3>
              </div>

              <div class="banner-products mdui-hidden-sm-down">
                <a href="/sms" class=" wow fadeInUp mdui-text-color-white-secondary">
                  <i class="kticon kticon-kuapingtai"></i>
                  <span>跨平台</span>
                </a>
                <a href="/internationalsms" class=" wow fadeInUp mdui-text-color-white-secondary">
                  <i class="kticon kticon-vpn1"></i>
                  <span>跨网络</span>
                </a>
                <a href="/mail" class=" wow fadeInUp mdui-text-color-white-secondary">
                  <i class="kticon kticon-anquan1"></i>
                  <span>安全</span>
                </a>
                <a href="/mobiledata" class=" wow fadeInUp mdui-text-color-white-secondary">
                  <i class="kticon kticon-huojian"></i>
                  <span>速度快</span>
                </a>
                <a href="/voice" class=" wow fadeInUp mdui-text-color-white-secondary">
                  <i class="kticon kticon-yunwei"></i>
                  <span>轻运维</span>
                </a>
              </div>
              <div class="banner-signup">
                <a class="mdui-btn mdui-ripple mdui-color-theme-accent btn-lg wow slideInUp" style="width: 160px;">
                  免费试用<span class=""></span></a>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-slide red-slide">
          <div class="title">Slide 2</div>
        </div>
        <div class="swiper-slide green-slide">
          <div class="title">Slide 2</div>
        </div>
        <div class="swiper-slide pink-slide">
          <div class="title">Slide 2</div>
        </div>
      </div>
    </div>
  </section>
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
              <a class="mdui-text-color-blue mdui-float-right">查看详情<i class="mdui-icon material-icons mdui-icon-right">&#xe5cc;</i></a>
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
              <a class="mdui-text-color-blue mdui-float-right">查看详情<i class="mdui-icon material-icons mdui-icon-right">&#xe5cc;</i></a>
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
              <a class="mdui-text-color-blue mdui-float-right">查看详情<i class="mdui-icon material-icons mdui-icon-right">&#xe5cc;</i></a>
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
              <a class="mdui-text-color-blue mdui-float-right">查看详情<i class="mdui-icon material-icons mdui-icon-right">&#xe5cc;</i></a>
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
            <i class="kticon kticon-gongyinglian2 mdui-text-color-cyan"></i>
            <p class="mdui-typo-title">远程接入</p>
          </a>
        </div>
        <div class="mdui-col-md-2 mdui-col-sm-4 mdui-col-xs-6">
          <a href="" class="wow fadeInUp mdui-text-center solution-item  mdui-text-color-grey-600">
            <i class="kticon kticon-caiwu mdui-text-color-yellow"></i>
            <p class="mdui-typo-title">财务管理</p>
          </a>
        </div>
        <div class="mdui-col-md-2 mdui-col-sm-4 mdui-col-xs-6">
          <a href="" class="wow fadeInUp mdui-text-center solution-item mdui-text-color-grey-600">
            <i class="kticon kticon-shengchanhuanjie mdui-text-color-orange"></i>
            <p class="mdui-typo-title">生产制造</p>
          </a>
        </div>
        <div class="mdui-col-md-2 mdui-col-sm-4 mdui-col-xs-6">
          <a href="" class="wow fadeInUp mdui-text-center solution-item mdui-text-color-grey-600">
            <i class="kticon kticon-lingshoushangpin mdui-text-color-red"></i>
            <p class="mdui-typo-title">零售</p>
          </a>
        </div>
        <div class="mdui-col-md-2 mdui-col-sm-4 mdui-col-xs-6">
          <a href="" class="wow fadeInUp mdui-text-center solution-item mdui-text-color-grey-600">
            <i class="kticon kticon-xunihua mdui-text-color-light-green"></i>
            <p class="mdui-typo-title">快消品</p>
          </a>
        </div>
        <div class="mdui-col-md-2 mdui-col-sm-4 mdui-col-xs-6">
          <a href="" class="wow fadeInUp mdui-text-center solution-item mdui-text-color-grey-600">
            <i class="kticon kticon-gongyinglian1 mdui-text-color-indigo"></i>
            <p class="mdui-typo-title">供应链</p>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="mdui-container-fluid">
      <div class="mdui-row img-solution-warp">
        <div class="wow fadeInLeft img-solution-item mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-4">
          <div class="img-solution-background mdui-color-grey"></div>
          <img src="./images/solution1.jpg" alt="">
          <div class="img-solution-content  mdui-text-color-white">
            <i class="kticon kticon-gongyinglian2"></i>
            <h3 class="mdui-typo-display-1">智慧桌面RAS</h3>
            <p class="mdui-typo-subheading">集团化企业应用集中发布，统一交付解决方案。</p>
          </div>
          <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-white">了解详情</button>
        </div>
        <div class="wow fadeInUp img-solution-item mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-4">
          <div class="img-solution-background mdui-color-grey"></div>
          <img src="./images/solution2.jpg" alt="">
          <div class="img-solution-content  mdui-text-color-white">
            <i class="kticon kticon-kuaisuxiaofeipin"></i>
            <h3 class="mdui-typo-display-1">快速消费品解决方案</h3>
            <p class="mdui-typo-subheading">管人、管车、管生意，打通快速消费品各个环节。</p>
          </div>
          <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-white">了解详情</button>
        </div>
        <div class="wow fadeInRight img-solution-item mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-4">
          <div class="img-solution-background mdui-color-black"></div>
          <img src="./images/solution3.jpg" alt="">
          <div class="img-solution-content  mdui-text-color-white">
            <i class="kticon kticon-workshop"></i>
            <h3 class="mdui-typo-display-1">工业3.0，智慧工厂</h3>
            <p class="mdui-typo-subheading">大规模个性化制造、网络协同制造、智慧工厂</p>
          </div>
          <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-white">了解详情</button>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="mdui-container ktnews-warp">
      <div class="mdui-typo mdui-inline mdui-hidden-xs-down">
        <h2 class="mdui-inline">新闻中心 <small>最新资讯</small></h2>
      </div>
      <div class="ktnews-tab-warp">
        <div class="mdui-tab ktnews-tab" mdui-tab>
          <a href="#ktnews-tab1" class="mdui-ripple">沟通动态</a>
          <a href="#ktnews-tab2" class="mdui-ripple">行业资讯</a>
          <a href="#ktnews-tab3" class="mdui-ripple">企业管理</a>
        </div>
        <div id="ktnews-tab1" class="mdui-p-a-2">
          <div class="mdui-row">

            <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-lg-4 news-big-item">
              <div class="news-big-content-warp">
                <h3 class="mdui-typo-title-opacity">这是标题适当方式发送发送电风扇电风扇的标题结束111</h3>
                <p class="mdui-typo-body-1-opacity mdui-hidden-xs news-summary"><span>摘要:</span>
                  这是DSG FHfg fgjfgd GHJ GGF飞过海的防火防盗恢复搞活分割摘要这是文章摘要。</p>
                <p class="news-date mdui-typo-caption-opacity">2018年11月16日</p>
              </div>
              <div class="news-big-pictures-warp">
                <img class="news-big-pictures" src="./images/solution1.jpg" alt="">
              </div>
            </div>

            <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-lg-4 news-big-item">
              <div class="news-big-content-warp">
                <h3 class="mdui-typo-title-opacity">这是标题适当方式发送发送电风扇电风扇的标题结束111</h3>
                <p class="mdui-typo-body-1-opacity mdui-hidden-xs news-summary"><span>摘要:</span>
                  这是DSG FHfg fgjfgd GHJ GGF飞过海的防火防盗恢复搞活分割摘要这是文章摘要。</p>
                <p class="news-date mdui-typo-caption-opacity">2018年11月16日</p>
              </div>
              <div class="news-big-pictures-warp">
                <img class="news-big-pictures" src="./images/solution2.jpg" alt="">
              </div>
            </div>
            
          </div>
        </div>
        <div id="ktnews-tab2" class="mdui-p-a-2">
          <div class="mdui-row">
            <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-lg-4 news-big-item">
              <div class="news-big-content-warp">
                <h3 class="mdui-typo-title-opacity">这是标题适当方式发送发送电风扇电风扇的标题结束111</h3>
                <p class="mdui-typo-body-1-opacity mdui-hidden-xs news-summary"><span>摘要:</span>
                  这是DSG FHfg fgjfgd GHJ GGF飞过海的防火防盗恢复搞活分割摘要这是文章摘要。</p>
                <p class="news-date mdui-typo-caption-opacity">2018年11月16日</p>
              </div>
              <div class="news-big-pictures-warp">
                <img class="news-big-pictures" src="./images/solution2.jpg" alt="">
              </div>
            </div>

            <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-lg-4 news-big-item">
              <div class="news-big-content-warp">
                <h3 class="mdui-typo-title-opacity">这是标题适当方式发送发送电风扇电风扇的标题结束111</h3>
                <p class="mdui-typo-body-1-opacity mdui-hidden-xs news-summary"><span>摘要:</span>
                  这是DSG FHfg fgjfgd GHJ GGF飞过海的防火防盗恢复搞活分割摘要这是文章摘要。</p>
                <p class="news-date mdui-typo-caption-opacity">2018年11月16日</p>
              </div>
              <div class="news-big-pictures-warp">
                <img class="news-big-pictures" src="./images/solution1.jpg" alt="">
              </div>
            </div>
          </div>
        </div>
        <div id="ktnews-tab3" class="mdui-p-a-2">
          <div class="mdui-row">
              <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-lg-4 news-big-item">
                  <div class="news-big-content-warp">
                    <h3 class="mdui-typo-title-opacity">这是标题适当方式发送发送电风扇电风扇的标题结束111</h3>
                    <p class="mdui-typo-body-1-opacity mdui-hidden-xs news-summary"><span>摘要:</span>
                      这是DSG FHfg fgjfgd GHJ GGF飞过海的防火防盗恢复搞活分割摘要这是文章摘要。</p>
                    <p class="news-date mdui-typo-caption-opacity">2018年11月16日</p>
                  </div>
                  <div class="news-big-pictures-warp">
                    <img class="news-big-pictures" src="./images/solution1.jpg" alt="">
                  </div>
                </div>
    
                <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-lg-4 news-big-item">
                  <div class="news-big-content-warp">
                    <h3 class="mdui-typo-title-opacity">这是标题适当方式发送发送电风扇电风扇的标题结束111</h3>
                    <p class="mdui-typo-body-1-opacity mdui-hidden-xs news-summary"><span>摘要:</span>
                      这是DSG FHfg fgjfgd GHJ GGF飞过海的防火防盗恢复搞活分割摘要这是文章摘要。</p>
                    <p class="news-date mdui-typo-caption-opacity">2018年11月16日</p>
                  </div>
                  <div class="news-big-pictures-warp">
                    <img class="news-big-pictures" src="./images/solution2.jpg" alt="">
                  </div>
                </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@stop