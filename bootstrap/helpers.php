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