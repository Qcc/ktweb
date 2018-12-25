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

	// 底部客户提交信息模块
	$$("#customer").on("click", function () {
		$$(this).attr('disabled', true);
		var name = $$('#name').val();
		var phone = $$('#phone').val();
		$$.ajax({
			method: 'POST',
			url: '/business/store',
			ContentType: 'application/json',
			headers: {
				'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
			},
			data: {
				name: name,
				phone: phone,
				type: '终端客户',
			},
			success: function (data) {
				var data = JSON.parse(data);
				if (data.status) {
					$$('.form').css('visibility', 'hidden');
					$$('.msg').text(data.msg);
					$$('.success').show();
				} else {
					$$('.fiald').text(data.msg);
				}
				$$('#customer').removeAttr('disabled');
			}
		})
	});
	// 底部客户提交信息模块结束

	if ($$('.business-info-page').length == 1) {
		//合作伙伴提交信息
		$$("#partner").on("click", function () {
			$$(this).attr('disabled', true);
			var name = $$('#name').val();
			var phone = $$('#phone').val();
			var city = $$('#city').val();
			$$.ajax({
				method: 'POST',
				url: '/business/store',
				ContentType: 'application/json',
				headers: {
					'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
				},
				data: {
					name: name,
					phone: phone,
					city: city,
					type: '代理商',
				},
				success: function (data) {
					var data = JSON.parse(data);
					if (data.status) {
						$$('.msg').text(data.msg);
						$$('.success').show();
					} else {
						$$('.fiald').text(data.msg);
					}
					$$('#partner').removeAttr('disabled');
				}
			});
		});
	}



	// 首页动画
	if ($$('.home-page').length == 1) {
		// body 动画
		var ctbsRun = true,
			kingdeeRun = true,
			yzjRun = true,
			jdyRun = true
		enterprisesRun = true,
			usersRun = true;
		// body 动画结束
		// header部分
		$$(document).ready(function () {
			// 添加导航菜单背景色
			$$(document).on("scroll", function () {
				runNumberAnimat(); // 添加body内容数字动画
			});
			// 初始化首页轮播图
			if ($$('.swiper-container').length === 1) {
				var swiper = new Swiper('.swiper-container', {});
				// 初始化元素可视运行动画
				wow = new WOW({
					animateClass: 'animated',
				});
				wow.init();

				// 执行数字动画
				runNumberAnimat();
			}
		});

		// 检查元素是否可见
		function isVisible(element, winScrollTop) {
			var mainOffsetTop = $$("#" + element).offset().top;
			var mainHeight = $$("#" + element).height();
			var winHeight = $$(window).height();
			if (winScrollTop > mainOffsetTop + mainHeight || winScrollTop < mainOffsetTop - winHeight) {
				return false;
			} else {
				return true;
			}
		}

		// 启动数字动画
		function runNumberAnimat() {
			var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
			if (isVisible('ctbs', scrollTop) && ctbsRun) {
				// 初始化数字动态动画
				var ctbs = new CountUp('ctbs', 1, 10000, 0, 3);
				ctbs.start();
				ctbsRun = false;
			}
			if (isVisible('kingdee', scrollTop) && kingdeeRun) {
				// 初始化数字动态动画
				var kingdee = new CountUp('kingdee', 1, 70, 0, 3);
				kingdee.start();
				kingdeeRun = false;
			}
			if (isVisible('yzj', scrollTop) && yzjRun) {
				// 初始化数字动态动画
				var yzj = new CountUp('yzj', 1, 99, 0, 3);
				yzj.start();
				yzjRun = false;
			}
			if (isVisible('jdy', scrollTop) && jdyRun) {
				// 初始化数字动态动画
				var jdy = new CountUp('jdy', 1, 80, 0, 3);
				jdy.start();
				jdyRun = false;
			}
			if (isVisible('enterprises', scrollTop) && enterprisesRun) {
				// 初始化数字动态动画
				var enterprises = new CountUp('enterprises', 1, 10000, 0, 3);
				enterprises.start();
				enterprisesRun = false;
			}
			if (isVisible('users', scrollTop) && usersRun) {
				// 初始化数字动态动画
				var users = new CountUp('users', 1, 100000, 0, 3);
				users.start();
				usersRun = false;
			}
		}
	}
	// 展开导航菜单
	$$('.kt-products').on('click', function () {
		$$('.kt-menu-tab-head i').removeClass('active');
		if ($$('.kt-nav-header-open').length === 0) {
			$$('.kt-nav-header').toggleClass('kt-nav-header-open');
			$$('.kt-products i').first().addClass('active');
		} else if ($$('.products-panl').length !== 0) {
			$$('.kt-nav-header').removeClass('kt-nav-header-open');
		} else {
			$$('.kt-products i').first().addClass('active');
		}
		var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
		if (scrollTop > 0) {
			$$('.kt-nav-header').addClass('kt-header-top kt-header-top-and-open');
		}
		$$('.kt-menu-warp .kt-menu-panl').removeClass('active products-panl solutions-panl');
		$$('.kt-menu-warp .kt-menu-panl').first().addClass('active products-panl');

	});

	$$('.kt-solutions').on('click', function () {
		$$('.kt-menu-tab-head i').removeClass('active');
		if ($$('.kt-nav-header-open').length === 0) {
			$$('.kt-nav-header').toggleClass('kt-nav-header-open');
			$$('.kt-solutions i').first().addClass('active');
		} else if ($$('.solutions-panl').length !== 0) {
			$$('.kt-nav-header').removeClass('kt-nav-header-open');
		} else {
			$$('.kt-solutions i').first().addClass('active');
		}
		var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
		if (scrollTop > 0) {
			$$('.kt-nav-header').addClass('kt-header-top kt-header-top-and-open');
		}
		$$('.kt-menu-warp .kt-menu-panl').removeClass('active products-panl solutions-panl');
		$$('.kt-menu-warp .kt-menu-panl').last().addClass('active solutions-panl');
	});

	// 添加导航菜单背景色
	$$(document).on("scroll", function () {
		var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
		if (scrollTop > 0) {
			if ($$('.kt-nav-header').hasClass('kt-nav-header-open')) {
				$$('.kt-nav-header').addClass('kt-header-top kt-header-top-and-open');
			} else {
				$$('.kt-nav-header').addClass('kt-header-top');
			}
		} else {
			$$('.kt-nav-header').removeClass('kt-header-top kt-header-top-and-open');
		};
		// runNumberAnimat(); // 添加body内容数字动画
	});
	// 展开移动端菜单导航
	$$('.ktm-nav-menu').on('click', function () {
		console.log("123")
		$$('.kt-nav-header').toggleClass('kt-nav-header-open')

	});
	// header部分结束




});