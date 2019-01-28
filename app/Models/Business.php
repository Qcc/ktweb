<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'name', 'phone','city','user_id','type','demand','email','company','comment','status','active_token'
    ];
    
    //一条消息发送者属于一个用户
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
