<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
		 \App\Models\Customer::class => \App\Policies\CustomerPolicy::class,
		 \App\Models\Reply::class => \App\Policies\ReplyPolicy::class,
		 \App\Models\Topic::class => \App\Policies\TopicPolicy::class,
		 \App\Models\News::class => \App\Policies\NewsPolicy::class,
		 \App\Models\Product::class => \App\Policies\ProductPolicy::class,
		 \App\Models\Solution::class => \App\Policies\SolutionPolicy::class,
		 \App\Models\Business::class => \App\Policies\BusinessPolicy::class,
        'App\Model' => 'App\Policies\ModelPolicy',
        \App\Models\User::class  => \App\Policies\UserPolicy::class,
        \App\Models\Conversation::class  => \App\Policies\ConversationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
