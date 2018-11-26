<?php

namespace App\Models;

class Topic extends Model
{
    // 允许修改的字段
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];

    /**
     * 话题所属分类 属于一对一关系
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    /**
     * 话题作者 一对一关系
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //scope前缀为laravel本地作用域 
    // $topic = App\topic::WithOrder()->RecentReplied()->orderBy('created_at')->get();
    // 可以链式调用，调用时不需要加scope前缀
    public function scopeWithOrder($query,$order)
    {
        //不同排序使用不同的数据读取逻辑
        switch($order){
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }
        // 预防n+1问题
        return $query->with('user','category');
    }

    public function scopeRecentReplied($query)
    {
        // 当话题有新回复时，我们将编写逻辑来更新话题模型的 reply_count 属性，
        // 此时会自动触发框架对数据模型 updated_at 时间戳的更新
        return $query->orderBy('updated_at','desc');
    }

    public function scopeRecent($query)
    {
        //按照创建时间排序
        return $query->orderBy('created_at','desc');
    }
    
}
