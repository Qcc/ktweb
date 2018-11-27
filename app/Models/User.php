<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
class User extends Authenticatable
{
    /**
     * 默认的 User 模型中使用了 trait —— Notifiable，
     * 它包含着一个可以用来发通知的方法 notify() ，
     * 此方法接收一个通知实例做参数。虽然 notify() 已经很方便，但是我们还需要对其进行定制，
     * 我们希望每一次在调用 $user->notify() 时，自动将 users 表里的 notification_count +1 ，
     * 这样我们就能跟踪用户未读通知了
     * 以下语法是在引入一个trait时，将其中的一个方法 notify 起了一个别名 laravelNotify，这是因为下面又重新声明了一个 notify 方法，
     * 如果不起别名，那么原来的 notify 方法就被当前类中的 notify overwriten 了。这样，
     * 就可以在当前类中的 notify 方法中写一些 关于 通知的逻辑代码，然后再调用原来的 notify 方法(现在的laravelNotify) 来真正的发送通知！。
     * 将 use Notifiable; 修改为以下：
     */
    use Notifiable{
        notify as protected laravelNotify;
    }
    /**
     * 重写notify方法，跟踪消息读取情况
     * @param [type] $instance
     * @return void
     */
    public function notify($instance)
    {
        // 如果被通知的是当前用户，就取消通知。
        if($this->id == Auth::id()){
            return;
        }
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    protected $fillable = [
        'username', 'nickname', 'email', 'phone', 'password','permission','avatar','introduction'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    // 通过用户查询话题
    // 用户可以发表多个话题 为一对多关系
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    //一个用户可以有多条回复，一对多
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    // 判断是否为当前用户
    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }
    //清除已经查看过的通知消息
    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }
}
