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
Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');
//发表社区回复
Route::resource('replies', 'RepliesController', ['only' => ['store','destroy']]);
// 发表回复后 消息通知话题创建者
Route::get('notifications/notice', 'NotificationsController@notifications')->name('notifications.notice'); 
Route::get('notifications/message', 'NotificationsController@message')->name('notifications.message'); 
Route::get('notifications/message/to/{user}', 'NotificationsController@sendtouser')->name('message.to'); 
Route::post('notifications/message/{user}', 'NotificationsController@sendmessage')->name('message.send'); 
Route::get('notifications/system', 'NotificationsController@system')->name('notifications.system'); 
//将文章设置为精华
Route::post('/topic/excellent/action', 'TopicsController@excellent')->name('excellent.action');
//将文章设置置顶
Route::post('/topic/topping/action', 'TopicsController@topping')->name('topping.action');
