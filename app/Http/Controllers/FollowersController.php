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
    public function store(User $user)
    {
        //用户未登录不能关注
        if(Auth::user()->id === $user->id){
            return redirect('/');
        }
        //用户未关注时才关注
        if(!Auth::user()->isFollowing($user->id)){
            Auth::user()->follow($user->id);
        }
        return redirect()->route('users.show',$user->id);
    }

    public function destroy(User $user)
    {
        if(Auth::user()->id === $user->id){
            return redirect('/');
        }
        if(Auth::user()->isFollowing($user->id)){
            Auth::user()->unfollow($user->id);
        }
        return redirect()->route('users.show',$user->id);
    }
}
