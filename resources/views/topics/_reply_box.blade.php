@include('common.error')
<div class="reply-box">
    <div class="reply-tips">
        <p><i class="kticon">&#xe68b;</i> 请勿发布不友善或与主题无关的内容,共建和谐社区需要你我一起努力!</p>
    </div>
    <div class="reply-form">
        <form action="{{ route('replies.store') }}" method="POST" accept-charset="UTF-8">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="topic_id" value="{{ $topic->id }}">
            <div class="form-group">
                <textarea class="form-control" id="reply-editor" placeholder="说点儿什么吧!" name="content">
                        {{ old('content') }}
                </textarea>
            </div>
            <button type="submit" class="mdui-btn mdui-color-theme-accent mdui-ripple"><i class="kticon">&#xe60c;</i> 回复</button>
        </form>
    </div>
</div>

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
@stop

@section('script')
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/module.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/hotkeys.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/uploader.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/simditor.min.js') }}"></script>

@stop