<?php

namespace App\Models;

/**
 * 主站新闻咨询栏目
 */
class Column extends Model
{

    // 参数 $params 允许附加 URL 参数的设定。
    // 路由增加可选的翻译语句链接，可支持id和slug
    public function link($params = [])
    {
        return route('columns.show', array_merge([$this->id, $this->slug], $params));
    }
}
