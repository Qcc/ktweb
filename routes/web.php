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
// 绑定邮箱激活
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');
Route::get('signup/send', 'UsersController@sendEmailConfirmationTo')->name('send_email');


// 用户登录 退出
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// 用户注册...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
// AJAX图形验证码
Route::post('register/captcha', 'Auth\RegisterController@captcha');
// AJAX短信验证码
Route::post('register/smscode', 'Auth\RegisterController@smscode');
Route::post('register/sendsms', 'Auth\RegisterController@sendsms');

// 邮件重置密码 找回密码...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
//发送手机短信验证码
Route::post('password/phone', 'Auth\ForgotPasswordController@sendResetCodePhone')->name('password.phone.request');
//通过手机验证码找回密码
Route::post('password/reset-phone', 'Auth\ForgotPasswordController@resetByPhone');

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
// 点赞 取消点赞 回复
Route::post('/reply/greats/action', 'FollowersController@replyGreats')->name('replygreats.action');

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
//用户举报违规信息
Route::post('topics/topic/report', 'TopicsController@report')->name('topics.report');
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
// 分类话题列表
Route::resource('categories', 'CategoriesController', ['only' => ['show']]);
Route::post('categories/update', 'CategoriesController@update')->name('categories.update');
Route::post('categories/store', 'CategoriesController@store')->name('categories.store');
Route::post('categories/destroy', 'CategoriesController@destroy')->name('categories.destroy');
//上传图片
Route::post('topics/upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');
//发表社区回复
Route::resource('replies', 'RepliesController', ['only' => ['store','destroy']]);
 
// 发表回复后 消息通知话题创建者
Route::get('notifications/notice', 'NotificationsController@notifications')->name('notifications.notice'); 
Route::get('notifications/message', 'NotificationsController@message')->name('notifications.message'); 
Route::get('notifications/system', 'NotificationsController@system')->name('notifications.system'); 
Route::post('notifications/destroy', 'NotificationsController@destroy')->name('notifications.destroy'); 

// 发送私信
Route::get('notifications/message/to/{user}', 'NotificationsController@sendtouser')->name('message.to'); 
Route::get('notifications/message/{conversation}', 'NotificationsController@conversation')->name('message.conversation'); 
Route::post('notifications/message/{user}', 'NotificationsController@sendmessage')->name('message.send'); 
//将文章设置为精华
Route::post('/topic/excellent/action', 'TopicsController@excellent')->name('excellent.action');
//将文章设置置顶
Route::post('/topic/topping/action', 'TopicsController@topping')->name('topping.action');

