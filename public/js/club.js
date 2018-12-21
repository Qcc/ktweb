var $$ = mdui.JQ;
// header部分
$$(document).ready(function () {

    // 信息提示框样式
    if ($$('.alert')) {
        setTimeout(function () {
            $$('.alert>.bg').css('width', '0');
            setTimeout(function () {
                $$('.alert').hide();
            }, 5000);
        }, 1000);
        $$('.alert>.content>a').on('click', function () {
            $$('.alert').hide();
        });
    }

    // 点赞
    $$('.excellent').on("click", function () {
        var id = $$('#topic_id').attr('data_id');
        $$(this).attr('disabled', true);
        if ($$('.heartAnimation').length === 0) {
            $$('.heart').addClass("heartAnimation");
            $$('#likeCount').text(parseInt($$('#likeCount').text()) + 1);
            $$('.excellent-footer').removeClass('mdui-color-theme-accent').empty().append('<i class="mdui-icon material-icons">&#xe8dc;</i> 已赞');
        } else {
            $$('.heart').removeClass("heartAnimation");
            $$('#likeCount').text(parseInt($$('#likeCount').text()) - 1);
            $$('.excellent-footer').addClass('mdui-color-theme-accent').empty().append('<i class="mdui-icon material-icons">&#xe8dc;</i> 点赞');
        }
        $$.ajax({
            method: 'POST',
            url: '/topic/greats/action',
            ContentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id
            },
            success: function (data) {
                $$('.excellent').removeAttr('disabled');
            }
        })
    });
    //加关注 取消关注 粉丝
    $$(".user-follower").on("click", function () {
        $$(this).attr('disabled', true);
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
                $$('.user-follower').removeAttr('disabled');
            }
        })
    });
    //加关注 取消关注 文章
    $$(".topic-follower").on("click", function () {
        $$(this).attr('disabled', true);
        var id = $$('#topic_id').attr('data_id');
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
                    $$('.topic-follower').empty().append(
                        "<i class='mdui-icon material-icons'>&#xe5ca;</i> 已关注").attr(
                        'title', '取消关注将不会再收到新的回复通知').css('color', '#00C853');
                } else {
                    $$('.topic-follower').empty().append(
                        "<i class='mdui-icon material-icons'>&#xe8f4;</i> 加关注").attr(
                        'title', '关注后能收到文章的最新回复通知').css('color', '#a2a2a2');;
                }
                $$('.topic-follower').removeAttr('disabled');
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
        var topping = $$(this).attr('topping');
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
    // laydate.render({
    //     elem: '#top_expired'
    // });
    // 展开移动端菜单导航
    $$('.ktm-nav-menu').on('click', function () {
        $$('.club-header').toggleClass('kt-nav-header-open')
        $$('#clubbox').toggleClass('xhs_club_box')
        $$('#clubbox').parent().toggleClass('xhs_club_padtop')
    });

    // 用户管理页面
    if ($$('.admin-club-users-page').length == 1) {
        layui.use(['table', 'layer', 'form'], function () {
            var $ = layui.jquery,
                table = layui.table;
            layer = layui.layer;
            form = layui.form;
            table.init('users-table', { //转化静态表格
                //height: 'full-500'
            });
            //监听行单击事件（单击事件为：rowDouble）
            table.on('row(users-table)', function (obj) {
                var data = obj.data;
                //表单初始赋值
                form.val('user-form', {
                    "id": data.id,
                    "name": data.name,
                    "nickname": data.nickname,
                    "email": data.email,
                    "phone": data.phone,
                    "company": data.company,
                    "password": '',
                    "activated": data.activated + '',
                })
                var userform = layer.open({
                    type: 1,
                    title: '修改用户信息 - ' + data.nickname,
                    content: $('#user-form') //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
                });
                //标注选中样式
                obj.tr.addClass('layui-table-click').siblings().removeClass('layui-table-click');
                //监听提交
                form.on('submit(form-btn)', function (data) {
                    $('.submit').addClass('layui-btn-disabled');
                    var field = data.field;
                    if (field.password == '') {
                        delete field.password;
                    }
                    $.ajax({
                        method: 'POST',
                        url: '/management/club/userstore',
                        ContentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: field,
                        success: function (data) {
                            $('.submit').removeClass('layui-btn-disabled');
                            layer.close(userform);
                            layer.msg(data.msg, {
                                icon: 1
                            });
                        }
                    });
                    return false;
                });

            });
        });
    }

    // 角色管理页面
    if ($$('.admin-club-roles-page').length == 1) {
        layui.use(['table', 'layer', 'form'], function () {
            var $ = layui.jquery,
                table = layui.table;
            layer = layui.layer;
            form = layui.form;
            table.init('roles-table', { //转化静态表格
                //height: 'full-500'
            });

            //监听工具条 查看角色用户 查看角色权限
            table.on('tool(roles-table)', function (obj) {
                var data = obj.data;
                if (obj.event === 'users') {
                    $('.user-cureent-role').attr('data-id', data.id).text(data.name);
                    $.ajax({
                        method: 'POST',
                        url: '/management/club/roleusers',
                        ContentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: {
                            id: data.id
                        },
                        success: function (data) {
                            table.render({
                                elem: '#usertable',
                                toolbar: '#toolbarAdd',
                                cols: [
                                    [{
                                        field: 'id',
                                        title: 'ID',
                                        width: 80,
                                        fixed: 'left'
                                    }, {
                                        field: 'name',
                                        title: '姓名'
                                    }, {
                                        field: 'nickname',
                                        title: '昵称'
                                    }, {
                                        field: 'email',
                                        title: '邮箱'
                                    }, {
                                        field: 'phone',
                                        title: '手机'
                                    }, {
                                        toolbar: '#barDel',
                                        title: '操作'
                                    }]
                                ],
                                data: data,
                            });
                        }
                    });
                } else if (obj.event === 'delete') {
                    layer.confirm('真的删除行么', function (index) {
                        obj.del();
                        layer.close(index);
                    });
                } else if (obj.event === 'permission') {
                    $('.permission-cureent-role').attr('data-id', data.id).text(data.name);
                    $.ajax({
                        method: 'POST',
                        url: '/management/club/rolepermission',
                        ContentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: {
                            id: data.id
                        },
                        success: function (data) {
                            table.render({
                                elem: '#permissiontable',
                                toolbar: '#toolbarAdd',
                                cols: [
                                    [{
                                        field: 'id',
                                        title: 'ID',
                                        width: 80,
                                        fixed: 'left'
                                    }, {
                                        field: 'name',
                                        title: '权限'
                                    }, {
                                        field: 'created_at',
                                        title: '创建时间'
                                    }, {
                                        toolbar: '#barDel',
                                        title: '操作'
                                    }]
                                ],
                                data: data,
                            });
                        }
                    });
                }
            });
            //监听工具条 删除角色下的用户
            table.on('tool(usertable)', function (obj) {
                var data = obj.data;
                if (obj.event === 'delete') {
                    layer.confirm('真的移除么', function (index) {
                        $.ajax({
                            method: 'POST',
                            url: '/management/club/userandpermission',
                            ContentType: 'application/json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            data: {
                                userid: data.id,
                                roleid: $('.user-cureent-role').attr('data-id'),
                                type: 'user',
                                action: 'delete',
                            },
                            success: function (data) {
                                if (data.code == 0) {
                                    obj.del();
                                } else {
                                    layer.msg(data.msg, {
                                        icon: 2
                                    });
                                }
                            },
                        });
                        layer.close(index);

                    });
                }
            });
            //头工具栏事件 给角色添加用户
            table.on('toolbar(usertable)', function (obj) {
                if (obj.event == 'add') {
                    layer.prompt({
                        title: '输入用户ID，并确认',
                        formType: 4
                    }, function (id, index) {
                        $.ajax({
                            method: 'POST',
                            url: '/management/club/userandpermission',
                            ContentType: 'application/json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            data: {
                                userid: id,
                                roleid: $('.user-cureent-role').attr('data-id'),
                                type: 'user',
                                action: 'add',
                            },
                            success: function (data) {
                                if (data.code == 0) {
                                    layer.msg(data.msg, {
                                        icon: 1
                                    });
                                } else {
                                    layer.msg(data.msg, {
                                        icon: 2
                                    });
                                }
                            },
                        });
                        layer.close(index);
                    });
                }
            });
            //头工具栏事件 给角色添加权限
            table.on('toolbar(permissiontable)', function (obj) {
                if (obj.event == 'add') {
                    var permissionform = layer.open({
                        type: 1,
                        anim: 2,
                        title: '请选择要添加的权限',
                        area: '500px',
                        shadeClose: true, //开启遮罩关闭
                        content: $("#permission-form")
                    });
                    $.ajax({
                        method: 'POST',
                        url: '/management/club/permissions',
                        ContentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: {},
                        success: function (data) {
                            var permission = $('.permission-form-input');
                            permission.empty();
                            for (let index = 0; index < data.length; index++) {
                                data[index];
                                permission.append("<input type='checkbox' name=" + data[index].id + " lay-skin='primary' title=" + data[index].name + "></input>")
                            }
                            form.render('checkbox');
                        },
                    });
                    //监听提交 确认添加权限
                    form.on('submit(permission-btn)', function (data) {
                        $('.submit').addClass('layui-btn-disabled');
                        var field = data.field;
                        $.ajax({
                            method: 'POST',
                            url: '/management/club/userandpermission',
                            ContentType: 'application/json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            data: {
                                permissionid: field,
                                roleid: $('.permission-cureent-role').attr('data-id'),
                                type: 'permission',
                                action: 'add',
                            },
                            success: function (data) {
                                $('.submit').removeClass('layui-btn-disabled');
                                if (data.code == 0) {
                                    layer.msg(data.msg, {
                                        icon: 1
                                    });
                                } else {
                                    layer.msg(data.msg, {
                                        icon: 2
                                    });
                                }
                                layer.close(permissionform);
                            }
                        });
                        return false;
                    });
                }
            });

            //监听工具条 删除角色下的权限
            table.on('tool(permissiontable)', function (obj) {
                var data = obj.data;
                if (obj.event === 'delete') {
                    layer.confirm('真的移除么', function (index) {
                        $.ajax({
                            method: 'POST',
                            url: '/management/club/userandpermission',
                            ContentType: 'application/json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            data: {
                                permissionid: data.id,
                                roleid: $('.permission-cureent-role').attr('data-id'),
                                type: 'permission',
                                action: 'delete',
                            },
                            success: function (data) {
                                if (data.code == 0) {
                                    obj.del();
                                } else {
                                    layer.msg(data.msg, {
                                        icon: 2
                                    });
                                }
                            },
                        });
                        layer.close(index);
                    });
                }
            });


        });
    }
    // 角色管理结束

});