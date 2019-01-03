<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use App\Models\Topic;
use App\Models\Reply;
use Auth;

class FollowersController extends Controller
{
    /** 关注或取消关注动作需要登录后操作 */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /** 添加关注 取消关注 粉丝 */
    public function followers(Request $request)
    {
        $data = ['result'=>false,'msg'=>'用户关注失败!'];
        //用户不能关注自己
        if(Auth::user()->id === $request->id){
            return $data;
        }
        //用户未关注时才关注
        if(!Auth::user()->isFollowing($request->id)){
            Auth::user()->follow($request->id);
            $data['result']= true;
            $data['msg']= '用户关注成功！';
        //用户关注后才能取消
        }else if(Auth::user()->isFollowing($request->id)){
            Auth::user()->unfollow($request->id);
            $data['result'] = false;
            $data['msg'] = '取消用户关注成功';
        }
        return $data;
    }
    /** 添加关注 取消关注 文章*/
    public function topicFollowers(Request $request)
    {
        $data = ['result'=>false,'msg'=>'文章关注失败!'];
        $topic = Topic::find($request->id);
        //用户未登录不能关注
        if(Auth::user()->id === $topic->user->id){
            return $data;
        }
        //用户未关注时才关注
        if(!Auth::user()->isTopicFollowing($topic->id)){
            Auth::user()->topicFollow($topic->id);
            $data['result']= true;
            $data['msg']= '文章关注成功！';
        //用户关注后才能取消
        }else if(Auth::user()->isTopicFollowing($topic->id)){
            Auth::user()->topicUnFollow($topic->id);
            $data['result'] = false;
            $data['msg'] = '取消文章关注成功';
        }
        return $data;
    }
    /** 点赞 取消点赞 文章 */
    public function topicGreats(Request $request)
    {
        $topic = Topic::find($request->id);
        //点赞时不更新updated_at时间戳
        $topic->timestamps = false;
        $data = ['result'=>false,'status' => false,'msg'=>'用户点赞失败!'];
        //用户不能给自己点赞
        // if(Auth::user()->id === $topic->id){
        //     return $data;
        // }
        //用户未点赞时才能点赞
        if(!Auth::user()->isTopicGreat($topic->id)){
            Auth::user()->topicGreat($topic->id);
            $topic->increment('great_count',1);
            // 当点攒数大于10时系统自动添加精华标志
            if($topic->great_count > 10){
                $topic->excellent = true;
				$topic->excellent_time = date("Y-m-d h:i:s",time());
				$topic->excellent_user = '系统自动';
				$topic->save();
            }
            $data['result']= true;
            $data['status']= true;
            $data['msg']= '用户点赞成功！';
        //用户关注后才能取消
        }else if(Auth::user()->isTopicGreat($topic->id)){
            Auth::user()->topicUnGreat($topic->id);
            $topic->decrement('great_count', 1);
            $data['result'] = true;
            $data['status'] = false;
            $data['msg'] = '取消用户点赞成功';
        }
        return $data;
    }
    /** 点赞 取消点赞 回复 */
    public function replyGreats(Request $request)
    {
        $reply = Reply::find($request->id);
        //点赞时不更新updated_at时间戳
        $reply->timestamps = false;
        $data = ['success'=>false,'action'=>'','msg'=>'用户点赞失败!'];
        //用户未点赞时才能点赞
        if(!Auth::user()->isReplyGreat($reply->id)){
            Auth::user()->replyGreat($reply->id);
            $reply->increment('great_count',1);
            $data['success']= true;
            $data['action']= 'add';
            $data['msg']= '用户点赞成功！';
        //用户关注后才能取消
        }else if(Auth::user()->isReplyGreat($reply->id)){
            Auth::user()->replyUnGreat($reply->id);
            $reply->decrement('great_count', 1);
            $data['success']= true;
            $data['action']= 'delete';
            $data['msg'] = '取消用户点赞成功';
        }
        $reply->timestamps = true;
        return $data;
    }
}
