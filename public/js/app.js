var $$ = mdui.JQ;
// header部分
$$(document).ready(function () {
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
