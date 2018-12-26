<?php

namespace App\Models;

class Customer extends Model
{
    protected $fillable = ['title', 'image','keywords', 'banner', 'body', 'name','user_id', 'customercol_id', 'productcol_id', 'solutioncol_id', 'order', 'excerpt', 'slug'];

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

    public function scopeWithOrder($query,$order,$particular)
    {
        //不同排序使用不同的数据读取逻辑
        switch($order){
            case 'industry':
                $query->Industry($particular);
                break;
            case 'profession':
                $query->Profession($particular);
                break;

            default:
                $query->Product($particular);
                break;
        }
        // 预防n+1问题
        return $query->with('user','customercol');
    }

    // 按产品查询
    public function scopeProduct($query,$particular)
    {
        if($particular){
            return $query->where('productcol_id',$particular);
        }else{
            return $query;
        }
    }

    // 按行业查询
    public function scopeIndustry($query,$particular)
    {
        if($particular){
            return $query->where('solutioncol_id',$particular);
        }else{
            return $query;
        }
    }
    // 按业务查询
    public function scopeProfession($query,$particular)
    {
        if($particular){
            return $query->where('customercol_id',$particular);
        }else{
            return $query;
        }
    }
}
