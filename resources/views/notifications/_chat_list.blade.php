<div class="message-warp">
    <ul>
        @foreach ($messages as $index => $message)
        <li>
            <div class="send-avatar message-left">
                <a href="{{ route('users.show',$message->sendUser->id) }}" title="{{ $message->sendUser->nickname }}">
                    <img src="{{ $message->sendUser->avatar }}" alt="用户头像">
                </a>
            </div>
            <div class="chat-info">
                <div class="head">

                    <a href="{{ route('users.show',$message->sendUser->id) }}">
                        <b>{{ $message->sendUser->id == Auth::User()->id?'我':$message->sendUser->nickname }}</b></a>
                        <p>
                            <i class="mdui-icon material-icons">&#xe192;</i>
                            {{ $message->created_at->diffForHumans() }}
                        </p>
                </div>
                <div class="topic-body content">
                    {{ $message->content }}
                </div>
                <div class="link">
                    <a href="{{ route('message.conversation',$message->id)}}">
                        <i class="mdui-icon material-icons">&#xe0bf;</i>
                        查看对话
                    </a>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>