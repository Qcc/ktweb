<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReportNotice extends Notification
{
    use Queueable;
    public $report;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($report)
    {
        $this->report=$report;
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
                    ->subject('用户举报通知')
                    ->line('用户举报了'.$this->report['type'])
                    ->line($this->report['reason'].$this->report['other'])
                    ->action('查看举报内容', $this->report['link']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        // 存入数据库里的数据
        return [
            'report_type' => $this->report['type'],
            'report_reason' => $this->report['reason'],
            'report_other' => $this->report['other'],
            'report_link' => $this->report['link'],
        ];
    }
}
