<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Laravel\Horizon\Horizon;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Models\User::observe(\App\Observers\UserObserver::class);
		\App\Models\Customer::observe(\App\Observers\CustomerObserver::class);
		\App\Models\Reply::observe(\App\Observers\ReplyObserver::class);
		\App\Models\Topic::observe(\App\Observers\TopicObserver::class);
		\App\Models\Message::observe(\App\Observers\MessageObserver::class);
		\App\Models\News::observe(\App\Observers\NewsObserver::class);
		\App\Models\Product::observe(\App\Observers\ProductObserver::class);
		\App\Models\Productcol::observe(\App\Observers\ProductcolObserver::class);
		\App\Models\Solution::observe(\App\Observers\SolutionObserver::class);
		\App\Models\Solutioncol::observe(\App\Observers\SolutioncolObserver::class);
		\App\Models\Conversation::observe(\App\Observers\ConversationObserver::class);
		\App\Models\Business::observe(\App\Observers\BusinessObserver::class);
        Schema::defaultStringLength(191);
        \Carbon\Carbon::setLocale('zh');
        //自定义短信验证码规则
        Validator::extend('smscode', function($attribute, $value, $parameters){
            return $value == session('smscode.value');
        });

        Horizon::auth(function ($request) {
            // 访问队列仪表盘需要权限 return true / false;
           return Auth::user()->can('web_manage');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (app()->isLocal()) {
            $this->app->register(\VIACreative\SudoSu\ServiceProvider::class);
        }
    }
}
