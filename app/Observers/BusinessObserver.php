<?php

namespace App\Observers;

use App\Models\Business;
use App\Models\User;
use App\Notifications\BusinessNotice;
// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored
/**
 * 监听对应模型的事件，当事件触发时执行对应的方法
 */
class BusinessObserver
{
     

    public function creating(Business $business)
    {
        //生成随机访问链接
        $business->active_token = str_random(30);
        
    }

    public function created(Business $business)
    {
        // $user = User::find(1);
        $users = User::permission('revice_business')->get();
        //通知用户有新的商机需要联系
        foreach ($users as $key => $user) {
			//通知用户有新的商机需要联系
            $user->notify(new BusinessNotice($business));
		}
    }
}