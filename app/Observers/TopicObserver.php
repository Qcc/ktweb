<?php

namespace App\Observers;

use App\Models\Topic;
use App\Jobs\TranslateSlug;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored
/**
 * 监听对应模型的事件，当事件触发时执行对应的方法
 */
class TopicObserver
{
    public function saving(Topic $topic)
    {
        // 配置文件config/purifier.php
        // 使用插件过来用户输入的内容
        $topic->body = clean($topic->body, 'user_topic_body');
        
        //excerpt 字段存储的是话题的摘录，将作为文章页面的 description 元标签使用
        //make_excerpt() 是自定义的辅助方法，我们需要在 helpers.php 文件中添加
        $topic->excerpt = make_excerpt($topic->body);
    }

    public function saved(Topic $topic)
    {
        //如slug字段无内容，即使用翻译对title进行翻译
        if(! $topic->slug){
            //不使用队列直接进行翻译，耗时任务
            // $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);

            //推送到队列执行
            dispatch(new TranslateSlug($topic));
        }
    }
    /**
     * 回复依赖话题 当话题删除时，同时删除话题下的所有回复
     * 模型监听器中，数据库操作需要避免再次 Eloquent 事件，所以这里使用了 DB 
     *
     * @param Topic $topic
     * @return void
     */
    public function deleted(Topic $topic)
    {
        \DB::table('replies')->where('topic_id', $topic->id)->delete();
    }
}