var $$ = mdui.JQ;
// header部分
$$(document).ready(function () {
    // 点赞
    $$('#like').on("click", function () {
        var A = $$(this).attr("id");
        var B = A.split("like");
        var messageID = B[1];
        var C = parseInt($$("#likeCount" + messageID).html());
        $$(this).css("background-position", "")
        var D = $$(this).attr("rel");
        if (D === 'like') {
            $$("#likeCount" + messageID).html(C + 1);
            $$(this).addClass("heartAnimation").attr("rel", "unlike");
        } else {
            $$("#likeCount" + messageID).html(C - 1);
            $$(this).removeClass("heartAnimation").attr("rel", "like");
            $$(this).css("background-position", "left");
        }
    });
    //加关注 取消关注 粉丝
    $$(".user-follower").on("click", function () {
        var id = $$('#author_id').attr('data_id');
        $$.ajax({
            method: 'POST',
            url: '/users/followers/action',
            ContentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.result) {
                    $$('.user-follower').empty().append(
                        "<i class='mdui-icon material-icons'>&#xe5ca;</i> 已关注").attr(
                        'title', '取消关注将不会再收到他的动态').css('color', '#76FF03');
                } else {
                    $$('.user-follower').empty().append(
                        "<i class='mdui-icon material-icons'>&#xe145;</i> 加关注").attr(
                        'title', '关注后能收到他的最新动态').css('color', '#a2a2a2');
                }
            }
        })
    });
    //加关注 取消关注 文章
    $$(".topic-follower").on("click", function () {
        var id = $$('#topic_id').attr('data_id');
        $$.ajax({
            method: 'POST',
            url: '/topic/followers/action',
            ContentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.result) {
                    $$('.topic-follower').empty().append(
                        "<i class='mdui-icon material-icons'>&#xe5ca;</i> 已关注").attr(
                        'title', '取消关注将不会再收到新的回复通知').css('color', '#00C853');
                } else {
                    $$('.topic-follower').empty().append(
                        "<i class='mdui-icon material-icons'>&#xe8f4;</i> 加关注").attr(
                        'title', '关注后能收到文章的最新回复通知').css('color', '#a2a2a2');;
                }
            }
        })
    });
    //设置精华 取消精华帖
    $$('.topic-excellent').on('click', function () {
        $$(this).attr('disabled', true);
        var id = $$('#topic_id').attr('data_id');
        $$.ajax({
            method: 'POST',
            url: '/topic/excellent/action',
            ContentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.result) {
                    if (data.status) {
                        $$('.topic-excellent').empty().append(
                                "<i class='mdui-icon material-icons'>&#xe5ca;</i> 已加精")
                            .attr('title', '取消文章精华设置').css('color', '#00C853');
                    } else {
                        $$('.topic-excellent').empty().append(
                                "<i class='mdui-icon material-icons'>&#xe83a;</i> 加精华")
                            .attr('title', '将文章设置为精华').css('color', '#a2a2a2');
                    }
                }
                $$('.topic-excellent').removeAttr('disabled');
            }
        });
    });
    //置顶帖
    $$('.topping-submit').on('click', function () {
        var id = $$('#topic_id').attr('data_id');
        var expired = $$('#top_expired').val();
        $$(this).attr('disabled', true);
        $$.ajax({
            method: 'POST',
            url: '/topic/topping/action',
            ContentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                expired: expired
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.result) {
                    if (data.status) {
                        $$('.topic-topping').empty().append(
                                "<i class='mdui-icon material-icons'>&#xe5ca;</i> 已置顶")
                            .attr('title', '取消文章精置顶').css('color', '#00C853').attr('topping', '1');
                    } else {
                        $$('.topic-topping').empty().append(
                                "<i class='mdui-icon material-icons'>&#xe25a;</i> 置顶")
                            .attr('title', '将文章置顶').css('color', '#a2a2a2').attr('topping', '0');
                    }
                }
                $$('.topexpired-warp').css('display', 'none');
                $$('.topping-submit').removeAttr('disabled');
            }
        });
    });
    // 置顶或者 取消置顶
    $$('.topic-topping').on('click', function () {
        var topping =$$(this).attr('topping');
        //当前置顶状态标记1已经置顶，0未置顶
        if (topping === '1') {
            $$(this).attr('disabled', true);
            var id = $$('#topic_id').attr('data_id');
            $$.ajax({
                method: 'POST',
                url: '/topic/topping/action',
                ContentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function (data) {
                    var data = JSON.parse(data);
                    if (data.result) {
                        if (data.status) {
                            $$('.topic-topping').empty().append(
                                    "<i class='mdui-icon material-icons'>&#xe5ca;</i> 已置顶")
                                .attr('title', '取消文章精置顶').css('color', '#00C853').attr('topping', '1');
                        } else {
                            $$('.topic-topping').empty().append(
                                    "<i class='mdui-icon material-icons'>&#xe25a;</i> 置顶")
                                .attr('title', '将文章置顶').css('color', '#a2a2a2').attr('topping', '0');
                        }
                    }
                    $$('.topic-topping').removeAttr('disabled');
                }
            });
        } else {
            $$('.topexpired-warp').css('display', 'block');
        }
    });
    laydate.render({
        elem: '#top_expired'
    });
});