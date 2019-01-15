<?php

namespace App\Observers;

use App\Models\User;
use App\Jobs\SendActivedEmail;
use Illuminate\Support\Facades\Log;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function creating(User $user)
    {
        $user->nickname = hiddenPhone($user->phone);
        $user->activation_token = str_random(30);
    }

    public function updated(User $user)
    {
        if($user->temp_mail){
            //推送到队列执行，发送激活邮件
            dispatch(new SendActivedEmail($user));
        }
    }
}