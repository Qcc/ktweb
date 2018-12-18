<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Log;
class User extends Authenticatable
{
    // 权限管理扩展 trait
    use HasRoles;
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
        Log::info('没有收到');
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    protected $fillable = [
        'name', 'nickname', 'email', 'phone', 'telephone', 'company', 'password','permission','avatar','introduction'
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
    /**
     * belongsToMany可以用来关联模型之间的多对多关系
     * $this->belongsToMany(User::Class); 用户关注和被关注是多对多关系
     * 在 Laravel 中会默认将两个关联模型的名称进行合并，并按照字母排序，
     * 因此生成的关联关系表名称会是 user_user。
     * 也可以自定义生成的名称，把关联表名改为 followers。
     * 除了自定义合并数据表的名称，我们也可以通过传递额外参数至 belongsToMany 
     * 方法来自定义数据表里的字段名称。如下
     * 最终如下
     * 通过 followers 来获取粉丝关系列表，
     * 如：$user->followers();
     */
    public function followers()
    {
        return $this->belongsToMany(User::Class,'followers','user_id','follower_id');
    }
    /**
     * 通过 followings 来获取用户关注人列表，如：
     * $user->followings();
     * belongsToMany 方法的第三个参数 user_id 是定义在关联中的模型外键名，
     * 而第四个参数 follower_id 则是要合并的模型外键名
     */
    public function followings()
    {
        return $this->belongsToMany(User::Class,'followers','follower_id','user_id');
    }

    /** 
     * 用户和粉丝模型进行了多对多关联之后，便可以使用 Eloquent 模型为多对多提供的一系列简便的方法。
     * 如使用 attach 方法或 sync 方法在中间表上创建一个多对多记录，使用 detach 方法在中间表上移除一个记录，
     * 创建和移除操作并不会影响到两个模型各自的数据，
     * 所有的数据变动都在 中间表 上进行。attach, sync, detach 这几个方法都允许传入 id 数组参数。
     * sync 方法会接收两个参数，第一个参数为要进行添加的 id，第二个参数则指明是否要移除其它不包含在关联的 id 数组中的 id，true 表示移除，
     * false 表示不移除，默认值为 true。
     * 由于我们在关注一个新用户的时候，仍然要保持之前已关注用户的关注关系，因此不能对其进行移除，所以在这里我们选用 false
     * 
     * 关注某个用户
     */
    public function follow($user_ids)
    {
        if(!is_array($user_ids)){
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids,false);
    }
    /** 
     * is_array 用于判断参数是否为数组，如果已经是数组，则没有必要再使用 compact 方法。
     * 我们并没有给 sync 和 detach 指定传递参数为用户的 id，这两个方法会自动获取数组中的 id。
     * 取消关注某个用户
     */
    public function unfollow($user_ids)
    {
        if(!is_array($user_ids)){
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }
    /**
     * 判断当前登录的用户 A 是否关注了用户 B，代码实现逻辑很简单，我们只需要判断用户 B 是否包含在用户 A 的关注人列表上即可。
     * 这里将用到 contains 方法来做判断。
     */
    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }
    
    /** 获取当前用户关注的文章列表 */
    public function topicFollowings()
    {
        return $this->belongsToMany(Topic::Class,'topicfollowers','user_id','topic_id');
    }
    /** 判断当前用户是否关注了文章 */
    public function isTopicFollowing($topic_ids)
    {
        return $this->topicFollowings->contains($topic_ids);
    }

    /** 关注文章 */
    public function topicFollow($topic_ids)
    {
        if(!is_array($topic_ids)){
            $topic_ids = compact('topic_ids');
        }
        $this->topicFollowings()->sync($topic_ids,false);
    }
    /** 
     * 
     * 取消关注文章
     */
    public function topicUnFollow($topic_ids)
    {
        if(!is_array($topic_ids)){
            $topic_ids = compact('topic_ids');
        }
        $this->topicFollowings()->detach($topic_ids);
    }
    /** 获取当前用户点赞的文章列表 */
    public function topicGreats()
    {
        return $this->belongsToMany(Topic::Class,'greattopics','user_id','topic_id');
    }
    /** 判断当前用户是否点赞了文章 */
    public function isTopicGreat($topic_ids)
    {
        return $this->topicGreats->contains($topic_ids);
    }

    /** 点赞文章 */
    public function topicGreat($topic_ids)
    {
        if(!is_array($topic_ids)){
            $topic_ids = compact('topic_ids');
        }
        $this->topicGreats()->sync($topic_ids,false);
    }
    /** 
     * 
     * 取消点赞文章
     */
    public function topicUnGreat($topic_ids)
    {
        if(!is_array($topic_ids)){
            $topic_ids = compact('topic_ids');
        }
        $this->topicGreats()->detach($topic_ids);
    }
    
}
