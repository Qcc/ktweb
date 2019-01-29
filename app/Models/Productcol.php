<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 产品分类
 */
class Productcol extends Model
{
    // 允许修改的字段
    protected $fillable = ['name', 'icon', 'title', 'banner', 'description', 'directory', 'parent','post_count','slug'];

    // 参数 $params 允许附加 URL 参数的设定。
    // 路由增加可选的翻译语句链接，可支持id和slug
    public function link($params = [])
    {
        return route('products.show', array_merge([$this->id, $this->slug], $params));
    }
    
}
