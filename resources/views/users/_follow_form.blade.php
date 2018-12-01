@if ($user->id !== Auth::user()->id)
  <div id="club-follow">
  <button class="mdui-btn mdui-ripple"><i class="mdui-icon material-icons">&#xe0e1;</i> 发私信</button>
    @if (Auth::user()->isFollowing($user->id))
      <form action="{{ route('followers.destroy', $user->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button typr='submit' class="mdui-btn mdui-ripple" title="取消关注将不会再收到他的动态"><i class="mdui-icon material-icons">&#xe5ca;</i> 已关注</button>
      </form>
    @else
      <form action="{{ route('followers.store', $user->id) }}" method="post">
        {{ csrf_field() }}
        <button typr='submit' class="mdui-btn mdui-ripple" title="关注后能收到他的最新动态"><i class="mdui-icon material-icons">&#xe145;</i> 加关注</button>
      </form>
    @endif
  </div>
@endif