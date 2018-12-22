<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 解决方案分类
 */
class Solutioncol extends Model
{
    // 允许修改的字段
    protected $fillable = ['name', 'icon', 'title', 'banner', 'description', 'directory', 'oarent','post_count'];
}
