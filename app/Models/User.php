<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

    // 判断是否为当前用户
    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }
}
