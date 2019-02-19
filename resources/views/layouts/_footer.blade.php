<footer class="mdui-container-fluid mdui-color-grey-800" style="padding:10px 0 20px">
    <div class="mdui-row-xs-5 mdui-text-color-grey footer-sections">

      <div class="mdui-col-xs-6 mdui-col-sm-3 mdui-col-md-2 mdui-typo">
        <h4 class="mdui-text-color-white">关于沟通</h4>
        <ul>
          <li><a href="{{ route('columns.show',1)}}">沟通动态</a></li>
          <li><a href="{{ route('columns.show',2)}}">行业资讯</a></li>
          <li><a href="{{ route('columns.show',3)}}">管理智库</a></li>
          <li><a href="{{ config('app.url').'/index.html' }}">旧版网站</a></li>
        </ul>
      </div>
      <div class="mdui-col-xs-6 mdui-col-sm-3 mdui-col-md-2 mdui-typo">
        <h4 class="mdui-text-color-white">客户案例</h4>
        <ul>
            <li><a href="{{ route('customer.index').'?order=product' }}">产品案例</a></li>
            <li><a href="{{ route('customer.index').'?order=industry' }}">行业案例</a></li>
            <li><a href="{{ route('customer.index').'?order=profession' }}">具体业务案例</a></li>
        </ul>
      </div>
      <div class="mdui-col-xs-6 mdui-col-sm-3 mdui-col-md-2 mdui-typo">
        <h4 class="mdui-text-color-white">解决方案</h4>
        <ul>
          <li><a href="{{ route('solutions.show',1) }}">制造业</a></li>
          <li><a href="{{ route('solutions.show',6) }}">服务行业</a></li>
          <li><a href="{{ route('solutions.show',11) }}">零售业</a></li>
        </ul>
      </div>
      <div class="mdui-col-xs-6 mdui-col-sm-3 mdui-col-md-2 mdui-typo xhs_a_hover_none">
        <h4 class="mdui-text-color-white">产品社区</h4>
        <ul>
          <li><a href="{{ route('categories.show',1) }}">虚拟化</a></li>
          <li><a href="{{ route('categories.show',2) }}"> 金蝶云</a></li>
          <li><a href="{{ route('categories.show',3) }}"> 精斗云</a></li>
          <li><a href="{{ route('categories.show',4) }}"> 金蝶ERP</a></li>
        </ul>
      </div>
      <div class="mdui-col-xs-6 mdui-col-sm-3 mdui-col-md-2 mdui-typo">
        <h4 class="mdui-text-color-white">商务洽谈</h4>
        <ul>
          <li>需求咨询</li>
          <li>售前(800 999 6619)</li>
          <li>售后(400 0755 799)</li>
        </ul>
      </div>

      <div class="mdui-col-xs-6 mdui-col-sm-3 mdui-col-md-2 mdui-typo">
        <h4 class="mdui-text-color-white">微信公众号</h4>
        <img src="/images/wx_kouton.jpg" alt="沟通科技微信公众号" style="width: 100px;">
      </div>
    </div>

    <div class="mdui-text-color-grey copyright">
      <p class="txt-center">深圳市沟通科技有限公司 · 版权所有 电话：0755-26525890 地址：深圳市南山区科技园南区W1-B栋5楼</p>
      <p class="txt-center"><small>KouTon © 2000-2018 粤ICP备09149236 号</small></p>
    </div>
  </footer>