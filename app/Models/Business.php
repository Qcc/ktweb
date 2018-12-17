<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'name', 'phone','city','user_id','comment','status','active_token'
    ];
    
}
