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
    // 社区页面
    if ($$('.topics-show-page').length == 1) {
        layui.use(['element', 'layer', 'form','laydate'], function () {
            var $ = layui.jquery,
                element = layui.element,
                layer = layui.layer,
                laydate = layui.laydate,
                form = layui.form;
                laydate.render({
                    elem: '#top_expired'
                });
            $('.club-report').on('click', function () {
                var reportform = layer.open({
                    type: 1,
                    area: '600px',
                    title: '共建品质社区，欢迎举报不良信息',
                    content: $('#report-form'),
                });
                $('.report-type').val('话题');
                $('.report-link').val(window.location.href);
                reportForm(reportform);
            });
            $('.club-reply-report').on('click', function () {
                var reportform = layer.open({
                    type: 1,
                    area: '600px',
                    title: '共建品质社区，欢迎举报不良信息',
                    content: $('#report-form'),
                });
                $('.report-type').val('回复');
                $('.report-link').val(window.location.href + '?#' + $(this).attr('reply-item'));
                reportForm(reportform);
            });

            function reportForm(reportform) {
                // 监听单选框
                form.on('radio(reason)', function (data) {
                    if (data.value == '其他理由') {
                        $('.report-form-other').attr('lay-verify', 'required').focus();
                    } else {
                        $('.report-form-other').attr('lay-verify', '');
                    }
                });
                // 提交举报
                form.on('submit(report-btn)', function (data) {
                    $('.report-btn').addClass('layui-btn-disabled');
                    var field = data.field;
                    $.ajax({
                        method: 'POST',
                        url: '/topics/topic/report',
                        ContentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: field,
                        success: function (data) {
                            $('.report-btn').removeClass('layui-btn-disabled');
                            if (data.code == 0) {
                                layer.msg(data.msg, {
                                    icon: 1
                                });
                            } else {
                                layer.msg(data.msg, {
                                    icon: 2
                                });
                            }
                        }
                    });
                    layer.close(reportform);
                    return false;
                });
            };
        });
        var editor = new Simditor({
            textarea: $('#reply-editor'),
            toolbar: ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr'],
            upload: {
                url: "{{ route('topics.upload_image') }}",
                //工具条都包含哪些内容
                params: {
                    _token: '{{ csrf_token() }}'
                },
                fileKey: 'upload_file',
                connectionCount: 3,
                leaveConfirm: '文件上传中，关闭此页面将取消上传。'
            },
            pasteImage: true,
        });

        $('.reply-reply').on('click', function () {
            $(document).scrollTop($('.reply-box').offset().top);
            var user = $(this).attr('replay-user');
            var link = $(this).attr('replay-link');
            var value = editor.getValue();
            editor.setValue(value + "<a href=" + link + ">@" + user + "</a> &nbsp;");
            editor.focus();
        });
        // 点赞
        $$('.excellent').on("click", function () {
            var id = $$('#topic_id').attr('data_id');
            $$(this).attr('disabled', true);
            if ($$('.heartAnimation').length === 0) {
                $$('.heart').addClass("heartAnimation");
                $$('#likeCount').text(parseInt($$('#likeCount').text()) + 1);
                $$('.excellent-footer').removeClass('mdui-color-theme-accent').empty().append('<i class="kticon">&#xe606;</i> 已赞');
            } else {
                $$('.heart').removeClass("heartAnimation");
                $$('#likeCount').text(parseInt($$('#likeCount').text()) - 1);
                $$('.excellent-footer').addClass('mdui-color-theme-accent').empty().append('<i class="kticon">&#xe606;</i> 点赞');
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
                            "<i class='kticon'>&#xe659;</i> 已关注").attr(
                            'title', '取消关注将不会再收到他的动态').css('color', '#76FF03');
                    } else {
                        $$('.user-follower').empty().append(
                            "<i class='kticon'>&#xe7b9;</i> 加关注").attr(
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
                            "<i class='kticon'>&#xe659;</i> 已关注").attr(
                            'title', '取消关注将不会再收到新的回复通知').css('color', '#00C853');
                    } else {
                        $$('.topic-follower').empty().append(
                            "<i class='kticon'>&#xe736;</i> 加关注").attr(
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
                                    "<i class='kticon'>&#xe659;</i> 已加精")
                                .attr('title', '取消文章精华设置').css('color', '#00C853');
                        } else {
                            $$('.topic-excellent').empty().append(
                                    "<i class='kticon'>&#xe62d;</i> 加精华")
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
                                    "<i class='kticon'>&#xe659;</i> 已置顶")
                                .attr('title', '取消文章精置顶').css('color', '#00C853').attr('topping', '1');
                        } else {
                            $$('.topic-topping').empty().append(
                                    "<i class='kticon'>&#xe636;</i> 置顶")
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
                                        "<i class='kticon'>&#xe659;</i> 已置顶")
                                    .attr('title', '取消文章精置顶').css('color', '#00C853').attr('topping', '1');
                            } else {
                                $$('.topic-topping').empty().append(
                                        "<i class='kticon'>&#xe636;</i> 置顶")
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
    }

    
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
                toolbar: '#toolbarAdd',
            });

            //监听工具条 查看角色用户 查看角色权限
            table.on('toolbar(roles-table)', function (obj) {
                var data = obj.data;
                if (obj.event === 'add') {
                    document.getElementById('roles-form').reset();
                    var relo_form = layer.open({
                        type: 1,
                        anim: 2,
                        title: '请输入要添加的角色',
                        area: '500px',
                        shadeClose: true, //开启遮罩关闭
                        content: $("#roles-form")
                    });
                    rolesSubmit('/management/club/roleStore', relo_form);
                }
            });
            //监听工具条 查看角色用户 查看角色权限
            table.on('tool(roles-table)', function (obj) {
                var data = obj.data;
                if (obj.event === 'users') {
                    $('.user-cureent-role').attr('data-id', data.id).text(data.cn_name);
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
                                page: true
                            });
                        }
                    });
                } else if (obj.event === 'delete') {
                    layer.confirm('真的删除行么', function (index) {
                        obj.del();
                        layer.close(index);
                    });
                } else if (obj.event === 'permission') {
                    $('.permission-cureent-role').attr('data-id', data.id).text(data.cn_name);
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
                                        width: 60,
                                        fixed: 'left'
                                    }, {
                                        field: 'cn_name',
                                        title: '权限'
                                    }, {
                                        field: 'name',
                                        title: '标识'
                                    }, {
                                        field: 'created_at',
                                        title: '创建时间'
                                    }, {
                                        toolbar: '#barDel',
                                        title: '操作'
                                    }]
                                ],
                                data: data,
                                page: true
                            });
                        }
                    });
                } else if (obj.event === 'edit') {

                    var relo_form = layer.open({
                        type: 1,
                        anim: 2,
                        title: '请修改角色',
                        area: '500px',
                        shadeClose: true, //开启遮罩关闭
                        content: $("#roles-form")
                    });
                    //表单初始赋值
                    form.val('roles-form', {
                        "id": data.id,
                        "name": data.name,
                        "cn_name": data.cn_name,
                    })
                    rolesSubmit('/management/club/roleStore', relo_form);
                }
            });

            function rolesSubmit(api, layerOpen) {
                //监听提交 修改分类
                form.on("submit(roles-btn)", function (data) {
                    $(".roles-btn").addClass('layui-btn-disabled');
                    var field = data.field;
                    $.ajax({
                        method: 'POST',
                        url: api,
                        ContentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: field,
                        success: function (data) {
                            $(".roles-btn").removeClass('layui-btn-disabled');
                            if (data.code == 0) {
                                layer.msg(data.msg, {
                                    icon: 1
                                });
                            } else {
                                layer.msg(data.msg, {
                                    icon: 2
                                });
                            }
                            layer.close(layerOpen);
                        }
                    });
                    return false;
                });
            }
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
                                permission.append("<input type='checkbox' name=" + data[index].id + " lay-skin='primary' title=" + data[index].cn_name + "></input>")
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
    // 类目管理页面
    if ($$('.admin-club-column-page').length == 1) {
        layui.use(['element', 'table', 'layer', 'form', 'upload'], function () {
            var $ = layui.jquery,
                element = layui.element,
                table = layui.table,
                layer = layui.layer,
                upload = layui.upload,
                form = layui.form;
            table.init('categorys-table', { //转化静态表格
                toolbar: '#toolbarAdd',
                page: true,
            });

            //功能图标上传
            var uploadIcon = upload.render({
                elem: "#upload-icon",
                url: "/upload/uploadImage",
                field: 'upload_file',
                accept: 'images',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                done: function (res) {
                    //如果上传失败
                    if (res.code > 0) {
                        return layer.msg('上传失败');
                    }
                    $('#upload-icon').prev().val(res.data.src);
                },
                error: function () {
                    layer.msg('上传失败');
                }
            });
            //banner大图上传
            var uploadIcon = upload.render({
                elem: "#upload-banner",
                url: "/upload/uploadImage",
                field: 'upload_file',
                accept: 'images',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                done: function (res) {
                    //如果上传失败
                    if (res.code > 0) {
                        return layer.msg('上传失败');
                    }
                    $('#upload-banner').prev().val(res.data.src);
                },
                error: function () {
                    layer.msg('上传失败');
                }
            });
            //社区图上传上传
            var uploadIcon = upload.render({
                elem: "#upload-club-icon",
                url: "/upload/uploadImage",
                field: 'upload_file',
                accept: 'images',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                done: function (res) {
                    //如果上传失败
                    if (res.code > 0) {
                        return layer.msg('上传失败');
                    }
                    $('#upload-club-icon').prev().val(res.data.src);
                },
                error: function () {
                    layer.msg('上传失败');
                }
            });
            element.on('tab(column-tab)', function (data) {
                // 产品表
                if (data.index == 1) {
                    $.ajax({
                        method: 'POST',
                        url: '/management/club/columns',
                        ContentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: {
                            type: 'productcol',
                        },
                        success: function (data) {
                            if (data.code) {
                                layer.msg(data.msg, {
                                    icon: 2
                                });
                            }
                            table.render({
                                elem: '#producttable',
                                toolbar: '#toolbarAdd',
                                cols: [
                                    [{
                                        field: 'id',
                                        title: 'ID',
                                        width: 60,
                                        fixed: 'left'
                                    }, {
                                        field: 'name',
                                        title: '名称'
                                    }, {
                                        field: 'title',
                                        title: '标题'
                                    }, {
                                        field: 'icon',
                                        title: '图标'
                                    }, {
                                        field: 'banner',
                                        title: '大图'
                                    }, {
                                        field: 'description',
                                        title: '介绍'
                                    }, {
                                        toolbar: '#barAction',
                                        title: '操作'
                                    }]
                                ],
                                data: data,
                                page: true
                            });
                        }
                    });
                    // 解决方案表
                } else if (data.index == 2) {
                    $.ajax({
                        method: 'POST',
                        url: '/management/club/columns',
                        ContentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: {
                            type: 'solutioncol',
                        },
                        success: function (data) {
                            if (data.code) {
                                layer.msg(data.msg, {
                                    icon: 2
                                });
                            }
                            table.render({
                                elem: '#solutiontable',
                                toolbar: '#toolbarAdd',
                                cols: [
                                    [{
                                        field: 'id',
                                        title: 'ID',
                                        width: 60,
                                        fixed: 'left'
                                    }, {
                                        field: 'name',
                                        title: '名称'
                                    }, {
                                        field: 'title',
                                        title: '标题'
                                    }, {
                                        field: 'icon',
                                        title: '图标'
                                    }, {
                                        field: 'banner',
                                        title: '大图'
                                    }, {
                                        field: 'description',
                                        title: '介绍'
                                    }, {
                                        toolbar: '#barAction',
                                        title: '操作'
                                    }]
                                ],
                                data: data,
                                page: true
                            });
                        }
                    });
                    // 客户案例表
                } else if (data.index == 3) {
                    $.ajax({
                        method: 'POST',
                        url: '/management/club/columns',
                        ContentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: {
                            type: 'customercol',
                        },
                        success: function (data) {
                            if (data.code) {
                                layer.msg(data.msg, {
                                    icon: 2
                                });
                            }
                            table.render({
                                elem: '#customertable',
                                toolbar: '#toolbarAdd',
                                cols: [
                                    [{
                                        field: 'id',
                                        title: 'ID',
                                        width: 60,
                                        fixed: 'left'
                                    }, {
                                        field: 'name',
                                        title: '名称'
                                    }, {
                                        field: 'title',
                                        title: '标题'
                                    }, {
                                        field: 'icon',
                                        title: '图标'
                                    }, {
                                        field: 'banner',
                                        title: '大图'
                                    }, {
                                        field: 'description',
                                        title: '介绍'
                                    }, {
                                        toolbar: '#barAction',
                                        title: '操作'
                                    }]
                                ],
                                data: data,
                                page: true
                            });
                        }
                    });
                    // seo城市表
                } else if (data.index == 4) {
                    $.ajax({
                        method: 'POST',
                        url: '/management/club/columns',
                        ContentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: {
                            type: 'seo',
                        },
                        success: function (data) {
                            if (data.code) {
                                layer.msg(data.msg, {
                                    icon: 2
                                });
                            }
                            table.render({
                                elem: '#seotable',
                                toolbar: '#toolbarAdd',
                                cols: [
                                    [{
                                        field: 'id',
                                        title: 'ID',
                                        width: 60,
                                        fixed: 'left'
                                    }, {
                                        field: 'city',
                                        title: '城市'
                                    }, {
                                        toolbar: '#barAction',
                                        title: '操作'
                                    }]
                                ],
                                data: data,
                                page: true
                            });
                        }
                    });
                }
            });
            //头工具栏事件 添加社区分类
            table.on('toolbar(categorys-table)', function (obj) {
                if (obj.event == 'add') {
                    var clubform = layer.open({
                        type: 1,
                        anim: 2,
                        title: '请输入要添加的分类',
                        area: '500px',
                        shadeClose: true, //开启遮罩关闭
                        content: $("#club_form")
                    });
                    document.getElementById('club_form').reset();
                    //监听提交 确认添加分类
                    form.on('submit(club_form_btn)', function (data) {
                        $('.club_form_btn').addClass('layui-btn-disabled');
                        var field = data.field;
                        $.ajax({
                            method: 'POST',
                            url: '/categories/store',
                            ContentType: 'application/json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            data: field,
                            success: function (data) {
                                $('.club_form_btn').removeClass('layui-btn-disabled');
                                if (data.code == 0) {
                                    layer.msg(data.msg, {
                                        icon: 1
                                    });
                                } else {
                                    layer.msg(data.msg, {
                                        icon: 2
                                    });
                                }
                                layer.close(clubform);
                            }
                        });
                        return false;
                    });
                }
            });
            //工具栏修改删除事件 修改社区类目
            table.on('tool(categorys-table)', function (obj) {
                if (obj.event == 'edit') {
                    var data = obj.data;
                    //表单初始赋值
                    form.val('club_form', {
                        "id": data.id,
                        "name": data.name,
                        "icon": data.icon,
                        "description": data.description,
                    });
                    // 产品社区form
                    var club_form = layer.open({
                        type: 1,
                        anim: 2,
                        title: '修改社区类目名称',
                        area: '500px',
                        shadeClose: true, //开启遮罩关闭
                        content: $("#club_form")
                    });

                    //监听提交 确认修改分类
                    form.on('submit(club_form_btn)', function (data) {
                        $('.club_form_btn').addClass('layui-btn-disabled');
                        var field = data.field;
                        $.ajax({
                            method: 'POST',
                            url: '/categories/update',
                            ContentType: 'application/json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            data: field,
                            success: function (data) {
                                $('.club_form_btn').removeClass('layui-btn-disabled');
                                if (data.code == 0) {
                                    layer.msg(data.msg, {
                                        icon: 1
                                    });
                                } else {
                                    layer.msg(data.msg, {
                                        icon: 2
                                    });
                                }
                                layer.close(club_form);
                            }
                        });
                        return false;
                    });
                } else if (obj.event == 'delete') {
                    deleteLine('/categories/destroy', obj);
                }
            });
            //头工具栏事件 添加产品类目
            table.on('toolbar(producttable)', function (obj) {
                if (obj.event == 'add') {
                    var pro_solu_cus_form = layer.open({
                        type: 1,
                        anim: 2,
                        title: '请输入要添加的分类',
                        area: '500px',
                        shadeClose: true, //开启遮罩关闭
                        content: $("#pro_solu_cus_form")
                    });
                    document.getElementById('pro_solu_cus_form').reset()
                    //监听提交 确认添加产品类目
                    proSoluCusFormSubmit('/products/store', pro_solu_cus_form);
                }
            });
            //工具栏事件 修改产品类目
            table.on('tool(producttable)', function (obj) {
                if (obj.event == 'edit') {
                    var data = obj.data;
                    // 产品解决方案 客户案例 共用一个form
                    var pro_solu_cus_form = layer.open({
                        type: 1,
                        anim: 2,
                        title: '请选修改分类',
                        area: '500px',
                        shadeClose: true, //开启遮罩关闭
                        content: $("#pro_solu_cus_form")
                    });
                    //表单初始赋值
                    form.val('pro_solu_cus_form', {
                        "id": data.id,
                        "name": data.name,
                        "icon": data.icon,
                        "title": data.title,
                        "banner": data.banner,
                        "description": data.description,
                    });
                    proSoluCusFormSubmit('/products/update', pro_solu_cus_form);

                } else if (obj.event == 'delete') {
                    deleteLine('/products/destroy', obj);
                }
            });
            //头工具栏事件 添加解决方案类目
            table.on('toolbar(solutiontable)', function (obj) {
                if (obj.event == 'add') {
                    var pro_solu_cus_form = layer.open({
                        type: 1,
                        anim: 2,
                        title: '请输入要添加的分类',
                        area: '500px',
                        shadeClose: true, //开启遮罩关闭
                        content: $("#pro_solu_cus_form")
                    });
                    document.getElementById('pro_solu_cus_form').reset()
                    //监听提交 确认添加解决方案类目
                    proSoluCusFormSubmit('/solutions/store', pro_solu_cus_form);
                }
            });
            //工具栏事件 修改解决方案类目
            table.on('tool(solutiontable)', function (obj) {
                if (obj.event == 'edit') {
                    var data = obj.data;
                    // 产品解决方案 客户案例 共用一个form
                    var pro_solu_cus_form = layer.open({
                        type: 1,
                        anim: 2,
                        title: '请选修改分类',
                        area: '500px',
                        shadeClose: true, //开启遮罩关闭
                        content: $("#pro_solu_cus_form")
                    });
                    //表单初始赋值
                    form.val('pro_solu_cus_form', {
                        "id": data.id,
                        "name": data.name,
                        "icon": data.icon,
                        "title": data.title,
                        "banner": data.banner,
                        "description": data.description,
                    });
                    proSoluCusFormSubmit('/solutions/update', pro_solu_cus_form);

                } else if (obj.event == 'delete') {
                    deleteLine('/solutions/destroy', obj);
                }
            });
            //头工具栏事件 添加客户案例类目
            table.on('toolbar(customertable)', function (obj) {
                if (obj.event == 'add') {
                    var pro_solu_cus_form = layer.open({
                        type: 1,
                        anim: 2,
                        title: '请输入要添加的分类',
                        area: '500px',
                        shadeClose: true, //开启遮罩关闭
                        content: $("#pro_solu_cus_form")
                    });
                    document.getElementById('pro_solu_cus_form').reset()
                    //监听提交 确认添加客户案例类目
                    proSoluCusFormSubmit('/customers/store', pro_solu_cus_form);
                }
            });
            //工具栏事件 修改客户案例类目
            table.on('tool(customertable)', function (obj) {
                if (obj.event == 'edit') {
                    var data = obj.data;
                    // 产品解决方案 客户案例 共用一个form
                    var pro_solu_cus_form = layer.open({
                        type: 1,
                        anim: 2,
                        title: '请选修改分类',
                        area: '500px',
                        shadeClose: true, //开启遮罩关闭
                        content: $("#pro_solu_cus_form")
                    });
                    //表单初始赋值
                    form.val('pro_solu_cus_form', {
                        "id": data.id,
                        "name": data.name,
                        "icon": data.icon,
                        "title": data.title,
                        "banner": data.banner,
                        "description": data.description,
                    });
                    proSoluCusFormSubmit('/customers/update', pro_solu_cus_form);

                } else if (obj.event == 'delete') {
                    deleteLine('/customers/destroy', obj);
                }
            });
            //头工具栏事件 添加SEO城市
            table.on('toolbar(seotable)', function (obj) {
                if (obj.event == 'add') {
                    var seo_form = layer.open({
                        type: 1,
                        anim: 2,
                        title: '请输入要添加城市名称',
                        area: '500px',
                        shadeClose: true, //开启遮罩关闭
                        content: $("#seo_form")
                    });
                    document.getElementById('seo_form').reset();
                    //监听提交 确认添加SEO城市
                    seoFormSubmit('/management/club/seoStore', seo_form);
                }
            });
            //工具栏事件 修改SEO城市
            table.on('tool(seotable)', function (obj) {
                if (obj.event == 'edit') {
                    var data = obj.data;
                    // 产品解决方案 客户案例 共用一个form
                    var seo_form = layer.open({
                        type: 1,
                        anim: 2,
                        title: '请选修城市',
                        area: '500px',
                        shadeClose: true, //开启遮罩关闭
                        content: $("#seo_form")
                    });
                    console.log(data);
                    //表单初始赋值
                    form.val('seo_form', {
                        "id": data.id,
                        "city": data.city,
                    });
                    seoFormSubmit('/management/club/seoStore', seo_form);

                } else if (obj.event == 'delete') {
                    deleteLine('/management/club/seoDestroy', obj);
                }
            });

            // 表单提交监听
            function proSoluCusFormSubmit(api, layerOpen) {
                //监听提交 修改分类
                form.on("submit(pro_solu_cus_form_btn)", function (data) {
                    $(".pro_solu_cus_form_btn").addClass('layui-btn-disabled');
                    var field = data.field;
                    $.ajax({
                        method: 'POST',
                        url: api,
                        ContentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: field,
                        success: function (data) {
                            $(".pro_solu_cus_form_btn").removeClass('layui-btn-disabled');
                            if (data.code == 0) {
                                layer.msg(data.msg, {
                                    icon: 1
                                });
                            } else {
                                layer.msg(data.msg, {
                                    icon: 2
                                });
                            }
                            layer.close(layerOpen);
                        }
                    });
                    return false;
                });
            }
            // 表单提交监听结束
            // 表单SEO提交监听
            function seoFormSubmit(api, layerOpen) {
                //监听提交 修改分类
                form.on("submit(seo_form_btn)", function (data) {
                    $(".seo_form_btn").addClass('layui-btn-disabled');
                    var field = data.field;
                    $.ajax({
                        method: 'POST',
                        url: api,
                        ContentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: field,
                        success: function (data) {
                            $(".seo_form_btn").removeClass('layui-btn-disabled');
                            if (data.code == 0) {
                                layer.msg(data.msg, {
                                    icon: 1
                                });
                            } else {
                                layer.msg(data.msg, {
                                    icon: 2
                                });
                            }
                            layer.close(layerOpen);
                        }
                    });
                    return false;
                });
            }
            // 表单提交监听结束
            /**
             * 
             * @param {api} api 
             * @param {表格行元素} obj 
             */
            function deleteLine(api, obj) {
                layer.confirm('真的移除么', function (index) {
                    $.ajax({
                        method: 'POST',
                        url: api,
                        ContentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: {
                            id: obj.data.id
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
    }
    // 类目管理页面结束

    // 网站设置页面
    if($$('.admin-club-settings-page').length == 1){
        alert('admin-club-settings-page');
    }

});