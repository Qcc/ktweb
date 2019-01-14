<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    use Queueable;
    public $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('重置密码-沟通科技')
                    ->line('我们收到了您的重置密码申请。')
                    ->action('重置密码', url(config('app.url').route('password.reset', $this->token, false)))
                    ->line('如果这不是您本人操作，您可以不必进行进一步操作!');
    }
    public function toDatabase($notifiable)
    {
        // 存入数据库里的数据
        return [
            'tips' => '我们收到了您重置密申请，如果不是您本人操作请勿理会。',
            'link' => url(config('app.url').route('password.reset', $this->token, false))
        ];
    }
 
}
