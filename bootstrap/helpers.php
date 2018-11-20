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