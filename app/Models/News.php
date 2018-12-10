<?php

namespace App\Models;

class News extends Model
{
    // 允许修改的字段
    protected $fillable = ['title', 'body', 'column_id', 'excerpt', 'slug', 'keywords', 'image'];

    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'news';

    // 参数 $params 允许附加 URL 参数的设定。
    // 路由增加可选的翻译语句链接，可支持id和slug
    public function link($params = [])
    {
        return route('news.show', array_merge([$this->id, $this->slug], $params));
    }
}