// 网站管理需要 web_manage 权限
Route::group(['middleware' => ['permission:upload_files']], function () {
    Route::post('/upload/files/update','FilesController@update')->name('upload.files.update');
    Route::post('/upload/files/store','FilesController@store')->name('upload.files.store');
    Route::post('/upload/files/destroy','FilesController@destroy')->name('upload.files.destroy');
});
// 网站管理需要 web_manage 权限
Route::group(['middleware' => ['permission:web_manage']], function () {
    // 网站管理
    Route::get('/management/club/column','ClubManagementController@column')->name('admin.club.column');
    Route::post('/management/club/columns','ClubManagementController@columns')->name('admin.club.columns');
    Route::get('/management/club/system','ClubManagementController@system')->name('admin.club.system');
    Route::get('/management/club/recommend','ClubManagementController@recommend')->name('admin.club.recommend');
    Route::post('/management/club/recommend/store','ClubManagementController@recommendStore')->name('admin.club.recommend.store');
    Route::get('/management/club/web_recommend','ClubManagementController@webRecommend')->name('admin.club.web_recommend');
    Route::post('/management/club/web_recommend/store','ClubManagementController@webRecommendStore')->name('admin.club.web_recommend.store');
    Route::post('/management/club/solution/store','ClubManagementController@webSolutionStore')->name('admin.club.web_solution.store');
    Route::post('/management/club/login/store','ClubManagementController@webloginStore')->name('admin.club.web_login.store');
    // 网站设置
    Route::get('/management/club/settings','ClubManagementController@settings')->name('admin.club.settings');
    Route::post('/management/club/settings/store','ClubManagementController@settingsStore')->name('admin.club.setting.store');
    // 数据导入
    Route::get('/management/club/load','ClubManagementController@loads')->name('admin.club.load');
    Route::post('/management/club/loadstore','ClubManagementController@loadStore')->name('admin.club.loadstore');
    Route::post('/management/club/loadSend','ClubManagementController@loadSend')->name('admin.club.loadSend');
    
    // 客服QQ
    Route::post('/management/club/settings/onlineService','ClubManagementController@onlineService')->name('admin.club.setting.onlineService');
    // SEO修改
    Route::post('/management/club/seoStore','ClubManagementController@seoStore')->name('admin.club.seoStore');
    Route::post('/management/club/seoDestroy','ClubManagementController@seoDestroy')->name('admin.club.seoDestroy');
    // keywords添加删除
    Route::post('/management/club/keywordsStore','ClubManagementController@keywordsStore')->name('admin.club.keywordsStore');
    Route::post('/management/club/keywordsDestroy','ClubManagementController@keywordsDestroy')->name('admin.club.keywordsDestroy');
});
// 用户管理需要 manage_users 权限
Route::group(['middleware' => ['permission:manage_users']], function () {
    Route::get('/management/club/users','ClubManagementController@users')->name('admin.club.users');
    Route::post('/management/club/userstore','ClubManagementController@userstore')->name('admin.club.userstore');
});
// 查看日志需要 manage_logs 权限
Route::group(['middleware' => ['permission:manage_logs']], function () {
    Route::get('/management/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('system.logs');
});
// 角色管理需要 manage_roles 权限
Route::group(['middleware' => ['permission:manage_roles']], function () {
   // 角色管理
    Route::get('/management/club/roles','ClubManagementController@roles')->name('admin.club.roles');
    Route::post('/management/club/roleStore','ClubManagementController@roleStore')->name('admin.club.roleStore');
    Route::post('/management/club/permissions','ClubManagementController@permissions')->name('admin.club.permissions');
    Route::post('/management/club/roleusers','ClubManagementController@roleusers')->name('admin.club.roleusers');
    Route::post('/management/club/rolepermission','ClubManagementController@rolepermission')->name('admin.club.rolepermission');
    Route::post('/management/club/userandpermission','ClubManagementController@userandpermission')->name('admin.club.userandpermission');
    Route::post('/management/club/roleedit','ClubManagementController@roleedit')->name('admin.club.roleedit');
});

//主站新闻
Route::resource('news', 'NewsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::get('news/{news}/{slug?}', 'NewsController@show')->name('news.show');
// 分类新闻
Route::get('columns/{column}/{slug?}', 'ColumnsController@show')->name('columns.show');

//产品介绍
Route::resource('product', 'ProductController', ['only' => ['create', 'store', 'update', 'edit', 'destroy']]);
// Route::get('/product', 'ProductController@index')->name('product.index');
// Route::get('/product/create', 'ProductController@create')->name('product.create');
// Route::post('/product', 'ProductController@store')->name('product.store');
// Route::get('/product/{product}/edit', 'ProductController@edit')->name('product.edit');
// Route::patch('/product/{product}', 'ProductController@update')->name('product.update');
// Route::delete('/product/{product}', 'ProductController@destroy')->name('product.destroy');
Route::get('product/{product}/{slug?}', 'ProductController@show')->name('product.show');
// 产品分类
Route::get('products/{productcol}/{slug?}', 'ProductcolController@show')->name('products.show');
Route::post('products/update', 'ProductcolController@update')->name('products.update');
Route::post('products/store', 'ProductcolController@store')->name('products.store');
Route::post('products/destroy', 'ProductcolController@destroy')->name('products.destroy');
Route::post('upload/uploadImage', 'ProductcolController@uploadImage')->name('upload.uploadImage');

//解决方案
Route::resource('solution', 'SolutionController', ['only' => ['create', 'store', 'update', 'edit', 'destroy']]);
Route::get('solution/{solution}/{slug?}', 'SolutionController@show')->name('solution.show');

// 方案分类
Route::get('solutions/{solutioncol}/{slug?}', 'SolutioncolController@show')->name('solutions.show');
Route::post('solutions/update', 'SolutioncolController@update')->name('solutions.update');
Route::post('solutions/store', 'SolutioncolController@store')->name('solutions.store');
Route::post('solutions/destroy', 'SolutioncolController@destroy')->name('solutions.destroy');
//客户案例
Route::resource('customer', 'CustomersController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::get('customer/{customer}/{slug?}', 'CustomersController@show')->name('customer.show');
// Route::get('customers/{customercol}', 'CustomercolController@show')->name('customers.show');
Route::post('customers/update', 'CustomercolController@update')->name('customers.update');
Route::post('customers/store', 'CustomercolController@store')->name('customers.store');
Route::post('customers/destroy', 'CustomercolController@destroy')->name('customers.destroy');
//上传图片
Route::post('news/upload_image', 'NewsController@uploadImage')->name('news.upload_image');
Route::post('product/upload_image', 'ProductController@uploadImage')->name('product.upload_image');
Route::post('solution/upload_image', 'SolutionController@uploadImage')->name('solution.upload_image');
Route::post('customer/upload_image', 'CustomersController@uploadImage')->name('customer.upload_image');

// 下载试用需求提交
Route::get('business/buy', 'BusinessController@tryOut')->name('business.tryout');
// 用户需求提交
Route::get('business/partner', 'BusinessController@show')->name('business.show');
Route::get('business/partner_info', 'BusinessController@info')->name('business.info');
Route::post('business/store', 'BusinessController@store')->name('business.store');
Route::get('business/{token}', 'BusinessController@check')->name('business.check');
Route::put('business/{business}', 'BusinessController@update')->name('business.update');
Route::delete('business/{business}', 'BusinessController@destroy')->name('business.destroy');