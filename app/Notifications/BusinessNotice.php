<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Business;
use Spatie\Permission\Models\Permission;

class BusinessNotice extends Notification implements ShouldQueue
{
    use Queueable;

    public $business;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Business $business)
    {
        $this->business = $business;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        $link = route('business.check',$this->business->active_token);

        // 存入数据库里的数据
        return [
            'business_id' => $this->business->id,
            'business_name' => $this->business->name,
            'business_phone' => $this->business->phone,
            'business_city' => $this->business->city,
            'business_type' => $this->business->type,
            'business_comment' => $this->business->comment,
            'business_status' => $this->business->status,
            'business_user_id' => $this->business->user_id,
            'business_link' => $link,
        ];
    }

    public function toMail($notifiable)
    {
        $url = route('business.check',$this->business->active_token);
        return (new MailMessage)
                    ->subject('商机通知')
                    ->line('你的新的商机申请，请在30分钟内联系客户！')
                    ->action('查看商机', $url);
    }
}
