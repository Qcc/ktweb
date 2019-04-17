<?php
use Illuminate\Support\Facades\Redis;

/**
 * 根据页面链接生成类名，自定义样式 function
 *
 * @return void
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}
/**
 * 隐藏电话号码，星号显示
 *
 * @param String $phone
 * @return void
 */
function hiddenPhone(String $phone){
    $start = substr($phone, 0, 3);
    $end = substr($phone, 7, 11);
    return $start.'**'.$end;
}

/**
 * 从文章中截取200个字符作为文章摘要
 *
 * @param [type] $value
 * @param integer $length
 * @return void
 */
function make_excerpt($value, $length = 180)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return str_limit($excerpt, $length);
}

/**
 * 按符号截取字符串的指定部分
 * @param string $str 需要截取的字符串
 * @param string $sign 需要截取的符号
 * @param int $number 如是正数以0为起点从左向右截  负数则从右向左截
 * @return string 返回截取的内容
 */
function cut_str($str,$sign,$number)
{
    $array=explode($sign, $str);
    $length=count($array);
    if($number<0){
        $new_array=array_reverse($array);
        $abs_number=abs($number);
        if($abs_number>$length){
            return null;
        }else{
            return $new_array[$abs_number-1];
        }
    }else{
        if($number>=$length){
            return null;
        }else{
            return $array[$number];
        }
    }
}

/**
 *  更新社区置顶文章缓存
 *
 * @return void
 */
function updateTopCache($topic)
{
    // 如果文章是置顶文章，更新缓存
	if(Redis::exists('topic_'.$topic->category->id.'_'.$topic->id)){
		// 缓存过期时间
		$ttl = Redis::ttl('topic_'.$topic->category->id.'_'.$topic->id);
		if($ttl < 0){
			Redis::set('topic_'.$topic->category->id.'_'.$topic->id,serialize($topic));
		}else{
			Redis::setex('topic_'.$topic->category->id.'_'.$topic->id,$ttl,serialize($topic));
		}
	}
}



/**
 * 批量发布社区文章 类目重新分类
 *
 * @param [type] $category
 * @return void
 */
function getCategory($category)
    {
        switch ($category) {
            case '旗舰版':
            case '专业版':
            case '商贸版':
            case '标准/迷你版':
            case '行政事业版':
            case '账务平台':
            case '云产品':
            case 'EAS':
            case 'BOS':
            case 'K/3 WISE':
                return 4;
                break;
            case '金蝶云·星空':
            case '金蝶云·苍穹':
            case 'C-ERP':
            case 'OMS':
            case 'WMS':
            case 'E店管家':
                return 2;
                break;
            case '云进销存':
            case '云临售':
            case '云会计':
            case '云报销':
            case 'APP':
            case '工作台':
            case '开放平台':
            case '1688E经经':
            return 3;
                break;
            case '虚拟化':
                return 1;
                break;
            default:
                return 5;
                break;
        }
    }