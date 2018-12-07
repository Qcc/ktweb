<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class NotificationsController extends Controller
{
    //查看通知需要登录
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 显示所有通知
    public function notifications()
    {
        //获取登录用户的所有通知,一次获取20条分页
        $notifications = Auth::user()->notifications()
            ->paginate(20);
        // 标记为已读，未读数量清零
        Auth::User()->markAsRead();
        return view('notifications.notifications',compact('notifications'));
    }
    // 显示所有私信
    public function message()
    {
        //获取登录用户的所有通知,一次获取20条分页
        $notifications = Auth::user()->notifications()
            ->paginate(20);
        // 标记为已读，未读数量清零
        Auth::User()->markAsRead();
        return view('notifications.message',compact('notifications'));
    }
    // 向用户发送私信私信
    public function sendtouser(User $user)
    {
        return view('notifications.send_to_user',compact('user'));
    }
    // 生成消息
    public function sendmessage(Request $request, User $user)
    {
        return view('notifications.send_to_user',compact('user'));
    }
    // 显示所有系统消息
    public function system()
    {
        //获取登录用户的所有通知,一次获取20条分页
        $notifications = Auth::user()->notifications()->paginate(20);
        // 标记为已读，未读数量清零
        Auth::User()->markAsRead();
        return view('notifications.system',compact('notifications'));
    }
}
