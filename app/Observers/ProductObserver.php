<?php

namespace App\Observers;

use App\Models\Product;
use App\Jobs\TranslateProductSlug;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored
/**
 * 监听对应模型的事件，当事件触发时执行对应的方法
 */
class ProductObserver
{
    public function saving(Product $product)
    {
        // 配置文件config/purifier.php
        // 使用插件过来用户输入的内容
        $product->body = clean($product->body, 'user_topic_body');
        $product->point = clean($product->point, 'user_topic_body');
        
        //excerpt 字段存储的是话题的摘录，将作为文章页面的 description 元标签使用
        //make_excerpt() 是自定义的辅助方法，我们需要在 helpers.php 文件中添加
        $product->excerpt = make_excerpt($product->body);
    }

    public function saved(Product $product)
    {
        //如slug字段无内容，即使用翻译对title进行翻译
        if(! $product->slug){
            //推送到队列执行，翻译标题填入slug SEO优化
            dispatch(new TranslateProductSlug($product));
        }
        
    }
}