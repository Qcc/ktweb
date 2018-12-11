<?php

namespace App\Observers;

use App\Models\News;
use App\Jobs\TranslateNewsSlug;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored
/**
 * 监听对应模型的事件，当事件触发时执行对应的方法
 */
class NewsObserver
{
    public function saving(News $news)
    {
        // 配置文件config/purifier.php
        // 使用插件过来用户输入的内容
        $news->body = clean($news->body, 'user_topic_body');
        
        //excerpt 字段存储的是话题的摘录，将作为文章页面的 description 元标签使用
        //make_excerpt() 是自定义的辅助方法，我们需要在 helpers.php 文件中添加
        $news->excerpt = make_excerpt($news->body);
    }

    public function saved(News $news)
    {
        //如slug字段无内容，即使用翻译对title进行翻译
        if(! $news->slug){
            //不使用队列直接进行翻译，耗时任务
            // $news->slug = app(SlugTranslateHandler::class)->translate($news->title);

            //推送到队列执行，翻译标题填入slug SEO优化
            dispatch(new TranslateNewsSlug($news));
        }
        
    }
}