<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Auth;

class FollowersController extends Controller
{
    /** 关注或取消关注动作需要登录后操作 */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /** 添加关注 */
    public function store(Request $request)
    {
        $data = ['result'=>false,'msg'=>'关注失败!'];
        //用户未登录不能关注
        if(Auth::user()->id === $request->id){
            return $data;
        }
        //用户未关注时才关注
        if(!Auth::user()->isFollowing($request->id)){
            Auth::user()->follow($request->id);
            $data['result']= true;
            $data['result']= '关注成功！';
        }
        return $data;
    }

    public function destroy(Request $request)
    {
        $data = ['result'=>false,'msg'=>'取消关注失败!'];
        if(Auth::user()->id === $request->id){
            return $data; 
        }
        if(Auth::user()->isFollowing($request->id)){
            Auth::user()->unfollow($request->id);
            $data['result'] = true;
            $data['msg'] = '取消关注成功';
        }
        return $data;
    }
}
