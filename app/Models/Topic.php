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

    
}
