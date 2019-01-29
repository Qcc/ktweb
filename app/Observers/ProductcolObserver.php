<?php

namespace App\Observers;

use App\Models\Productcol;
use App\Jobs\TranslateProductcolSlug;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored
/**
 * 监听对应模型的事件，当事件触发时执行对应的方法
 */
class ProductcolObserver
{
     
    public function saved(Productcol $productcol)
    {
        //如slug字段无内容，即使用翻译对name进行翻译
        if(! $productcol->slug){
            //推送到队列执行，翻译标题填入slug SEO优化
            dispatch(new TranslateProductcolSlug($productcol));
        }
        
    }
}