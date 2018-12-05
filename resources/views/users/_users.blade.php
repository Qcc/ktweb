@if (count($users))

<ul class="users-group">
    @foreach ($users as $user)
        <li class="user-item">
            <div class="execllent-avatar avatar">
                <a href="{{ route('users.show',$user->id) }}" title="{{ $user->username }}">
                    <img src="{{ $user->avatar }}" alt="用户头像">
                </a>
            </div>
            <span class="introduction">
                {{ $user->introduction }}
            </span>
        </li>
    @endforeach
</ul>

@else
   <div class="empty-block">暂无数据 ~_~ </div>
@endif

{{-- 分页 --}}
<div class="pagination-box">
    {!! $users->render() !!}
</div>