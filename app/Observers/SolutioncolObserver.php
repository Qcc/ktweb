<?php

namespace App\Observers;

use App\Models\Solutioncol;
use App\Jobs\TranslateSolutioncolSlug;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored
/**
 * 监听对应模型的事件，当事件触发时执行对应的方法
 */
class SolutioncolObserver
{

    public function saved(Solutioncol $solutioncol)
    {
        //如slug字段无内容，即使用翻译对name进行翻译
        if(! $solutioncol->slug){
            //推送到队列执行，翻译标题填入slug SEO优化
            dispatch(new TranslateSolutioncolSlug($solutioncol));
        }
        
    }
}