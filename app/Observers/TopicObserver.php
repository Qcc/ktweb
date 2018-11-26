<?php

namespace App\Observers;

use App\Models\Topic;

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
        $topic->body = clean($topic->body, 'user_topic_body');
        //excerpt 字段存储的是话题的摘录，将作为文章页面的 description 元标签使用
        //make_excerpt() 是自定义的辅助方法，我们需要在 helpers.php 文件中添加
        $topic->excerpt = make_excerpt($topic->body);
        // 使用插件过来用户输入的内容
    }
}