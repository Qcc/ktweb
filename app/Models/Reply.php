<?php

namespace App\Models;

class Reply extends Model
{
    // 只允许用户修改content字段
    protected $fillable = ['content','great_count'];

    //一条回复只属于一个话题，属于一对一关系
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
    //一条回复对应一个回复作者 一对一关系
    public function user()
    {
        return $this->belongsTo(User::class);
    } 
    // 点赞回复的用户
    public function replyGreats()
    {
        return $this->belongsToMany(User::Class,'greatreplys','reply_id','user_id');
    }
}
