<div class="article-actionbar">
  <div class="article-action-bar">
    <input type="hidden" id="topic_id" data_id='{{ $topic->id }}'>
    @guest
    <button class="mdui-btn mdui-ripple topic-follow" mdui-dialog="{target: '#require-login'}" title="关注文章后有最新的回复会收到通知"><i
        class="kticon">&#xe736;</i>加关注</button>
    <button class="mdui-btn mdui-ripple" mdui-dialog="{target: '#require-login'}" title="举报违规类容，共建品质社区"><i class="kticon">&#xe651;</i>举报</button>
    @else
    @can('update', $topic)
    <div class="article-edit">
      <a href="{{ route('topics.edit', $topic->id) }}" class="mdui-btn mdui-ripple" role="button">
        <i class="kticon">&#xe67f;</i> 编辑
      </a>
      <form action="{{ route('topics.destroy', $topic->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" class="mdui-btn mdui-ripple" style="margin-left: 6px">
          <i class="kticon">&#xe625;</i>
          删除
        </button>
      </form>
    </div>
    @endcan
    <button class="mdui-btn mdui-ripple club-report" title="举报违规类容，共建品质社区"><i class="kticon">&#xe651;</i> 举报</button>
    @if ($topic->user->id !== Auth::user()->id)
    @if (Auth::user()->isTopicFollowing($topic->id))
    <button class="mdui-btn mdui-ripple topic-follower" title="取消关注后不会再收到话题回复会通知" style="color:#00C853"><i class="kticon">&#xe626;</i>
      已关注</button>
    @else
    <button class="mdui-btn mdui-ripple topic-follower" title="关注文章后有最新的回复会收到通知"><i class="kticon">&#xe736;</i>
      加关注</button>
    @endif
    @endif
    @can('manage_contents')
    @if($topic->topping)
    <!-- 当前置顶状态标记1已经置顶，0未置顶 -->
    <button class="mdui-btn mdui-ripple topic-topping mdui-float-right" topping='1' title="取消话题置顶" style="color:#00C853"><i class="kticon">&#xe659;</i>
      已置顶</button>
    @else
    <button class="mdui-btn mdui-ripple topic-topping mdui-float-right" topping='0' title="将话题置顶"><i class="kticon">&#xe636;</i>
      置顶</button>
    @endif
    <div class="topexpired-warp">
      <input type="text" placeholder="到期时间" id="top_expired" />
      <button class="mdui-btn mdui-color-theme-accent mdui-ripple topping-submit">确定</button>
      <p>*不设置时间置顶将不会过期</p>
    </div>
    @if($topic->excellent)
    <button class="mdui-btn mdui-ripple topic-excellent mdui-float-right" title="取消将话题设置为精华" style="color:#00C853"><i class='kticon'>&#xe659;</i>
      已加精</button>
    @else
    <button class="mdui-btn mdui-ripple topic-excellent mdui-float-right" title="将话题设置为精华"><i class="kticon">&#xe62d;</i>
      加精华</button>
    @endif
    @endcan
    @endguest
  </div>
  <form class="layui-form" id="report-form" lay-filter="report-form" style="display:none;margin: 10px 40px 10px 20px;">
    <div class="layui-form-item">
      <label class="layui-form-label">举报理由是</label>
      <div class="layui-input-block">
        <input type="radio" name="reason" lay-filter="reason" value="垃圾广告信息" title="垃圾广告信息">
        <input type="radio" name="reason" lay-filter="reason" value="违规类容" title="违规类容">
        <input type="radio" name="reason" lay-filter="reason" value="不友善内容" title="不友善内容">
        <input type="radio" name="reason" lay-filter="reason" value="其他理由" checked="" title="其他理由">
      </div>
    </div>

    <div class="layui-form-item layui-form-text">
      <input type="hidden" name="type" lay-verify="required" class="layui-input report-type">
    </div>
    <div class="layui-form-item layui-form-text">
      <input type="hidden" name="link" lay-verify="required" class="layui-input report-link">
    </div> 

    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">其他请补充</label>
      <div class="layui-input-block">
        <textarea placeholder="请输入内容" lay-verify="required" name="other" class="layui-textarea report-form-other"></textarea>
      </div>
    </div>

    <div class="layui-form-item">
      <div class="layui-input-block">
        <button class="layui-btn layui-btn-danger report-btn" lay-submit="" lay-filter="report-btn">确认举报</button>
      </div>
    </div>
  </form>