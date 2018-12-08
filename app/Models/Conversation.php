<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// 私信会话模型
class Conversation extends Model
{
    // 只允许用户修改content字段
    protected $fillable = ['conversation','send_id','receive_id','content'];
    // 一个聊天可以有多次聊天记录
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    //一次会话发送者属于一个用户
    public function sendUser()
    {
        return $this->belongsTo(User::class,'send_id');
    }
    //一次会话接收者属于一个用户反向一对一关系
    public function receiveUser()
    {
        return $this->belongsTo(User::class,'receive_id');
    }
}
