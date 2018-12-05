@include('common.error')
<div class="reply-box">
    <div class="reply-tips">
        <p><i class="mdui-icon material-icons">&#xe645;</i> 请勿发布不友善或与主题无关的内容,共建和谐社区需要你我一起努力!</p>
    </div>
    <div class="reply-form">
        <form action="{{ route('replies.store') }}" method="POST" accept-charset="UTF-8">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="topic_id" value="{{ $topic->id }}">
            <div class="form-group">
                <textarea class="form-control" id="reply-editor" placeholder="说点儿什么吧!" name="content">
                        {{ old('body') }}
                </textarea>
            </div>
            <button type="submit" class="mdui-btn mdui-color-theme-accent mdui-ripple"><i class="mdui-icon material-icons">&#xe15e;</i> 回复</button>
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

    <script>
    $(document).ready(function(){
        var editor = new Simditor({
            textarea: $('#reply-editor'),
            toolbar:  ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr'],
            upload: {
                url: "{{ route('topics.upload_image') }}",
                //工具条都包含哪些内容
                params: { _token: '{{ csrf_token() }}' },
                fileKey: 'upload_file',
                connectionCount: 3,
                leaveConfirm: '文件上传中，关闭此页面将取消上传。'
            },
            height:150,
            pasteImage: true,
        });
    });
    // <!-- 
//     pasteImage —— 设定是否支持图片黏贴上传，这里我们使用 true 进行开启；
// url —— 处理上传图片的 URL；
// params —— 表单提交的参数，Laravel 的 POST 请求必须带防止 CSRF 跨站请求伪造的 _token 参数；
// fileKey —— 是服务器端获取图片的键值，我们设置为 upload_file;
// connectionCount —— 最多只能同时上传 3 张图片；
// leaveConfirm —— 上传过程中，用户关闭页面时的提醒。
    //  -->
    </script>

@stop