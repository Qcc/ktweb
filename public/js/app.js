// header部分
$(document).ready(function () {
	//  cookie操作
	var cookie = {
		set: function (key, val, time) { //设置cookie方法
			time = time || 30;
			var date = new Date(); //获取当前时间
			var expiresDays = time; //将date设置为n天以后的时间
			date.setTime(date.getTime() + expiresDays * 24 * 3600 * 1000); //格式化为cookie识别的时间
			document.cookie = key + "=" + val + ";expires=" + date.toGMTString(); //设置cookie
		},
		get: function (key) { //获取cookie方法
			/*获取cookie参数*/
			var getCookie = document.cookie.replace(/[ ]/g, ""); //获取cookie，并且将获得的cookie格式化，去掉空格字符
			var arrCookie = getCookie.split(";") //将获得的cookie以"分号"为标识 将cookie保存到arrCookie的数组中
			var tips = null; //声明变量tips
			for (var i = 0; i < arrCookie.length; i++) { //使用for循环查找cookie中的tips变量
				var arr = arrCookie[i].split("="); //将单条cookie用"等号"为标识，将单条cookie保存为arr数组
				if (key == arr[0]) { //匹配变量名称，其中arr[0]是指的cookie名称，如果该条变量为tips则执行判断语句中的赋值操作
					tips = arr[1]; //将cookie的值赋给变量tips
					break; //终止for循环遍历
				}
			}
			return tips;
		},
		del: function (key) { //删除cookie方法
			var date = new Date(); //获取当前时间
			date.setTime(date.getTime() - 10000); //将date设置为过去的时间
			document.cookie = key + "=v; expires =" + date.toGMTString(); //设置cookie
		}
	}
	// 信息提示框样式
	if ($('.alert')) {
		setTimeout(function () {
			$('.alert>.bg').css('width', '0');
			setTimeout(function () {
				$('.alert').hide();
			}, 5000);
		}, 1000);
		$('.alert>.content>a').on('click', function () {
			$('.alert').hide();
		});
	}
	// 底部客户提交信息模块
	$("#customer").on("click", function () {
		$(this).attr('disabled', true);
		var name = $('#name').val();
		var phone = $('#phone').val();
		$.ajax({
			method: 'POST',
			url: '/business/store',
			ContentType: 'application/json',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				name: name,
				phone: phone,
				type: '终端客户',
			},
			success: function (data) {
				if (data.status) {
					$('.form').css('visibility', 'hidden');
					$('.msg').text(data.msg);
					$('.success').show();
				} else {
					$('.fiald').text(data.msg);
				}
				$('#customer').removeAttr('disabled');
				$('.tips').hide();
			}
		})
	});
	// 底部客户提交信息模块结束

	if ($('.business-info-page').length == 1) {
		//合作伙伴提交信息
		$("#partner").on("click", function () {
			$(this).attr('disabled', true);
			var name = $('#name').val();
			var phone = $('#phone').val();
			var city = $('#city').val();
			$.ajax({
				method: 'POST',
				url: '/business/store',
				ContentType: 'application/json',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {
					name: name,
					phone: phone,
					city: city,
					type: '代理商',
				},
				success: function (data) {
					if (data.status) {
						$('.msg').text(data.msg);
						$('.success').show();
					} else {
						$('.fiald').text(data.msg);
					}
					$('#partner').removeAttr('disabled');
				}
			});
		});
	}



	// 首页动画
	if ($('.home-page').length == 1) {
		// body 动画
		var ctbsRun = true,
			kingdeeRun = true,
			yzjRun = true,
			jdyRun = true
		enterprisesRun = true,
			usersRun = true;
		// body 动画结束
		// header部分
		// 添加导航菜单背景色
		$(document).on("scroll", function () {
			runNumberAnimat(); // 添加body内容数字动画
		});
		// 初始化首页轮播图
		if ($('.swiper-container').length === 1) {
			var home_swiper = new Swiper('.swiper-container', {
				loop: true,
				autoplay: true,
				pagination: {
					el: '.swiper-pagination',
					dynamicBullets: true,
				},
			});
		}
		$('.banner-content>.title>h3').each(function () {
			var title = $(this).text();
			var numbers = getNumber(title);
			for (var i = 0; i < numbers.length; i++) {
				title = title.replace(numbers[i], "<span id=CountUp" + numbers[i] + ">" + numbers[i] + "</span>+");
				$(this).empty();
				$(this).append(title);
				runCountUp(numbers[i]);
			}
		});

		function runCountUp(number) {
			setTimeout(function () {
				var countUp = new CountUp('CountUp' + number, 1, number, 0, 3).start();
			}, 100)
		}

		function getNumber(Str, isFilter) {
			//用来判断是否把连续的0去掉
			isFilter = isFilter || false;
			if (typeof Str === "string") {
				// var arr = Str.match(/(0\d{2,})|([1-9]\d+)/g);
				//"/[1-9]\d{1,}/g",表示匹配1到9,一位数以上的数字(不包括一位数).
				//"/\d{2,}/g",  表示匹配至少二个数字至多无穷位数字
				var arr = Str.match(isFilter ? /[1-9]\d{1,}/g : /\d{2,}/g);
				if (arr) {
					return arr.map(function (item) {
						//转换为整数，
						//但是提取出来的数字，如果是连续的多个0会被改为一个0，如000---->0，
						//或者0开头的连续非零数字，比如015，会被改为15，这是一个坑
						// return parseInt(item);
						//字符串，连续的多个0也会存在，不会被去掉
						return parseInt(item);;
					});
				} else {
					return [];
				}
			} else {
				return [];
			}
		}
		$('.banner-content .title').show();
		// 初始化元素可视运行动画
		wow = new WOW({
			animateClass: 'animated',
		});
		wow.init();

		// 执行数字动画
		runNumberAnimat();

		// 检查元素是否可见
		function isVisible(element) {
			if ($("#" + element).length == 0) {
				return false;
			}
			var winScrollTop = document.documentElement.scrollTop || document.body.scrollTop;
			var mainOffsetTop = $("#" + element).offset().top;
			var mainHeight = $("#" + element).height();
			var winHeight = $(window).height();

			if (winScrollTop > mainOffsetTop + mainHeight || winScrollTop < mainOffsetTop - winHeight) {
				return false;
			} else {
				return true;
			}
		}

		// 启动数字动画
		function runNumberAnimat() {

			if (isVisible('ctbs') && ctbsRun) {
				// 初始化数字动态动画
				var ctbs = new CountUp('ctbs', 1, 10000, 0, 3);
				ctbs.start();
				ctbsRun = false;
			}
			if (isVisible('kingdee') && kingdeeRun) {
				// 初始化数字动态动画
				var kingdee = new CountUp('kingdee', 1, 70, 0, 3);
				kingdee.start();
				kingdeeRun = false;
			}
			if (isVisible('yzj') && yzjRun) {
				// 初始化数字动态动画
				var yzj = new CountUp('yzj', 1, 99, 0, 3);
				yzj.start();
				yzjRun = false;
			}
			if (isVisible('jdy') && jdyRun) {
				// 初始化数字动态动画
				var jdy = new CountUp('jdy', 1, 80, 0, 3);
				jdy.start();
				jdyRun = false;
			}
		}
	}
	// 展开导航菜单
	$('.kt-products').on('click', function () {
		$('.kt-menu-tab-head i').removeClass('active');
		if ($('.kt-nav-header-open').length === 0) {
			$('.kt-nav-header').toggleClass('kt-nav-header-open');
			$('.kt-products i').first().addClass('active');
		} else if ($('.products-panl').length !== 0) {
			$('.kt-nav-header').removeClass('kt-nav-header-open');
		} else {
			$('.kt-products i').first().addClass('active');
		}
		var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
		if (scrollTop > 0) {
			$('.kt-nav-header').addClass('kt-header-top kt-header-top-and-open');
		}
		$('.kt-menu-warp .kt-menu-panl').removeClass('active products-panl solutions-panl');
		$('.kt-menu-warp .kt-menu-panl').first().addClass('active products-panl');

	});

	$('.kt-solutions').on('click', function () {
		$('.kt-menu-tab-head i').removeClass('active');
		if ($('.kt-nav-header-open').length === 0) {
			$('.kt-nav-header').toggleClass('kt-nav-header-open');
			$('.kt-solutions i').first().addClass('active');
		} else if ($('.solutions-panl').length !== 0) {
			$('.kt-nav-header').removeClass('kt-nav-header-open');
		} else {
			$('.kt-solutions i').first().addClass('active');
		}
		var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
		if (scrollTop > 0) {
			$('.kt-nav-header').addClass('kt-header-top kt-header-top-and-open');
		}
		$('.kt-menu-warp .kt-menu-panl').removeClass('active products-panl solutions-panl');
		$('.kt-menu-warp .kt-menu-panl').last().addClass('active solutions-panl');
	});

	// 添加导航菜单背景色
	$(document).on("scroll", function () {
		var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
		if (scrollTop > 0) {
			if ($('.kt-nav-header').hasClass('kt-nav-header-open')) {
				$('.kt-nav-header').addClass('kt-header-top kt-header-top-and-open');
			} else {
				$('.kt-nav-header').addClass('kt-header-top');
			}
			$('.ktm-logo').removeClass('ktm-logo-white').addClass('ktm-logo-blue')
			// 回到顶部按钮
			$('.reset-top').show();
		} else {
			$('.ktm-logo').removeClass('ktm-logo-blue').addClass('ktm-logo-white');
			$('.kt-nav-header').removeClass('kt-header-top kt-header-top-and-open');
			$('.reset-top').hide();
		};
		// runNumberAnimat(); // 添加body内容数字动画
	});
	// 展开移动端菜单导航
	$('.ktm-nav-menu').on('click', function () {
		$('.kt-nav-header').toggleClass('kt-nav-header-open')

	});
	// header部分结束

	// 社区首页列表
	if ($('.topics-index-page').length == 1) {
		// 初始化社区首页页轮播图
		if ($('.swiper-container').length === 1) {
			var topics_swiper = new Swiper('.swiper-container', {
				loop: true,
				autoplay: true,
				pagination: {
					el: '.swiper-pagination',
					dynamicBullets: true,
				},
			});
		}
		$('.topic_a_tit').on('click', function () {
			$(this).css('color', '#a2a2a2');
			var id = $(this).attr('id');
			var topics_reading = [];
			if (cookie.get('topics_reading')) {
				topics_reading = JSON.parse(cookie.get('topics_reading'));
			}
			topics_reading.push(id);
			cookie.set('topics_reading', JSON.stringify(topics_reading), 30);
		});
		// 已读的话题灰色显示
		var topics_readings = JSON.parse(cookie.get('topics_reading'));
		if (topics_readings) {
			for (var index = 0; index < topics_readings.length; index++) {
				$('#' + topics_readings[index]).css('color', '#a2a2a2');
			}
		}
	}
	if ($('.categories-show-page').length == 1) {
		$('.topic_a_tit').on('click', function () {
			$(this).css('color', '#a2a2a2');
			var id = $(this).attr('id');
			var topics_reading = [];
			if (cookie.get('topics_reading')) {
				topics_reading = JSON.parse(cookie.get('topics_reading'));
			}
			topics_reading.push(id);
			cookie.set('topics_reading', JSON.stringify(topics_reading), 30);
		});
		// 已读的话题灰色显示
		var topics_readings = JSON.parse(cookie.get('topics_reading'));
		if (topics_readings) {
			for (var index = 0; index < topics_readings.length; index++) {
				$('#' + topics_readings[index]).css('color', '#a2a2a2');
			}
		}
	}


	// 社区详情页面
	if ($('.topics-show-page').length == 1) {
		layui.use(['element', 'layer', 'form', 'laydate'], function () {
			var $ = layui.jquery,
				element = layui.element,
				layer = layui.layer,
				laydate = layui.laydate,
				form = layui.form;
			laydate.render({
				elem: '#top_expired',
				type: 'datetime'
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
		if ($('#reply-editor').length == 1) {
			var editor = new Simditor({
				textarea: $('#reply-editor'),
				toolbar: ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr'],
				upload: {
					url: "/topics/upload_image",
					//工具条都包含哪些内容
					params: {
						_token: $('meta[name="csrf-token"]').attr('content')
					},
					fileKey: 'upload_file',
					connectionCount: 3,
					leaveConfirm: '文件上传中，关闭此页面将取消上传。'
				},
				pasteImage: true,
			});
		}


		$('.reply-reply').on('click', function () {
			$(document).scrollTop($('.reply-box').offset().top);
			var user = $(this).attr('replay-user');
			var link = $(this).attr('replay-link');
			var value = editor.getValue();
			editor.setValue(value + "<a href=" + link + ">@" + user + "</a> &nbsp;");
			editor.focus();
		});
		// 点赞
		$('.excellent').on("click", function () {
			var id = $('#topic_id').attr('data_id');
			$(this).attr('disabled', true);
			if ($('.heartAnimation').length === 0) {
				$('.heart').addClass("heartAnimation");
				$('#likeCount').text(parseInt($('#likeCount').text()) + 1);
				$('.excellent-footer').removeClass('mdui-color-theme-accent').empty().append('<i class="kticon">&#xe606;</i> 已赞');
			} else {
				$('.heart').removeClass("heartAnimation");
				$('#likeCount').text(parseInt($('#likeCount').text()) - 1);
				$('.excellent-footer').addClass('mdui-color-theme-accent').empty().append('<i class="kticon">&#xe606;</i> 点赞');
			}
			$.ajax({
				method: 'POST',
				url: '/topic/greats/action',
				ContentType: 'application/json',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {
					id: id
				},
				success: function (data) {
					$('.excellent').removeAttr('disabled');
				}
			})
		});
		//加关注 取消关注 粉丝
		$(".user-follower").on("click", function () {
			$(this).attr('disabled', true);
			var id = $('#author_id').attr('data_id');
			$.ajax({
				method: 'POST',
				url: '/users/followers/action',
				ContentType: 'application/json',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {
					id: id
				},
				success: function (data) {
					if (data.result) {
						$('.user-follower').empty().append(
							"<i class='kticon'>&#xe659;</i> 已关注").attr(
							'title', '取消关注将不会再收到他的动态').css('color', '#76FF03');
					} else {
						$('.user-follower').empty().append(
							"<i class='kticon'>&#xe7b9;</i> 加关注").attr(
							'title', '关注后能收到他的最新动态').css('color', '#a2a2a2');
					}
					$('.user-follower').removeAttr('disabled');
				}
			})
		});
		//加关注 取消关注 文章
		$(".topic-follower").on("click", function () {
			$(this).attr('disabled', true);
			var id = $('#topic_id').attr('data_id');
			$.ajax({
				method: 'POST',
				url: '/topic/followers/action',
				ContentType: 'application/json',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {
					id: id
				},
				success: function (data) {
					// var data = JSON.parse(data);
					if (data.result) {
						$('.topic-follower').empty().append(
							"<i class='kticon'>&#xe659;</i> 已关注").attr(
							'title', '取消关注将不会再收到新的回复通知').css('color', '#00C853');
					} else {
						$('.topic-follower').empty().append(
							"<i class='kticon'>&#xe736;</i> 加关注").attr(
							'title', '关注后能收到文章的最新回复通知').css('color', '#a2a2a2');;
					}
					$('.topic-follower').removeAttr('disabled');
				}
			})
		});
		//设置精华 取消精华帖
		$('.topic-excellent').on('click', function () {
			$(this).attr('disabled', true);
			var id = $('#topic_id').attr('data_id');
			$.ajax({
				method: 'POST',
				url: '/topic/excellent/action',
				ContentType: 'application/json',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {
					id: id
				},
				success: function (data) {
					// var data = JSON.parse(data);
					if (data.result) {
						if (data.status) {
							$('.topic-excellent').empty().append(
									"<i class='kticon'>&#xe659;</i> 已加精")
								.attr('title', '取消文章精华设置').css('color', '#00C853');
						} else {
							$('.topic-excellent').empty().append(
									"<i class='kticon'>&#xe62d;</i> 加精华")
								.attr('title', '将文章设置为精华').css('color', '#a2a2a2');
						}
					}
					$('.topic-excellent').removeAttr('disabled');
				}
			});
		});
		//置顶帖
		$('.topping-submit').on('click', function () {
			var id = $('#topic_id').attr('data_id');
			var expired = $('#top_expired').val();
			$(this).attr('disabled', true);
			$.ajax({
				method: 'POST',
				url: '/topic/topping/action',
				ContentType: 'application/json',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {
					id: id,
					expired: expired
				},
				success: function (data) {
					// var data = JSON.parse(data);
					if (data.result) {
						if (data.status) {
							$('.topic-topping').empty().append(
									"<i class='kticon'>&#xe659;</i> 已置顶")
								.attr('title', '取消文章置顶').css('color', '#00C853').attr('topping', '1');
						} else {
							$('.topic-topping').empty().append(
									"<i class='kticon'>&#xe636;</i> 置顶")
								.attr('title', '将文章置顶').css('color', '#a2a2a2').attr('topping', '0');
						}
					}
					$('.topexpired-warp').css('display', 'none');
					$('.topping-submit').removeAttr('disabled');
				}
			});
		});
		// 置顶或者 取消置顶
		$('.topic-topping').on('click', function () {
			var topping = $(this).attr('topping');
			//当前置顶状态标记1已经置顶，0未置顶
			if (topping === '1') {
				$(this).attr('disabled', true);
				var id = $('#topic_id').attr('data_id');
				$.ajax({
					method: 'POST',
					url: '/topic/topping/action',
					ContentType: 'application/json',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					data: {
						id: id
					},
					success: function (data) {
						// var data = JSON.parse(data);
						if (data.result) {
							if (data.status) {
								$('.topic-topping').empty().append(
										"<i class='kticon'>&#xe659;</i> 已置顶")
									.attr('title', '取消文章精置顶').css('color', '#00C853').attr('topping', '1');
							} else {
								$('.topic-topping').empty().append(
										"<i class='kticon'>&#xe636;</i> 置顶")
									.attr('title', '将文章置顶').css('color', '#a2a2a2').attr('topping', '0');
							}
						}
						$('.topic-topping').removeAttr('disabled');
					}
				});
			} else {
				$('.topexpired-warp').css('display', 'block');
			}
		});
		// 点赞回复 或者取消点赞回复
		$('.greatReply').on('click', function () {
			$(this).attr('disabled', true);
			var that = this;
			$.ajax({
				method: 'POST',
				url: '/reply/greats/action',
				ContentType: 'application/json',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {
					id: $(that).attr('reply_id')
				},
				success: function (data) {
					var number = parseInt($(that).find('span').text());
					if (data.success) {
						if (data.action == 'add') {
							$(that).find('span').text(number + 1)
						} else if (data.action == 'delete') {
							$(that).find('span').text(number - 1)
						}
					}
					$('.greatReply').removeAttr('disabled');
				}
			});

		});
	}


	// 展开移动端菜单导航
	$('.ktm-nav-menu').on('click', function () {
		$('.club-header').toggleClass('kt-nav-header-open')
		$('#clubbox').toggleClass('xhs_club_box')
		$('#clubbox').parent().toggleClass('xhs_club_padtop')
	});

	// 用户管理页面
	if ($('.admin-club-users-page').length == 1) {
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
					area: '500px',
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
	if ($('.admin-club-roles-page').length == 1) {
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
						// shadeClose: true, //开启遮罩关闭
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
						// shadeClose: true, //开启遮罩关闭
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
						// shadeClose: true, //开启遮罩关闭
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
							for (var index = 0; index < data.length; index++) {
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
	if ($('.admin-club-column-page').length == 1) {
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
					if (!res.success) {
						return layer.msg('上传失败');
					}
					$('#upload-icon').prev().val(res.file_path);
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
					if (!res.success) {
						return layer.msg('上传失败');
					}
					$('#upload-banner').prev().val(res.file_path);
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
					if (!res.success) {
						return layer.msg('上传失败');
					}
					$('#upload-club-icon').prev().val(res.file_path);
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
					// keywords关键词缓存表
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
							type: 'keywords',
						},
						success: function (data) {
							if (data.code) {
								layer.msg(data.msg, {
									icon: 2
								});
							}
							table.render({
								elem: '#keywordstable',
								toolbar: '#toolbarAdd',
								cols: [
									[{
										field: 'key',
										title: 'key',
										width: 200,
										fixed: 'left'
									}, {
										field: 'keywords',
										title: '关键词'
									}, {
										toolbar: '#keywordsAction',
										title: '操作'
									}]
								],
								data: data,
								page: true
							});
						}
					});
					// seo城市表
				} else if (data.index == 5) {
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
					// 文件管理
				} else if (data.index == 6) {
					$.ajax({
						method: 'POST',
						url: '/management/club/columns',
						ContentType: 'application/json',
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
								'content')
						},
						data: {
							type: 'file',
						},
						success: function (data) {
							if (data.code) {
								layer.msg(data.msg, {
									icon: 2
								});
							}
							table.render({
								elem: '#filetable',
								cols: [
									[{
										field: 'id',
										title: 'ID',
										width: 60,
										fixed: 'left'
									}, {
										field: 'name',
										title: '文件名'
									}, {
										field: 'suffix',
										title: '类型',
										width: 60,
									}, {
										field: 'size',
										title: '大小',
										width: 100,
									}, {
										field: 'logined',
										title: '下载权限',
										width: 90,
									}, {
										field: 'path',
										title: '路径',
									}, {
										field: 'hash',
										title: 'hash',
										hide: true,
									}, {
										field: 'save_name',
										title: '保存名',
										hide: true,
									}, {
										field: 'created_at',
										title: '上传时间'
									}, {
										toolbar: '#barAction',
										title: '操作',
										width: 120,
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
						// shadeClose: true, //开启遮罩关闭
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
						// shadeClose: true, //开启遮罩关闭
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
						// shadeClose: true, //开启遮罩关闭
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
						// shadeClose: true, //开启遮罩关闭
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
						// shadeClose: true, //开启遮罩关闭
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
						// shadeClose: true, //开启遮罩关闭
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
						// shadeClose: true, //开启遮罩关闭
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
						// shadeClose: true, //开启遮罩关闭
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
						// shadeClose: true, //开启遮罩关闭
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
						// shadeClose: true, //开启遮罩关闭
						content: $("#seo_form")
					});
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
			//头工具栏事件 添加keywords关键词缓存
			table.on('toolbar(keywordstable)', function (obj) {
				if (obj.event == 'add') {
					var keywords_form = layer.open({
						type: 1,
						anim: 2,
						title: '请输入要添加长尾词名称',
						area: '500px',
						// shadeClose: true, //开启遮罩关闭
						content: $("#keywords_form")
					});
					document.getElementById('keywords_form').reset();
					//监听提交 确认添加SEO城市
					keywordsFormSubmit('/management/club/keywordsStore', keywords_form);
				}
			});
			//工具栏事件 修改keywords关键词
			table.on('tool(keywordstable)', function (obj) {
				if (obj.event == 'delete') {
					layer.confirm('真的移除么', function (index) {
						$.ajax({
							method: 'POST',
							url: "/management/club/keywordsDestroy",
							ContentType: 'application/json',
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
									'content')
							},
							data: {
								key: obj.data.key
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

			//工具栏事件 修改文件下载权限
			table.on('tool(filetable)', function (obj) {
				if (obj.event == 'edit') {
					var data = obj.data;
					// 产品解决方案 客户案例 共用一个form
					var file_form = layer.open({
						type: 1,
						anim: 2,
						title: '请修改权限',
						area: '500px',
						// shadeClose: true, //开启遮罩关闭
						content: $("#file_form")
					});
					//表单初始赋值
					form.val('file_form', {
						"id": data.id,
						"name": data.name,
						"logined": data.logined ? 'true' : 'false',
					});
					fileFormSubmit('/upload/files/update', file_form);

				} else if (obj.event == 'delete') {
					deleteLine('/upload/files/destroy', obj);
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
			// 关键词
			function keywordsFormSubmit(api, layerOpen) {
				//监听提交 修改分类
				form.on("submit(keywords_form_btn)", function (data) {
					$(".keywords_form_btn").addClass('layui-btn-disabled');
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
							$(".keywords_form_btn").removeClass('layui-btn-disabled');
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
			// 表单文件提交监听
			function fileFormSubmit(api, layerOpen) {
				//监听提交 修改分类
				form.on("submit(file_form_btn)", function (data) {
					$(this).addClass('layui-btn-disabled');
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
							$(".file_form_btn").removeClass('layui-btn-disabled');
							if (data.success) {
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
							if (data.success) {
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
	if ($('.admin-club-settings-page').length == 1) {
		layui.use(['layer', 'form', 'table', 'upload'], function () {
			var layer = layui.layer;
			table = layui.table,
				upload = layui.upload,
				form = layui.form;

			table.init('advertising-table', { //转化静态表格
				toolbar: '#toolbarAdd',
			});

			//监听工具条 查看角色用户 查看角色权限
			table.on('toolbar(advertising-table)', function (obj) {
				var data = obj.data;
				if (obj.event === 'add') {
					document.getElementById('advertising-form').reset();
					var advertising_form = layer.open({
						type: 1,
						anim: 2,
						title: '添加广告',
						area: '500px',
						// shadeClose: true, //开启遮罩关闭
						content: $("#advertising-form")
					});
					advertisingSubmit('/management/club/settings/store', advertising_form, 'add');
				}
			});
			//监听工具条 查看角色用户 查看角色权限
			table.on('tool(advertising-table)', function (obj) {
				var data = obj.data;
				if (obj.event === 'delete') {
					data.action = 'delete';
					layer.confirm('真的删除行么', function (index) {
						$.ajax({
							method: 'POST',
							url: '/management/club/settings/store',
							ContentType: 'application/json',
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
									'content')
							},
							data: data,
							success: function (data) {
								if (data.code == 0) {
									obj.del();
								} else {
									layer.msg(data.msg, {
										icon: 2
									});
								}
							}
						});
						layer.close(index);
					});
				} else if (obj.event === 'edit') {
					var advertising_form = layer.open({
						type: 1,
						anim: 2,
						title: '请修改广告',
						area: '500px',
						// shadeClose: true, //开启遮罩关闭
						content: $("#advertising-form")
					});
					//表单初始赋值
					form.val('advertising-form', {
						"id": data.id,
						"key": data.key,
						"banner": data.banner,
						"title": data.title,
						"link": data.link,
					})
					advertisingSubmit('/management/club/settings/store', advertising_form, 'update');
				}
			});
			//上传图片
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
					if (!res.success) {
						return layer.msg('上传失败');
					}
					$('#upload-banner').prev().val(res.file_path);
				},
				error: function () {
					layer.msg('上传失败');
				}
			});

			function advertisingSubmit(api, layerOpen, action) {
				//监听提交 修改分类
				form.on("submit(advertising-btn)", function (data) {
					$(".roles-btn").addClass('layui-btn-disabled');
					var field = data.field;
					field.action = action;
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
							$(".advertising-btn").removeClass('layui-btn-disabled');
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

		});
	}
	// 社区推荐页面
	if ($('.admin-club-recommend-page').length == 1) {
		layui.use(['layer', 'form', 'table', 'upload'], function () {
			var layer = layui.layer;
			table = layui.table,
				upload = layui.upload,
				form = layui.form;

			table.init('clubbanner-table', { //转化静态表格
				toolbar: '#toolbarAdd',
			});

			//监听工具条 查看角色用户 查看角色权限
			table.on('toolbar(clubbanner-table)', function (obj) {
				var data = obj.data;
				if (obj.event === 'add') {
					document.getElementById('clubbanner-form').reset();
					var clubbanner_form = layer.open({
						type: 1,
						anim: 2,
						title: '添加广告',
						area: '500px',
						// shadeClose: true, //开启遮罩关闭
						content: $("#clubbanner-form")
					});
					clubbannerSubmit('/management/club/recommend/store', clubbanner_form, 'add');
				}
			});
			//监听工具条 查看角色用户 查看角色权限
			table.on('tool(clubbanner-table)', function (obj) {
				var data = obj.data;
				if (obj.event === 'delete') {
					data.action = 'delete';
					layer.confirm('真的删除行么', function (index) {
						$.ajax({
							method: 'POST',
							url: '/management/club/recommend/store',
							ContentType: 'application/json',
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
									'content')
							},
							data: data,
							success: function (data) {
								if (data.code == 0) {
									obj.del();
								} else {
									layer.msg(data.msg, {
										icon: 2
									});
								}
							}
						});
						layer.close(index);
					});
				} else if (obj.event === 'edit') {
					var clubbanner_form = layer.open({
						type: 1,
						anim: 2,
						title: '请修改广告',
						area: '500px',
						// shadeClose: true, //开启遮罩关闭
						content: $("#clubbanner-form")
					});
					//表单初始赋值
					form.val('clubbanner-form', {
						"id": data.id,
						"banner": data.banner,
						"title": data.title,
						"subtitle": data.subtitle,
						"link": data.link,
					})
					clubbannerSubmit('/management/club/recommend/store', clubbanner_form, 'update');
				}
			});
			//上传图片
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
					if (!res.success) {
						return layer.msg('上传失败');
					}
					$('#upload-banner').prev().val(res.file_path);
				},
				error: function () {
					layer.msg('上传失败');
				}
			});

			function clubbannerSubmit(api, layerOpen, action) {
				//监听提交 修改分类
				form.on("submit(clubbanner-btn)", function (data) {
					$(".roles-btn").addClass('layui-btn-disabled');
					var field = data.field;
					field.action = action;
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
							$(".clubbanner-btn").removeClass('layui-btn-disabled');
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

		});
	}
	// 主站推荐页面
	if ($('.admin-club-web_recommend-page').length == 1) {
		layui.use(['layer', 'form', 'table', 'upload'], function () {
			var layer = layui.layer;
			table = layui.table,
				upload = layui.upload,
				form = layui.form;

			table.init('homebanner-table', { //首页大图
				toolbar: '#toolbarAdd',
			});
			table.init('solutionbanner-table', { //首页解决方案
				toolbar: '#toolbarAdd',
			});
			table.init('loginbanner-table', { //登录页banner
				toolbar: '#toolbarAdd',
			});

			//监听工具条 首页大图banner
			table.on('toolbar(homebanner-table)', function (obj) {
				var data = obj.data;
				if (obj.event === 'add') {
					document.getElementById('homebanner-form').reset();
					var homebanner_form = layer.open({
						type: 1,
						anim: 2,
						title: '添加广告',
						area: '500px',
						// shadeClose: true, //开启遮罩关闭
						content: $("#homebanner-form")
					});
					homebannerSubmit('/management/club/web_recommend/store', homebanner_form, 'add');
				}
			});
			//监听工具条 首页大图banner
			table.on('tool(homebanner-table)', function (obj) {
				var data = obj.data;
				if (obj.event === 'delete') {
					data.action = 'delete';
					layer.confirm('真的删除行么', function (index) {
						$.ajax({
							method: 'POST',
							url: '/management/club/web_recommend/store',
							ContentType: 'application/json',
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
									'content')
							},
							data: data,
							success: function (data) {
								if (data.code == 0) {
									obj.del();
								} else {
									layer.msg(data.msg, {
										icon: 2
									});
								}
							}
						});
						layer.close(index);
					});
				} else if (obj.event === 'edit') {
					var homebanner_form = layer.open({
						type: 1,
						anim: 2,
						title: '请修改广告',
						area: '500px',
						// shadeClose: true, //开启遮罩关闭
						content: $("#homebanner-form")
					});
					//表单初始赋值
					form.val('homebanner-form', {
						"id": data.id,
						"banner": data.banner,
						"title": data.title,
						"subtitle": data.subtitle,
						"link": data.link,
						"icon1": data.icon1,
						"icon_title1": data.icon_title1,
						"icon_link1": data.icon_link1,
						"icon2": data.icon2,
						"icon_title2": data.icon_title2,
						"icon_link2": data.icon_link2,
						"icon3": data.icon3,
						"icon_title3": data.icon_title3,
						"icon_link3": data.icon_link3,
						"icon4": data.icon4,
						"icon_title4": data.icon_title4,
						"icon_link4": data.icon_link4,
						"icon5": data.icon5,
						"icon_title5": data.icon_title5,
						"icon_link5": data.icon_link5,
					})
					homebannerSubmit('/management/club/web_recommend/store', homebanner_form, 'update');
				}
			});

			// 首页大图提交
			function homebannerSubmit(api, layerOpen, action) {
				//监听提交 修改分类
				form.on("submit(homebanner-btn)", function (data) {
					$(this).addClass('layui-btn-disabled');
					var field = data.field;
					field.action = action;
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
							$(".homebanner-btn").removeClass('layui-btn-disabled');
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

			//监听工具条 首页解决方案
			table.on('toolbar(solutionbanner-table)', function (obj) {
				var data = obj.data;
				if (obj.event === 'add') {
					document.getElementById('solutionbanner-form').reset();
					var solutionbanner_form = layer.open({
						type: 1,
						anim: 2,
						title: '添加广告',
						area: '500px',
						// shadeClose: true, //开启遮罩关闭
						content: $("#solutionbanner-form")
					});
					solutionbannerSubmit('/management/club/solution/store', solutionbanner_form, 'add');
				}
			});
			//监听工具条 解决方案banner
			table.on('tool(solutionbanner-table)', function (obj) {
				var data = obj.data;
				if (obj.event === 'delete') {
					data.action = 'delete';
					layer.confirm('真的删除行么', function (index) {
						$.ajax({
							method: 'POST',
							url: '/management/club/solution/store',
							ContentType: 'application/json',
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
									'content')
							},
							data: data,
							success: function (data) {
								if (data.code == 0) {
									obj.del();
								} else {
									layer.msg(data.msg, {
										icon: 2
									});
								}
							}
						});
						layer.close(index);
					});
				} else if (obj.event === 'edit') {
					var solutionbanner_form = layer.open({
						type: 1,
						anim: 2,
						title: '请修改广告',
						area: '500px',
						// shadeClose: true, //开启遮罩关闭
						content: $("#solutionbanner-form")
					});
					//表单初始赋值
					form.val('solutionbanner-form', {
						"id": data.id,
						"banner": data.banner,
						"title": data.title,
						"subtitle": data.subtitle,
						"link": data.link,
						"icon1": data.icon1,
					})
					solutionbannerSubmit('/management/club/solution/store', solutionbanner_form, 'update');
				}
			});

			function solutionbannerSubmit(api, layerOpen, action) {
				//监听提交 修改分类
				form.on("submit(solutionbanner-btn)", function (data) {
					$(this).addClass('layui-btn-disabled');
					var field = data.field;
					field.action = action;
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
							$(".solutionbanner-btn").removeClass('layui-btn-disabled');
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

			//监听工具条 登录页
			table.on('toolbar(loginbanner-table)', function (obj) {
				var data = obj.data;
				if (obj.event === 'add') {
					document.getElementById('loginbanner-form').reset();
					var loginbanner_form = layer.open({
						type: 1,
						anim: 2,
						title: '添加登录页广告',
						area: '500px',
						// shadeClose: true, //开启遮罩关闭
						content: $("#loginbanner-form")
					});
					loginbannerSubmit('/management/club/login/store', loginbanner_form, 'add');
				}
			});
			//监听工具条 登录页
			table.on('tool(loginbanner-table)', function (obj) {
				var data = obj.data;
				if (obj.event === 'delete') {
					data.action = 'delete';
					layer.confirm('真的删除行么', function (index) {
						$.ajax({
							method: 'POST',
							url: '/management/club/login/store',
							ContentType: 'application/json',
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
									'content')
							},
							data: data,
							success: function (data) {
								if (data.code == 0) {
									obj.del();
								} else {
									layer.msg(data.msg, {
										icon: 2
									});
								}
							}
						});
						layer.close(index);
					});
				} else if (obj.event === 'edit') {
					var loginbanner_form = layer.open({
						type: 1,
						anim: 2,
						title: '请修改广告',
						area: '500px',
						// shadeClose: true, //开启遮罩关闭
						content: $("#loginbanner-form")
					});
					//表单初始赋值
					form.val('loginbanner-form', {
						"id": data.id,
						"banner": data.banner,
						"link": data.link,
					})
					loginbannerSubmit('/management/club/login/store', loginbanner_form, 'update');
				}
			});
			//上传图片
			var uploadIcon = upload.render({
				elem: ".upload-banner",
				url: "/upload/uploadImage",
				field: 'upload_file',
				accept: 'images',
				data: {
					_token: $('meta[name="csrf-token"]').attr('content')
				},
				done: function (res, index, upload) {
					//如果上传失败
					if (!res.success) {
						return layer.msg('上传失败');
					}
					// this.item 可获取到触发上传动作的按钮;
					$(this.item).prev().val(res.file_path);
				},
				error: function () {
					layer.msg('上传失败');
				}
			});

			function loginbannerSubmit(api, layerOpen, action) {
				//监听提交 修改分类
				form.on("submit(loginbanner-btn)", function (data) {
					$(this).addClass('layui-btn-disabled');
					var field = data.field;
					field.action = action;
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
							$(".loginbanner-btn").removeClass('layui-btn-disabled');
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


		});
	}

	// 批量发布文章页面
	if ($('.admin-club-load-page').length == 1) {
		layui.use(['table', 'layer','form'], function () {
			var $ = layui.jquery,
				table = layui.table,
			layer = layui.layer,
			nowSend = false;
			form = layui.form;
			table.init('articles-table', { //转化静态表格
				limit:1000,
			});

			form.on('checkbox(now-send)', function(data){
				nowSend = data.elem.checked;
			  });
			//监听工具条 登录页
			table.on('tool(articles-table)', function (obj) {
				var data = obj.data;
				if (obj.event === 'delete') {
					data.action = 'delete';
					layer.confirm('真的删除行么', function (index) {
						$.ajax({
							method: 'POST',
							url: '/management/club/loadstore',
							ContentType: 'application/json',
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
									'content')
							},
							data: data,
							success: function (data) {
								if (data.code == 0) {
									obj.del();
								} else {
									layer.msg(data.msg, {
										icon: 2
									});
								}
							}
						});
						layer.close(index);
					});
				} else if (obj.event === 'view') {
					var view_layer = layer.open({
						type: 1,
						anim: 2,
						title: '文章预览',
						area: '500px',
						maxmin:true,
						cancel: function(){ 
							//右上角关闭回调
							$('.topic-body').empty();
							//return false 开启该代码可禁止点击该按钮关闭
						  },
						// shadeClose: true, //开启遮罩关闭
						content: $("#body-views")
					});
					layer.full(view_layer);
					data.action = 'view';
					$.ajax({
						method: 'POST',
						url: '/management/club/loadstore',
						ContentType: 'application/json',
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
								'content')
						},
						data: data,
						success: function (data) {
							if (data.code == 0) {
								var article = data.data;
								if(article.source){
									$('.topic-body').append("<storg>来源：</storg>"+article.source+"<br>");
								}
								if(article.category){
									$('.topic-body').append("<storg>类目：</storg>"+article.category);
								}
								if(article.title){
									$('.topic-body').append("<h3>标题：</h3>"+article.title);
								}
								if(article.body){
									$('.topic-body').append("<h3>正文：</h3>"+article.body);
								}
								if(article.reply1){
									$('.topic-body').append("<h3>回复1：</h3>"+article.reply1);
								}
								if(article.reply2){
									$('.topic-body').append("<h3>回复2：</h3>"+article.reply2);
								}
								if(article.reply3){
									$('.topic-body').append("<h3>回复3：</h3>"+article.reply3);
								}
								if(article.reply4){
									$('.topic-body').append("<h3>回复4：</h3>"+article.reply4);
								}
								if(article.reply5){
									$('.topic-body').append("<h3>回复5：</h3>"+article.reply5);
								}
								if(article.reply6){
									$('.topic-body').append("<h3>回复6：</h3>"+article.reply6);
								}
							} else {
								layer.msg(data.msg, {
									icon: 2
								});
							}
						}
					});
				}
			});
			// 检查数据是否完整 格式化数据
			$('.check-data').on('click',function(){
				var checkStatus = table.checkStatus('articles-table');
				if(checkStatus.data.length === 0){
					layer.msg('没有数据被选中!');
					return false;
				}
				$(this).addClass('layui-btn-disabled');
				var ids = [];
				for (let index = 0; index < checkStatus.data.length; index++) {
					  ids.push({id:checkStatus.data[index].id,format:checkStatus.data[index].format});
					}
				$.ajax({
					method: 'POST',
					url: '/management/club/loadformat',
					ContentType: 'application/json',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
							'content')
					},
					data: {list:ids},
					success: function (data) {
						$('.check-data').removeClass('layui-btn-disabled');
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
			});
			// 发布文章到社区
			$('.send-club').on('click',function(){
				var checkStatus = table.checkStatus('articles-table');
				if(checkStatus.data.length === 0){
					layer.msg('没有数据被选中!');
					return false;
				}
				$(this).addClass('layui-btn-disabled');
				var ids = [];
				for (let index = 0; index < checkStatus.data.length; index++) {
					  ids.push({id:checkStatus.data[index].id,format:checkStatus.data[index].format});
					}
				$.ajax({
					method: 'POST',
					url: '/management/club/loadSend',
					ContentType: 'application/json',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
							'content')
					},
					data: {list:ids,nowSend:nowSend,type:"topics"},
					success: function (data) {
						$('.send-club').removeClass('layui-btn-disabled');
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
			});
			// 发布文章到行业新闻
			$('.send-hy').on('click',function(){
				var checkStatus = table.checkStatus('articles-table');
				if(checkStatus.data.length === 0){
					layer.msg('没有数据被选中!');
					return false;
				}
				$(this).addClass('layui-btn-disabled');
				var ids = [];
				for (let index = 0; index < checkStatus.data.length; index++) {
					  ids.push({id:checkStatus.data[index].id,format:checkStatus.data[index].format});
					}
				$.ajax({
					method: 'POST',
					url: '/management/club/loadSend',
					ContentType: 'application/json',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
							'content')
					},
					data: {list:ids,nowSend:nowSend,type:"news-hy"},
					success: function (data) {
						$('.send-hy').removeClass('layui-btn-disabled');
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
			});
			// 发布文章到管理智库
			$('.send-zhik').on('click',function(){
				var checkStatus = table.checkStatus('articles-table');
				if(checkStatus.data.length === 0){
					layer.msg('没有数据被选中!');
					return false;
				}
				$(this).addClass('layui-btn-disabled');
				var ids = [];
				for (let index = 0; index < checkStatus.data.length; index++) {
					  ids.push({id:checkStatus.data[index].id,format:checkStatus.data[index].format});
					}
				$.ajax({
					method: 'POST',
					url: '/management/club/loadSend',
					ContentType: 'application/json',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
							'content')
					},
					data: {list:ids,nowSend:nowSend,type:"news-zhik"},
					success: function (data) {
						$('.send-zhik').removeClass('layui-btn-disabled');
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
			});
			// 批量删除文章
			$('.delete-temp-article').on('click',function(){
				var checkStatus = table.checkStatus('articles-table');
				if(checkStatus.data.length === 0){
					layer.msg('没有数据被选中!');
					return false;
				}
				$(this).addClass('layui-btn-disabled');
				var data = checkStatus.data;
				var ids = [];
				for (let index = 0; index < data.length; index++) {
					  ids.push(data[index].id);
				}
				$.ajax({
					method: 'POST',
					url: '/management/club/loadstore',
					ContentType: 'application/json',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
							'content')
					},
					data: {list:ids,action:'delete'},
					success: function (data) {
						$('.delete-temp-article').removeClass('layui-btn-disabled');
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
			});
		});
	}

	// 产品页面
	if ($('.products-show-page').length == 1) {
		// 初始化产品页面轮播图
		if ($('#solutionSwiper').length === 1) {
			var solutionSwiper = new Swiper('#solutionSwiper', {
				centeredSlides: true,
				slidesPerView: 'auto',
				spaceBetween: 40,
				loop: true,
				autoplay: true,
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
			})
		}
	}
	// 客户案例列表
	if ($('.index-page').length == 1) {
		var customer_swiper = new Swiper('.swiper-container', {
			loop: true,
			autoplay: true,
			pagination: {
				el: '.swiper-pagination',
				dynamicBullets: true,
			},
		});
	}
	// 发布客户案例页面
	if ($('.customer-edit-page').length == 1 || $('.customer-create-page').length == 1) {
		var editor = new Simditor({
			textarea: $('#editor'),
			toolbar: ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color',
				'|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|',
				'indent', 'outdent', 'alignment'
			],
			upload: {
				url: "/customer/upload_image",
				//工具条都包含哪些内容
				params: {
					_token: $('meta[name="csrf-token"]').attr('content')
				},
				fileKey: 'upload_file',
				connectionCount: 3,
				leaveConfirm: '文件上传中，关闭此页面将取消上传。'
			},
			pasteImage: true,
		});
		layui.use(['upload', 'layer'], function () {
			var $ = layui.jquery,
				upload = layui.upload;

			//首图上传
			var uploadImage = upload.render({
				elem: '#btn-image',
				url: "/customer/upload_image",
				field: 'upload_file',
				accept: 'images',
				data: {
					_token: $('meta[name="csrf-token"]').attr('content')
				},
				before: function (obj) {
					//预读本地文件示例，不支持ie8
					obj.preview(function (index, file, result) {
						$('#image').attr('src', result); //图片链接（base64）
					});
				},
				done: function (res) {
					//如果上传失败
					if (!res.success) {
						return layer.msg('上传失败');
					}
					$('#image_path').val(res.file_path);
				},
				error: function () {
					//演示失败状态，并实现重传
					var imageText = $('#status');
					imageText.html(
						'<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs image-reload">重试</a>'
					);
					imageText.find('.image-reload').on('click', function () {
						uploadImage.upload();
					});
				}
			});

			//banner大图上传
			var uploadIcon = upload.render({
				elem: "#upload-banner",
				url: "/customer/upload_image",
				field: 'upload_file',
				accept: 'images',
				data: {
					_token: $('meta[name="csrf-token"]').attr('content')
				},
				done: function (res) {
					//如果上传失败
					if (!res.success) {
						return layer.msg('上传失败');
					}
					$('#upload-banner').prev().val(res.file_path);
				},
				error: function () {
					layer.msg('上传失败');
				}
			});
		});
	}
	// 解决方案页面
	if ($('.solutions-show-page').length == 1) {

	}
	// 产品添加编辑页面
	if ($('.product-edit-page').length == 1 || $('.product-create-page').length == 1) {
		// 主要内容描述
		var editor = new Simditor({
			textarea: $('#editor'),
			toolbar: ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color',
				'|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|',
				'indent', 'outdent', 'alignment'
			],
			defaultImage: '/images/undefined.png',
			upload: {
				url: "/product/upload_image",
				//工具条都包含哪些内容
				params: {
					_token: $('meta[name="csrf-token"]').attr('content')
				},
				fileKey: 'upload_file',
				connectionCount: 3,
				leaveConfirm: '文件上传中，关闭此页面将取消上传。'
			},
			pasteImage: true,
		});
		// 关键点描述编辑器
		var pointeditor = new Simditor({
			textarea: $('#pointeditor'),
		});
		//     pasteImage —— 设定是否支持图片黏贴上传，这里我们使用 true 进行开启；
		// url —— 处理上传图片的 URL；
		// params —— 表单提交的参数，Laravel 的 POST 请求必须带防止 CSRF 跨站请求伪造的 _token 参数；
		// fileKey —— 是服务器端获取图片的键值，我们设置为 upload_file;
		// connectionCount —— 最多只能同时上传 3 张图片；
		// leaveConfirm —— 上传过程中，用户关闭页面时的提醒。
		layui.use(['upload', 'layer'], function () {
			var $ = layui.jquery,
				upload = layui.upload;

			//首图上传
			var uploadImage = upload.render({
				elem: '#btn-image',
				url: "/product/upload_image",
				field: 'upload_file',
				accept: 'images',
				data: {
					_token: $('meta[name="csrf-token"]').attr('content')
				},
				before: function (obj) {
					//预读本地文件示例，不支持ie8
					obj.preview(function (index, file, result) {
						$('#image').attr('src', result); //图片链接（base64）
					});
				},
				done: function (res) {
					//如果上传失败
					if (!res.success) {
						return layer.msg('上传失败');
					}
					$('#image_path').val(res.file_path);
				},
				error: function () {
					//演示失败状态，并实现重传
					var imageText = $('#status');
					imageText.html(
						'<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs image-reload">重试</a>'
					);
					imageText.find('.image-reload').on('click', function () {
						uploadImage.upload();
					});
				}
			});
			//功能图标上传
			var uploadIcon = upload.render({
				elem: '#btn-icon',
				url: "/product/upload_image",
				field: 'upload_file',
				accept: 'images',
				data: {
					_token: $('meta[name="csrf-token"]').attr('content')
				},
				before: function (obj) {
					//预读本地文件示例，不支持ie8
					obj.preview(function (index, file, result) {
						$('#icon').attr('src', result); //图片链接（base64）
					});
				},
				done: function (res) {
					//如果上传失败
					if (!res.success) {
						return layer.msg('上传失败');
					}
					$('#icon_path').val(res.file_path);
				},
				error: function () {
					//演示失败状态，并实现重传
					var iconText = $('#status');
					iconText.html(
						'<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs icon-reload">重试</a>'
					);
					iconText.find('.icon-reload').on('click', function () {
						uploadIcon.upload();
					});
				}
			});
		});
	}
	// 解决方案编辑新建页面
	if ($('.solution-edit-page').length == 1 || $('.solution-create-page').length == 1) {
		var editor = new Simditor({
			textarea: $('#editor'),
			toolbar: ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color',
				'|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|',
				'indent', 'outdent', 'alignment'
			],
			upload: {
				url: "/solution/upload_image",
				//工具条都包含哪些内容
				params: {
					_token: $('meta[name="csrf-token"]').attr('content')
				},
				fileKey: 'upload_file',
				connectionCount: 3,
				leaveConfirm: '文件上传中，关闭此页面将取消上传。'
			},
			pasteImage: true,
		});
		var editor = new Simditor({
			textarea: $('#pointeditor'),
		});
		layui.use(['upload', 'layer'], function () {
			var $ = layui.jquery,
				upload = layui.upload;

			//首图上传
			var uploadImage = upload.render({
				elem: '#btn-image',
				url: "/solution/upload_image",
				field: 'upload_file',
				accept: 'images',
				data: {
					_token: $('meta[name="csrf-token"]').attr('content')
				},
				before: function (obj) {
					//预读本地文件示例，不支持ie8
					obj.preview(function (index, file, result) {
						$('#image').attr('src', result); //图片链接（base64）
					});
				},
				done: function (res) {
					//如果上传失败
					if (!res.success) {
						return layer.msg('上传失败');
					}
					$('#image_path').val(res.file_path);
				},
				error: function () {
					//演示失败状态，并实现重传
					var imageText = $('#status');
					imageText.html(
						'<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs image-reload">重试</a>'
					);
					imageText.find('.image-reload').on('click', function () {
						uploadImage.upload();
					});
				}
			});
			//功能图标上传
			var uploadIcon = upload.render({
				elem: '#btn-icon',
				url: "/solution/upload_image",
				field: 'upload_file',
				accept: 'images',
				data: {
					_token: $('meta[name="csrf-token"]').attr('content')
				},
				before: function (obj) {
					//预读本地文件示例，不支持ie8
					obj.preview(function (index, file, result) {
						$('#icon').attr('src', result); //图片链接（base64）
					});
				},
				done: function (res) {
					//如果上传失败
					if (!res.success) {
						return layer.msg('上传失败');
					}
					$('#icon_path').val(res.file_path);
				},
				error: function () {
					//演示失败状态，并实现重传
					var iconText = $('#status');
					iconText.html(
						'<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs icon-reload">重试</a>'
					);
					iconText.find('.icon-reload').on('click', function () {
						uploadIcon.upload();
					});
				}
			});
		});
	}
	if ($('.notifications-notice-page').length == 1) {
		layui.use(['layer'], function () {
			var layer = layui.layer;
			$('.notifications-del').on('click', function () {
				var id = $(this).attr('data_id')
				var that = this;
				$(this).hide();
				$.ajax({
					method: 'POST',
					url: '/notifications/destroy',
					ContentType: 'application/json',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					data: {
						notice: id,
					},
					success: function (data) {
						if (data.success) {
							$(that).parent().hide();
						} else {
							layer.msg(data.msg, {
								icon: 2
							});
						}
					}
				});
			});
		});
	}
	// 搜索栏
	$('.search-bar').on('click', function () {
		layui.use(['layer'], function () {
			var layer = layui.layer;
			layer.open({
				type: 1,
				title: false,
				closeBtn: 0,
				area: '530px',
				shadeClose: true,
				skin: 'yourclass',
				content: $('#search-input')
			});
		});
		$('.search-form').keydown(function (e) {
			if (e.keyCode == 13) {
				e.target.value = "site:kouton.com " + e.target.value;
			}
		});
	});

	if ($('.news-create-page').length == 1 || $('.news-edit-page').length == 1) {
		var editor = new Simditor({
			textarea: $('#editor'),
			toolbar: ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color',
				'|', 'ul', 'ol', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|',
				'indent', 'outdent', 'alignment'
			],
			upload: {
				url: "/news/upload_image",
				//工具条都包含哪些内容
				params: {
					_token: $('meta[name="csrf-token"]').attr('content')
				},
				fileKey: 'upload_file',
				connectionCount: 3,
				leaveConfirm: '文件上传中，关闭此页面将取消上传。'
			},
			pasteImage: true,
		});
		layui.use(['upload', 'layer'], function () {
			var upload = layui.upload;
			var layer = layui.layer;

			//普通图片上传
			var uploadInst = upload.render({
				elem: '#btn_upload',
				url: "/news/upload_image",
				field: 'upload_file',
				accept: 'images',
				data: {
					_token: $('meta[name="csrf-token"]').attr('content')
				},
				before: function (obj) {
					//预读本地文件示例，不支持ie8
					obj.preview(function (index, file, result) {
						$('#image').attr('src', result); //图片链接（base64）
					});
				},
				done: function (res) {
					//如果上传失败
					if (!res.success) {
						return layer.msg('上传失败');
					}
					$('#image_path').val(res.file_path);
				},
				error: function () {
					//演示失败状态，并实现重传
					var demoText = $('#status');
					demoText.html(
						'<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs image-reload">重试</a>'
					);
					demoText.find('.image-reload').on('click', function () {
						uploadInst.upload();
					});
				}
			});
			//banner大图上传
			var uploadIcon = upload.render({
				elem: "#upload-banner",
				url: "/news/upload_image",
				field: 'upload_file',
				accept: 'images',
				data: {
					_token: $('meta[name="csrf-token"]').attr('content')
				},
				done: function (res) {
					//如果上传失败
					if (!res.success) {
						return layer.msg('上传失败');
					}
					$('#upload-banner').prev().val(res.file_path);
				},
				error: function () {
					layer.msg('上传失败');
				}
			});

		});
	}
	if ($('.columns-show-page').length == 1) {
		// 初始化新闻首页轮播图
		if ($('.swiper-container').length === 1) {
			var news_swiper = new Swiper('.swiper-container', {
				loop: true,
				autoplay: true,
				pagination: {
					el: '.swiper-pagination',
					dynamicBullets: true,
				},
			});
		}
	}
	if ($('.register-page').length == 1) {
		// 保存图形验证码是否正确状态
		var captchaStatus = false; //图形验证码状态
		var sms = ''; // 保存短信验证码
		var smsStatus = false; //短信验证码发送状态
		var ready = false; // 验证是否就绪，就绪后直接提交表单
		var captcha = $('#captcha'); // 图片验证码
		var vercode = $('#vercode'); //短信验证码
		var phone = $('#phone'); // 手机号input
		var submit = $('#submit'); //提交表单按钮

		submit.on('click', function (event) {
			var e = event || window.event;
			if (!ready) {
				if (!phone.val() || !phone.val().match(/^(1[0-9])\d{9}$/)) {
					phone.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
					e.preventDefault();
					return false;
				}
				if (!captchaStatus) {
					captcha.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
					e.preventDefault();
					return false;
				}
				$('.form-group-phone').css('display', 'none');
				$('.form-group-captcha').css('display', 'none');
				$('.form-group-sms').css('display', 'block');
				if (!smsStatus && !sms) {
					sendsms(phone.val());
					return false;
				}
				if (!sms) {
					vercode.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
					e.preventDefault();
					return false;
				}
			}
		});
		// 校验图形验证码
		captcha.on('keyup', function () {
			var value = captcha.val();
			var phone_number = phone.val();
			// 限定验证码长度为4位
			if (value.length === 4) {
				$('.captcha-check-icon').css('display', 'block');
				$.ajax({
					method: 'POST',
					url: '/register/captcha',
					ContentType: 'application/json',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					data: {
						captcha: value,
						phone: phone_number
					},
					success: function (data) {
						if (data.captcha) {
							$('.captcha-check-icon').css('display', 'none');
							$('.captcha-success-icon').css('display', 'inline');
							if (data.user) {
								captchaStatus = false;
								$('.form-group-phone>div').addClass('mdui-textfield-invalid-html5');
								$('.form-group-phone .mdui-textfield-error').text('手机号已注册,请直接登录!');
							} else {
								$('#submit').text('下 一 步');
								captchaStatus = true;
							}
						} else {
							$('.captcha-check-icon').css('display', 'none');
							captchaStatus = false;
							captcha.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
						}
					}
				})
			} else {
				$('.captcha-success-icon').css('display', 'none');
				captchaStatus = false;
				captcha.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
			}
		});
		// 校验短信验证码
		vercode.on('keyup', function () {
			// 限定验证码长度为5位
			if (vercode.val().length === 5) {
				$('.smscode-check-icon').css('display', 'block');
				$.ajax({
					method: 'POST',
					url: '/register/smscode',
					ContentType: 'application/json',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					data: {
						smscode: vercode.val(),
						captcha: captcha.val()
					},
					success: function (data) {
						if (data.smscode) {
							vercode.parent('.mdui-textfield').removeClass('mdui-textfield-invalid-html5');
							$('.smscode-check-icon').css('display', 'none');
							$('.smscode-success-icon').css('display', 'inline');
							ready = true; // 装备就绪 可以提交表单
							sms = data.value; // 保存获取到的正确短信验证码
						} else {
							$('.smscode-check-icon').css('display', 'none');
							vercode.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
							ready = false;
						}
					}
				});
			} else {
				sms = '';
				ready = false; // 重置短信表单验证状态
				$('.smscode-success-icon').css('display', 'none');
				vercode.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
			}
		});

		function smstips() {
			var num = 60;
			$('.sendsms-title').empty().append("我们已经向您的手机<span>" + phone.val() + "</span>发送了一条验证码")
			var interval = setInterval(function () {
				$('.sendsmstips').empty();
				if (num < 0) {
					$('.sendsmstips').append("<a id='btnsendsms' href='javascript:;'>重新发送验证码?</a>")
					clearInterval(interval);
					$('#btnsendsms').on('click', function () {
						sendsms(phone.val());
					})
					smsStatus = false; //校验超时后 重置发送状态
					return;
				}
				$('.sendsmstips').append("没收到?<span>" + num + "秒</span>后重新获取。");
				num--;
			}, 1000);
		};

		// 发送验证码
		function sendsms(phoneNumber) {
			$.ajax({
				method: 'POST',
				url: '/register/sendsms',
				ContentType: 'application/json',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {
					phone: phoneNumber,
					captcha: captcha.val()
				},
				success: function (data) {}
			});
			smstips();
			smsStatus = true; //发送短信后 改变发送状态
		}
	}
	if ($('.login-page').length == 1) {
		// 初始化登录页轮播图
		if ($('.swiper-container').length === 1) {
			var login_swiper = new Swiper('.swiper-container', {
				// autoplay: true,//可选选项，自动滑动
				loop: true, // 循环模式选项
				// 如果需要分页器
				pagination: {
					el: '.swiper-pagination',
					//原点分页器效果
					dynamicBullets: true,
					dynamicMainBullets: 1
				},
			});
		}
		$('#submit').on('click', function (e) {
			var phone = $('#phone');
			var pwd = $('#password');
			if (!phone.val()) {
				phone.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
				e.preventDefault();
			}
			if (!pwd.val()) {
				pwd.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
				e.preventDefault();
				return false;
			}
			if ((phone.val()).indexOf('@') !== -1) {
				phone.prop({
					'name': 'email'
				});
			} else {
				phone.prop({
					'name': 'phone'
				});
			}
		});
	}
	// 新建或编辑社区话题
	if ($('.topics-edit-page').length == 1 || $('.topics-create-page').length == 1) {
		// 富文本编辑器
		var editor = new Simditor({
			textarea: $('#editor'),
			toolbar: ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color',
				'|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|',
				'indent', 'outdent', 'alignment'
			],
			allowedAttributes: {
				img: ['src', 'alt', 'width', 'height', 'data-non-image'],
				a: ['href', 'target', 'class', 'title'],
				font: ['color'],
				code: ['class'],
			},
			cleanPaste: true,
			upload: {
				url: "/topics/upload_image",
				//工具条都包含哪些内容
				params: {
					_token: $('meta[name="csrf-token"]').attr('content')
				},
				fileKey: 'upload_file',
				connectionCount: 3,
				leaveConfirm: '文件上传中，关闭此页面将取消上传。'
			},
			pasteImage: true,
		});
		layui.use(['upload', 'layer', 'form', 'table'], function () {
			var upload = layui.upload,
				form = layui.form,
				table = layui.table,
				layer = layui.layer;
			// 选择附件
			$('.select_file').on('click', function (e) {
				e.preventDefault();
				var select_layer = layer.open({
					type: 1,
					title: '选择附件',
					skin: 'layui-layer-demo', //样式类名
					closeBtn: 1, //关闭按钮
					anim: 2,
					area: ['500px', '300px'],
					maxmin: true,
					shade: 0, //开启遮罩
					content: $('.select-file-box')
				});

			});
			// 上传附件
			$('.upload_file').on('click', function (e) {
				e.preventDefault();
				var upload_layer = layer.open({
					type: 1,
					title: '上传附件',
					skin: 'layui-layer-demo', //样式类名
					closeBtn: 1, //关闭按钮
					anim: 2,
					area: ['500px', '300px'],
					maxmin: true,
					shade: 0, //开启遮罩
					content: $('.upload-file-box')
				});
				form.on("submit(upload-btn)", function (data) {
					var file = data.field;
					$.ajax({
						method: 'POST',
						url: '/upload/files/store',
						ContentType: 'application/json',
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
								'content')
						},
						data: file,
						success: function (data) {
							$(".loginbanner-btn").removeClass('layui-btn-disabled');
							if (!data.success) {
								layer.msg(data.msg, {
									icon: 1
								});
							}
						}
					});
					layer.close(upload_layer);
					// 清除已经表单文件
					document.getElementById('upload-file-form') && document.getElementById('upload-file-form').reset();
					$('#progressbar').css('width', '0px');
					$('#output').text('');
					$('#file').removeAttr('disabled');
					$('.upload-file-sucess').hide();
					// 插入附件到富文本输入框
					var value = editor.getValue();
					var icon = ''
					switch (file.suffix) {
						case 'doc':
						case 'docx':
							icon = 'doc';
							break;
						case 'ppt':
						case 'pptx':
							icon = 'ppt';
							break;
						case 'xls':
						case 'xlsx':
							icon = 'xls';
							break;
						case 'pdf':
							icon = 'pdf';
							break;
						case 'rar':
						case 'zip':
							icon = 'rar';
							break;
						default:
							icon = 'file';
							break;
					}
					var title = '点击下载该文件';
					if (file.logined == 'true') {
						title = '该文件需要登录后才能下载';
					}
					var link = "<a title=" + title + " class='annex " + icon + "'  href=/aetherupload/download/" + file.path + "/" + file.name + ">" + file.name + "." + file.suffix + "(" + byteConvert(file.size) + ")</a>";
					editor.setValue(value + link);
					editor.focus();

					return false;
				});
			});
			// 文件上传回调
			// success(callback)中声名的回调方法需在此定义，参数callback可为任意名称，此方法将会在上传完成后被调用
			// 可使用this对象获得fileName,fileSize,uploadBaseName,uploadExt,subDir,group,savedPath等属性的值
			someCallback = function () {
				$('.upload-file-sucess').show();
				//表单初始赋值
				form.val('upload-file-sucess', {
					"name": this.fileName.substr(0, this.fileName.lastIndexOf('.')),
					"hash": this.savedPath.substring(this.savedPath.lastIndexOf('/') + 1, this.savedPath.lastIndexOf('.')),
					"size": this.fileSize,
					"save_name": this.savedPath.substr(this.savedPath.lastIndexOf('/') + 1),
					"path": this.savedPath,
					"suffix": this.savedPath.substr(this.savedPath.lastIndexOf('.') + 1),
				});
			}
		});
	}
	if ($('.password-request-page').length == 1) {
		layui.use(['layer', 'form'], function () {
			var form = layui.form,
				layer = layui.layer;
			form.on("submit(phone-btn)", function (data) {
				$(this).addClass('layui-btn-disabled');
				var field = data.field;
				$.ajax({
					method: 'POST',
					url: '/password/phone',
					ContentType: 'application/json',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
							'content')
					},
					data: field,
					success: function (data) {
						$(".phone-btn").removeClass('layui-btn-disabled');
						if (data.success) {
							$('.phone-form').hide();
							$('.code-form').show();
							$('.telphone').text(data.phone);
							$('.step2').css('color', '#9CCC65');
							var number = 60;
							var interval = setInterval(function () {
								$('.second').text(number);
								number--;
								if (number < 0) {
									clearInterval(interval);
									$('.second').text();
									$('.second-box').hide();
									$('.resend').css('display', 'block');
								}
							}, 1000);
							$('.resend').on('click', function () {
								$(this).hide();
								$('.second-box').show();
								var number = 60;
								var interval = setInterval(function () {
									$('.second').text(number);
									number--;
									if (number < 0) {
										clearInterval(interval);
										$('.second-box').hide();
										$('.resend').css('display', 'block');
									}
								}, 1000);
								$.ajax({
									method: 'POST',
									url: '/password/phone',
									ContentType: 'application/json',
									headers: {
										'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
											'content')
									},
									data: field,
									success: function (data) {

									}
								});
							});
						} else {
							$('.phone-form .help-block').empty().show();
							for (var index = 0; index < data.length; index++) {
								$('.phone-form .help-block').append("<p><i class='kticon'>&#xe6b9;</i><strong>" + data[index] + "</strong></p>");
							}
						}

					}
				});
				return false;
			});
			form.on("submit(code-btn)", function (data) {
				var field = data.field;
				if (field.password.length < 6) {
					layer.msg('密码长度不能小于6位', {
						icon: 2
					});
					return false;
				}
				if (field.password != field.confirmpassword) {
					layer.msg('两次输入的密码不一致', {
						icon: 2
					});
					return false;
				}
				$(this).addClass('layui-btn-disabled');
				$.ajax({
					method: 'POST',
					url: '/password/reset-phone',
					ContentType: 'application/json',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
							'content')
					},
					data: field,
					success: function (data) {
						if (data.success) {
							$('.code-form').hide();
							$('.password-success').show();
							$('.step3').css('color', '#9CCC65');
						} else {
							$('.code-btn').removeClass('layui-btn-disabled');
							layer.msg(data.msg, {
								icon: 2
							});
						}
					}
				});
				return false;
			});
		});
	}
	if ($('password-reset-page').length == 1) {
		layui.use(['layer', 'form'], function () {
			var form = layui.form;
		});
	}
	// 字节单位换算
	var byteConvert = function (bytes) {
		if (isNaN(bytes)) {
			return '';
		}
		var symbols = ['bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
		var exp = Math.floor(Math.log(bytes) / Math.log(2));
		if (exp < 1) {
			exp = 0;
		}
		var i = Math.floor(exp / 10);
		bytes = bytes / Math.pow(2, 10 * i);

		if (bytes.toString().length > bytes.toFixed(2).toString().length) {
			bytes = bytes.toFixed(2);
		}
		return bytes + ' ' + symbols[i];
	};

	// 返回顶部按钮
	var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
	if (scrollTop != 0) {
		$('.reset-top').show();
	} else {
		$('.reset-top').hide();
	}
	$('.reset-top').on('click', function () {
		$(window).scrollTop(0);
	});

	// 试用申请页面
	if ($('.business-tryout-page').length == 1) {
		layui.use(['layer', 'form'], function () {
			var form = layui.form,
				layer = layui.layer;
			//监听提交
			form.on('submit(buy-btn)', function (data) {
				$(this).addClass('layui-btn-disabled');
				$.ajax({
					method: 'POST',
					url: '/business/store',
					ContentType: 'application/json',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
							'content')
					},
					data: data.field,
					success: function (data) {
						$(".buy-btn").removeClass('layui-btn-disabled');
						if (!data.success) {
							layer.msg(data.msg, {
								icon: 1
							});
							document.getElementById("buy-form").reset();
						}
					}
				});
				return false;
			});
		});
	}

});