<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customercol extends Model
{
    // 允许修改的字段
    protected $fillable = ['name', 'icon', 'title', 'banner', 'description', 'directory', 'parent','post_count'];
}
