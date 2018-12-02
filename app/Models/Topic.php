<?php

namespace App\Models;

class Topic extends Model
{
    // 允许修改的字段
    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];

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

    //一个话题可以有多条回复，一对多
    public function replies()
    {
        return $this->hasMany(Reply::class);
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

    // 参数 $params 允许附加 URL 参数的设定。
    // 路由增加可选的翻译语句链接，可支持id和slug
    public function link($params = [])
    {
        return route('topics.show', array_merge([$this->id, $this->slug], $params));
    }

    /** 获取关注当前文章的用户列表 */
    public function topicFollowers()
    {
        return $this->belongsToMany(User::Class,'topicfollowers','topic_id','user_id');
    }
    
}
