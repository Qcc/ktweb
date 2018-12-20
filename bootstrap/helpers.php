<?php
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