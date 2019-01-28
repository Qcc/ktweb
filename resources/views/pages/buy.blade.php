@extends('layouts.app')
@section('title','软件试用申请')

@section('content')
<div class="mdui-container-full">
  <div class="products-banner-warp">
    <div class="products-banner">
      <img src="/images/product-banner.jpg" alt="沟通科技产品试用">
      <div class="buy-title">
        <p>数字化您的企业</p>
        <p>让业务更高效 让生意更成功</p>
      </div>
    </div>
  </div>
</div>
<div class="mdui-container-full">
  <div class="mdui-row buy-section">
    <div class="mdui-hidden-xs mdui-col-sm-6">
      <div class="buy-adj">
        <h3>现已激活超过700万+企业，下一个被激活的就是你！</h3>
        <ol>
          <li>25年来不断探索更科学的管理模式</li>
          <li>帮助超过 700万+企业实现管理进步</li>
          <li>金蝶系互联网服务用户超2.5亿人</li>
          <li>IDC数据显示：金蝶连续 14 年蝉联中国中小企业ERP市场占有率第一</li>
        </ol>
      </div>
    </div>
    <div class="mdui-col-xs-12 mdui-col-sm-6">
      <form class="layui-form" id="buy-form" lay-filter="buy-form" method="POST" >
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="type" value="终端客户">
        <div class="layui-form-item">
          <label class="layui-form-label">姓名</label>
          <div class="layui-input-block">
            <input type="text" name="name" lay-verify="required|title" autocomplete="off" placeholder="请输入姓名" class="layui-input">
          </div>
        </div>

        <div class="layui-form-item">
          <label class="layui-form-label">手机</label>
          <div class="layui-input-block">
            <input type="text" name="phone" lay-verify="required|phone" autocomplete="off" placeholder="请输入手机号" class="layui-input">
          </div>
        </div>

        <div class="layui-form-item">
          <label class="layui-form-label">邮箱</label>
          <div class="layui-input-block">
            <input type="text" name="email" autocomplete="off" placeholder="请输入邮箱" class="layui-input">
          </div>
        </div>

        <div class="layui-form-item">
          <label class="layui-form-label">公司名称</label>
          <div class="layui-input-block">
            <input type="text" name="company" autocomplete="off" placeholder="请输入公司名称" class="layui-input">
          </div>
        </div>

        <div class="layui-form-item">
          <label class="layui-form-label">具体需求</label>
          <div class="layui-input-block">
            <textarea name="demand" placeholder="说点儿什么吧！" class="layui-textarea"></textarea>
          </div>
        </div>

        <div class="layui-form-item">
          <div class="layui-input-block">
            <button class="layui-btn buy-btn" lay-submit="" lay-filter="buy-btn">提交需求</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>
@stop