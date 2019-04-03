<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    /**
     * 当有发表回复时，话题回复数+1
     *
     * @param Reply $reply
     * @return void
     */
    public function created(Reply $reply)
    {
        $topic = $reply->topic;
        $followers = $topic->topicFollowers;
        $topic->increment('reply_count',1);

        /**
         * 通知作者
         * 调用 Notifications 类通知作者话题被回复了
         * 默认的 User 模型中使用了 trait —— Notifiable，它包含着一个可以用来发通知的方法 notify() ，
         * 此方法接收一个通知实例做参数。虽然 notify() 已经很方便，
         * 但是我们还需要对其进行定制，我们希望每一次在调用 $user->notify() 时，
         * 自动将 users 表里的 notification_count +1 ，这样我们就能跟踪用户未读通知了。
         * 修改User.php 模型文件，将 use Notifiable修改为定制方法;
         */
        $topic->user->notify(new TopicReplied($reply));
        // 通知话题关注者
        foreach ($followers as $user) {
            $user->notify(new TopicReplied($reply));
        }

        // 准备好关键词作关联，获取缓存的关键词
		$allKeywords =  [];
		$keys =  Redis::keys('keywords_*');
		foreach ($keys as $key) {
			array_push($allKeywords,Redis::get($key));
        }
        // 控制关键词数量不超过3个
        $count = 3;
        $content = $reply->content;
        // 是否有替换过关键词
        $flag = false;
        foreach ($allKeywords as $word) {
            if($count <= 0 ){
                break;
            }
            if(stripos($reply->content,$word)){
                $count--;
                $redis_key = md5($word);
                $url = Redis::get($redis_key);
                if($url){
                    $link = '<a href="'.$url.'" target="_blank" title="'.$word.'">'.$word.'</a>';
                    $content = str_replace($word, $link, $content);
                    $flag= true;
                }
            }
        }
        if($flag){
            //未来避免模型监控器死循环调用，使用DB类直接对数据库进行操作
            //任务中要避免使用 Eloquent 模型接口调用，如：create(), update(), save() 等操作。
            //否则会陷入调用死循环 —— 模型监控器分发任务，任务触发模型监控器，模型监控器再次分发任务，
            //任务再次触发模型监控器.... 死循环。在这种情况下，使用 DB 类直接对数据库进行操作即可。
            \DB::table('replies')->where('id', $reply->id)->update(['content' => $content]);
        }
    }
    /**
     * 过滤用户输入
     *
     * @param Reply $reply
     * @return void
     */
    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content,'user_topic_body');
    }
    /**
     * 回复删除后减去话题回复数
     *
     * @param Reply $reply
     * @return void
     */
    public function deleted(Reply $reply)
    {
        $reply->topic->decrement('reply_count', 1);
    }
}