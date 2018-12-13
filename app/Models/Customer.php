<?php

namespace App\Models;

class Customer extends Model
{
    protected $fillable = ['title', 'image', 'banner', 'body', 'user_id', 'customercol_id', 'productcol_id', 'solutioncol_id', 'order', 'excerpt', 'slug'];

    // 参数 $params 允许附加 URL 参数的设定。
    // 路由增加可选的翻译语句链接，可支持id和slug
    public function link($params = [])
    {
        return route('customer.show', array_merge([$this->id, $this->slug], $params));
    }

    /**
     * 产品分类
     *
     * @return void
     */
    public function customercol()
    {
        return $this->belongsTo(Customercol::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithOrder($query,$order)
    {
        //不同排序使用不同的数据读取逻辑
        switch($order){
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }
        // 预防n+1问题
        return $query->with('user','customercol');
    }

    public function scopeRecentReplied($query)
    {
        // 按照更新时间排序
        return $query->orderBy('updated_at','desc');
    }

    public function scopeRecent($query)
    {
        //按照创建时间排序
        return $query->orderBy('created_at','desc');
    }
}
