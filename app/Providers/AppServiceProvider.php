<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
		\App\Models\Solution::observe(\App\Observers\SolutionObserver::class);
		\App\Models\Conversation::observe(\App\Observers\ConversationObserver::class);
        Schema::defaultStringLength(191);
        \Carbon\Carbon::setLocale('zh');
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
