<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// 私信消息模型
class Message extends Model
{
    // 只允许用户修改content字段
    protected $fillable = ['content'];

    //一条消息只属于一个会话，属于反向一对一关系
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
    //一条消息发送者属于一个用户
    public function sendUser()
    {
        return $this->belongsTo(User::class,'send_id');
    }
    //一条消息接收者属于一个用户反向一对一关系
    public function receiveUser()
    {
        return $this->belongsTo(User::class,'receive_id');
    }
    
    // 参数 $params 允许附加 URL 参数的设定。
    // 跳转到消息位置
    public function link($params = [])
    {
        return route('message.conversation', array_merge([$this->conversation_id], $params));
    }
}
