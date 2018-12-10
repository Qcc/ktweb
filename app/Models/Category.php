<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 社区板块类目
 */
class Category extends Model
{
    protected $fillable = [
        'name', 'description','icon','directory'
    ];
}
