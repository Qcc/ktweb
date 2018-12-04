<div class="execllent-warp">
    <div class="execllent-btn">
        @guest
        <button mdui-dialog="{target: '#require-login'}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">
            <i class="mdui-icon material-icons">&#xe8dc;</i> 点赞</button>
        @else
        <button class="mdui-btn mdui-btn-raised mdui-ripple {{ Auth::user()->isTopicGreat($topic->id)?'':'mdui-color-theme-accent' }} excellent excellent-footer">
            <i class="mdui-icon material-icons">&#xe8dc;</i> {{ Auth::user()->isTopicGreat($topic->id)?' 已赞':' 点赞' }}</button>
        @endguest
    </div>
    <div class="execllent-body">
        @foreach ($users as $index => $user)
        <div class="execllent-avatar">
            <a href="{{ route('users.show', $user->id) }}" title="{{ $user->username }}">
                <img src="{{ $user->avatar }}" alt="{{ $user->username }}">
            </a>
        </div>
        @endforeach
    </div>
</div>