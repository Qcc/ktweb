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
Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/users/create', 'UsersController@create')->name('users.create');
Route::get('/users/{user}', 'UsersController@show')->name('users.show');
Route::post('/users', 'UsersController@store')->name('users.store');
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');

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