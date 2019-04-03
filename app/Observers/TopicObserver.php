<?php

namespace App\Observers;

use App\Models\Topic;
use App\Jobs\TranslateSlug;
use App\Notifications\TopicFollowing;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored
/**
 * 监听对应模型的事件，当事件触发时执行对应的方法
 */
class TopicObserver
{
    public function created(Topic $topic)
    {
        $follows = $topic->user->followers;
        /**
         * 调用 Notifications 类通知作者话题被回复了
         * 默认的 User 模型中使用了 trait —— Notifiable，它包含着一个可以用来发通知的方法 notify() ，
         * 此方法接收一个通知实例做参数。虽然 notify() 已经很方便，
         * 但是我们还需要对其进行定制，我们希望每一次在调用 $user->notify() 时，
         * 自动将 users 表里的 notification_count +1 ，这样我们就能跟踪用户未读通知了。
         * 修改User.php 模型文件，将 use Notifiable修改为定制方法;
         * 通知作者的所有粉丝 发表了新的话题
         */
        foreach ($follows as $user) {
            // Log::info('user ',dd($user));
            $user->notify(new TopicFollowing($topic));
        }
    }
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

            //推送到队列执行，翻译标题填入slug SEO优化
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