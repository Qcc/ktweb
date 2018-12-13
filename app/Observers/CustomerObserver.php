<?php

namespace App\Observers;

use App\Models\Customer;
use App\Jobs\TranslateCustomerSlug;
// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class CustomerObserver
{
    public function creating(Customer $customer)
    {
        // 配置文件config/purifier.php
        // 使用插件过来用户输入的内容
        $customer->body = clean($customer->body, 'user_topic_body');
        
        //excerpt 字段存储的是话题的摘录，将作为文章页面的 description 元标签使用
        //make_excerpt() 是自定义的辅助方法，我们需要在 helpers.php 文件中添加
        $product->excerpt = make_excerpt($product->body);
    }

    public function updating(Customer $customer)
    {
        //如slug字段无内容，即使用翻译对title进行翻译
        if(! $customer->slug){
            //推送到队列执行，翻译标题填入slug SEO优化
            dispatch(new TranslateCustomerSlug($customer));
        }
    }
}