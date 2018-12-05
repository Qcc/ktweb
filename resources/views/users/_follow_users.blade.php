<div class="usercard-message">
    <input type="hidden" id="author_id" data_id='{{ $user->id }}'>
    @guest
      <button class="mdui-btn mdui-ripple" mdui-dialog="{target: '#require-login'}" title="给他发送私信"><i class="mdui-icon material-icons">&#xe0e1;</i>
        发私信</button>
      <button class="mdui-btn mdui-ripple" mdui-dialog="{target: '#require-login'}" title="关注后能收到他的最新动态"><i class="mdui-icon material-icons">&#xe145;</i>
        加关注</button>
      @include('common.require_login')
    @else
      @if ($user->id !== Auth::user()->id)
        <button class="mdui-btn mdui-ripple" title="给他发送私信"><i class="mdui-icon material-icons">&#xe0e1;</i> 发私信</button>
        @if (Auth::user()->isFollowing($user->id))
          <button class="mdui-btn mdui-ripple user-follower" title="取消关注将不会再收到他的动态" style="color:#00C853"><i class="mdui-icon material-icons">&#xe5ca;</i>
            已关注</button>
        @else
          <button class="mdui-btn mdui-ripple user-follower" title="关注后能收到他的最新动态"><i class="mdui-icon material-icons">&#xe8f4;</i>
            加关注</button>
        @endif
      @else
        <div class="user-edit">
          <a href="{{ route('users.edit', Auth::id()) }}" class="mdui-btn mdui-color-theme-accent mdui-ripple">
            <i class="mdui-icon material-icons">&#xe3c9;</i> 编辑资料
          </a>
        </div>
      @endif
    @endguest
</div>