<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

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
    public function message(Conversation $conversation)
    {
        $user = Auth::user();
        $conversations = $conversation->where('send_id',$user->id)
                        ->orWhere('receive_id',$user->id)->get();
        return view('notifications.message',compact('conversations'));
    }
    // 向用户发送私信私信
    public function sendtouser(User $user,Request $request)
    {
        $auth = Auth::user();
        $conversation = Conversation::where('conversation',$auth->id + $user->id)->first();
        if(collect($conversation)->isEmpty()){
            return view('notifications.send_to_user',compact('user','conversation'));
        }else{
            return redirect()->route('message.conversation',$conversation->id);
        }
         
    }
    public function conversation(Conversation $conversation)
    {
        $this->authorize('view', $conversation);
        $user = Auth::user();
        if($conversation->sendUser->id !== $user->id){
            $user = $conversation->sendUser;
            return view('notifications.send_to_user',compact('user','conversation'));
        }else if($conversation->receiveUser->id !== $user->id){
            $user = $conversation->receiveUser;
            return view('notifications.send_to_user',compact('user','conversation'));
        }
    }
    // 生成消息
    public function sendmessage(Request $request, User $user,Message $message)
    {
        $auth = Auth::user();
        $unique_id = $auth->id + $user->id;
        $conversation = Conversation::firstOrCreate(
            ['conversation'=>$unique_id],
            ['send_id' => $auth->id,
            'receive_id' => $user->id,
            'content' => $request->message]
        );
        $message->conversation_id = $conversation->id;
        $message->conversation = $unique_id;
        $message->send_id = $auth->id;
        $message->receive_id = $user->id;
        $message->content = $request->message;
        $message->save();
        
        return redirect()->route('message.conversation',$conversation->id)->with('success', '发送成功！');
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

    public function destroy(Request $request)
	{
        $data = ['success'=>false,'msg'=>'删除通知失败!'];
        $notification = \DB::table('notifications')->where('id',$request->notice)->delete();
        if($notification == 1){
            $data = ['success'=>true,'msg'=>'删除通知成功!'];
        }
		return $data;
	}
}
