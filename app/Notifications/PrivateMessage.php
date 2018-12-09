<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Message;
class PrivateMessage extends Notification
{
    use Queueable;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
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
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        $link = $this->message->link(['#msg' . $this->message->id]);

        // 存入数据库里的数据
        return [
            'message_id' => $this->message->id,
            'user_id' => $this->message->sendUser->id,
            'user_nickname' => $this->message->sendUser->nickname,
            'user_avatar' => $this->message->sendUser->avatar,
            'message_link' => $link,
            'message_content' => $this->message->content,
        ];
    }
}
