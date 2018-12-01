<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Topic;

/** 作者发布新的话题 作者的粉丝会收到通知 */
class TopicFollowing extends Notification
{
    use Queueable;
    public $topic;

    /**
     * 注入话题实体
     *
     * @return void
     */
    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * 最后的toDatabase方法接收$notifiable的实例参数并返回一个数组。 
     * 返回的数组会以json格式存储到notification表里的data字段中。
     * 在ktweb\resources\views\notifications\types\_topic_replied.blade.php. 中具体渲染
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        // 存入数据库里的数据
        return [
            'topic_id' => $this->topic->id,
            'topic_title' => $this->topic->title,
            'topic_excerpt' => $this->topic->excerpt,
            'user_id' => $this->topic->user->id,
            'user_username' => $this->topic->user->username,
            'user_avatar' => $this->topic->user->avatar,
            'topic_link' => $this->topic->link(),
            'topic_created_at' => $this->topic->created_at,
        ];
    }
}
