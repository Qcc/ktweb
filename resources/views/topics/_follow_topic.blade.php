<div class="usercard-message">
  <div class="mdui-btn-group">
    <input type="hidden" id="topic_id" data_id='{{ $topic->id }}' >
    @guest
    <button class="mdui-btn mdui-ripple topic-follow" mdui-dialog="{target: '#require-login'}" title="关注文章后有最新的回复会收到通知"><i class="mdui-icon material-icons">&#xe417;</i>加关注</button>
    <button class="mdui-btn mdui-ripple"  mdui-dialog="{target: '#require-login'}"  title="举报违规类容，共建品质社区"><i class="mdui-icon material-icons">&#xe8b2;</i>举报</button>
    @include('common.require_login')  
    @else
    @can('update', $topic)
      <div class="operate">
          <a href="{{ route('topics.edit', $topic->id) }}" class="mdui-btn mdui-ripple" role="button">
                  <i class="mdui-icon material-icons">&#xe3c9;</i> 编辑
          </a>
          <form action="{{ route('topics.destroy', $topic->id) }}" method="post">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" class="mdui-btn mdui-ripple" style="margin-left: 6px">
                      <i class="mdui-icon material-icons">&#xe92b;</i>
                  删除
              </button>
          </form>
      </div>
    @endcan
    <button class="mdui-btn mdui-ripple" title="举报违规类容，共建品质社区"><i class="mdui-icon material-icons">&#xe8b2;</i>举报</button>
      @if ($topic->user->id !== Auth::user()->id)
        @if (Auth::user()->isTopicFollowing($topic->id))
        <button class="mdui-btn mdui-ripple topic-follower" title="取消关注后不会再收到话题回复会通知"><i class="mdui-icon material-icons">&#xe5ca;</i> 已关注</button>
        @else
        <button class="mdui-btn mdui-ripple topic-follower" title="关注文章后有最新的回复会收到通知"><i class="mdui-icon material-icons">&#xe145;</i> 加关注</button>
        @endif
      @endif
      <button class="mdui-btn mdui-ripple" title="将话题置顶"><i class="mdui-icon material-icons">&#xe25a;</i>置顶</button>
    <button class="mdui-btn mdui-ripple" title="将话题设置为精华"><i class="mdui-icon material-icons">&#xe83a;</i>精华</button>
      @endguest
</div>
