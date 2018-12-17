<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@home')->name('home');
// 用户增删改查路由
// Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/users/create', 'UsersController@create')->name('users.create');
Route::get('/users/{user}', 'UsersController@show')->name('users.show');
Route::post('/users', 'UsersController@store')->name('users.store');
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');
Route::get('/users/{user}/password', 'UsersController@password')->name('users.password');
Route::post('/users/{user}/uppwd', 'UsersController@uppwd')->name('users.uppwd');
// AJAX图形验证码
Route::post('ajax/captcha', 'CaptchaController@captcha');
// AJAX短信验证码
Route::post('ajax/smscode', 'CaptchaController@smscode');
Route::post('ajax/sendsms', 'CaptchaController@sendsms');
// 用户登录 退出
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// 用户注册...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
// 邮件重置密码 找回密码...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//用户粉丝 显示用户的关注人列表
Route::get('/users/{user}/followings', 'UsersController@followings')->name('users.followings');
//用户粉丝 显示用户的粉丝列表
Route::get('/users/{user}/followers', 'UsersController@followers')->name('users.followers');
//关注 取关 用户
Route::post('/users/followers/action', 'FollowersController@followers')->name('followers.action');

//关注 取关 文章
Route::post('/topic/followers/action', 'FollowersController@topicFollowers')->name('topicfollowers.action');

// 点赞 取消点赞 文章
Route::post('/topic/greats/action', 'FollowersController@topicGreats')->name('topicgreats.action');

//用户个人页面
Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);
// 以上代码相当于一下路由
// Route::get('/users/{user}', 'UsersController@show')->name('users.show');
// Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
// Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
// 社区帖子增删改查
Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
// URI 参数 topic 是 『隐性路由模型绑定』 的提示，将会自动注入 ID 对应的话题实体。
// URI 最后一个参数表达式 {slug?} ，? 意味着参数可选，这是为了兼容我们数据库中 Slug 为空的话题数据。这种写法可以同时兼容以下两种链接：
// http://larabbs.test/topics/119
// http://larabbs.test/topics/119/slug-translation-test
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
// 分类话题列表
Route::resource('categories', 'CategoriesController', ['only' => ['show']]);
//上传图片
Route::post('topics/upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');
//发表社区回复
Route::resource('replies', 'RepliesController', ['only' => ['store','destroy']]);
// 发表回复后 消息通知话题创建者
Route::get('notifications/notice', 'NotificationsController@notifications')->name('notifications.notice'); 
Route::get('notifications/message', 'NotificationsController@message')->name('notifications.message'); 
Route::get('notifications/system', 'NotificationsController@system')->name('notifications.system'); 

// 发送私信
Route::get('notifications/message/to/{user}', 'NotificationsController@sendtouser')->name('message.to'); 
Route::get('notifications/message/{conversation}', 'NotificationsController@conversation')->name('message.conversation'); 
Route::post('notifications/message/{user}', 'NotificationsController@sendmessage')->name('message.send'); 
//将文章设置为精华
Route::post('/topic/excellent/action', 'TopicsController@excellent')->name('excellent.action');
//将文章设置置顶
Route::post('/topic/topping/action', 'TopicsController@topping')->name('topping.action');

// 社区管理
Route::get('/management/club/system','ClubManagementController@system')->name('admin.club.system');
Route::get('/management/club/recommend','ClubManagementController@recommend')->name('admin.club.recommend');
Route::get('/management/club/roles','ClubManagementController@roles')->name('admin.club.roles');
Route::get('/management/club/settings','ClubManagementController@settings')->name('admin.club.settings');
Route::get('/management/club/users','ClubManagementController@users')->name('admin.club.users');
Route::get('/management/club/articles','ClubManagementController@articles')->name('admin.club.articles');
Route::get('/management/club/replys','ClubManagementController@replys')->name('admin.club.replys');
// 网站管理
Route::get('/management/web/settings','WebManagementController@settings')->name('admin.web.settings');
Route::get('/management/web/recommend','WebManagementController@recommend')->name('admin.web.recommend');
Route::get('/management/web/create','WebManagementController@create')->name('admin.web.create');
Route::get('/management/web/categorys','WebManagementController@categorys')->name('admin.web.categorys');
Route::get('/management/web/system','WebManagementController@system')->name('admin.web.system');

//主站新闻
Route::resource('news', 'NewsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::get('news/{news}/{slug?}', 'NewsController@show')->name('news.show');
// 分类新闻
Route::resource('columns', 'ColumnsController', ['only' => ['show']]);

//产品介绍
Route::resource('product', 'ProductController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
// Route::get('/product', 'ProductController@index')->name('product.index');
// Route::get('/product/create', 'ProductController@create')->name('product.create');
// Route::post('/product', 'ProductController@store')->name('product.store');
// Route::get('/product/{product}/edit', 'ProductController@edit')->name('product.edit');
// Route::patch('/product/{product}', 'ProductController@update')->name('product.update');
// Route::delete('/product/{product}', 'ProductController@destroy')->name('product.destroy');
Route::get('product/{product}/{slug?}', 'ProductController@show')->name('product.show');
// 产品分类
Route::get('products/{productcol}', 'ProductcolController@show')->name('products.show');

//解决方案
Route::resource('solution', 'SolutionController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::get('solution/{solution}/{slug?}', 'SolutionController@show')->name('solution.show');
// 方案分类
Route::get('solutions/{solutioncol}', 'SolutioncolController@show')->name('solutions.show');
//客户案例
Route::resource('customer', 'CustomersController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::get('customers/{customercol}', 'CustomercolController@show')->name('customers.show');
//上传图片
Route::post('news/upload_image', 'NewsController@uploadImage')->name('news.upload_image');
Route::post('product/upload_image', 'ProductController@uploadImage')->name('product.upload_image');
Route::post('solution/upload_image', 'SolutionController@uploadImage')->name('solution.upload_image');
Route::post('customer/upload_image', 'CustomersController@uploadImage')->name('customer.upload_image');

// 用户需求提交
Route::get('business/partner', 'BusinessController@show')->name('business.show');
Route::get('business/partner_info', 'BusinessController@info')->name('business.info');
Route::post('business/store', 'BusinessController@store')->name('business.store');
Route::get('business/{token}', 'BusinessController@check')->name('business.check');
Route::put('business/{business}', 'BusinessController@update')->name('business.update');