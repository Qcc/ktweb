<div class="usercard-warp">
    <div class="usercard-body">
        <div class="usercard-header">
            <div class="usercard-avatar">
                <a href="{{ route('users.show', $user->id) }}">
                    <img class="thumbnail img-responsive" src="{{ $user->avatar }}" width="300px" height="300px">
                </a>
            </div>
            <div class="usercard-name">
                <div class="name mdui-typo-title-opacity">
                    {{ $user->nickname }}
                </div>
                <div class="mdui-typo-body-1-opacity">
                    {{ $user->introduction }}
                </div>
            </div>
        </div>
        <div class="usercard-favorites mdui-row">
            <div class="mdui-col-xs-3">
                <a href="" title="他发表的文章">
                    <p>文章</p>
                    <p>{{ $user->topics()->count() }}</p>
                </a>
            </div>
            <div class="mdui-col-xs-3">
                <a href="{{ route('users.followings',$user) }}" title="关注他的用户">
                    <p>粉丝</p>
                    <p>{{ count($user->followers) }}</p>
                </a>
            </div>
            <div class="mdui-col-xs-3">
                <a href="{{ route('users.followers',$user) }}" title="他关注的用户">
                    <p>关注</p>
                    <p>{{ count($user->followings) }}</p>
                </a>
            </div>
            <div class="mdui-col-xs-3">
                <a href="" title="他点赞的文章">
                    <p>喜欢</p>
                    <p>{{ $user->topicGreats()->count() }}</p>
                </a>
            </div>
        </div>
        @include('users._follow_users',$user)
    </div>
</div>