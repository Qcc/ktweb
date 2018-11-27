<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NotificationsController extends Controller
{
    //查看通知需要登录
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 显示所有通知
    public function index()
    {
        //获取登录用户的所有通知,一次获取20条分页
        $notifications = Auth::user()->notifications()->paginate(20);
        // 标记为已读，未读数量清零
        Auth::User()->markAsRead();
        return view('notifications.index',compact('notifications'));
    }
}
