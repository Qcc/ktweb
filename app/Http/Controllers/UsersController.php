<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Hash;
use Auth;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendActivedEmail;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show','confirmEmail']]);
    }    
    
    // 显示用户个人信息页面
    public function show(User $user){
        return view('users.show',compact('user'));
    }

    // 编辑用户个人资料页面
    public function edit(User $user){
        // 授权策略只能当前用户访问自己的编辑页面
        // App\Http\Controllers\Controller 控制器基类包含了 Laravel 的 AuthorizesRequests trait。此 trait 提供了 authorize 方法
        $this->authorize('update', $user);
        return view('users.edit',compact('user'));
    }

    //修改密码页面
    public function password(User $user){
        // 授权策略只能当前用户访问自己的编辑页面
        // App\Http\Controllers\Controller 控制器基类包含了 Laravel 的 AuthorizesRequests trait。此 trait 提供了 authorize 方法
        $this->authorize('update', $user);
        return view('users.password',compact('user'));
    }
    public function uppwd(Request $request, User $user){
        $this->authorize('update',$user);
        $this->validate($request, [
            'oldpassword' => 'bail|required|max:30',
            'password' => 'bail|required|confirmed|min:6|max:30',
        ]);
        $request->user()->fill([
            'password' => Hash::make($request->password)
        ])->save();
        return redirect()->route('users.password', $user->id)->with('success', '密码更新成功！');
    }
    // 更新用户
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $this->authorize('update', $user);
        $data = $request->all();
        if($request->avatar){
            // 保存图片并且裁剪宽度为362px
            $result = $uploader->save($request->avatar,'avatar',$user->id,362);
            if($result){
                $data['avatar'] = $result['path'];
            }
        }
        $user->update($data);
        if(isset($data['temp_mail'])){
            return redirect()->route('users.edit', $user->id)->with('success', '更新成功,已发送激活邮件到 '.$data['temp_mail'].'，激活后才能使用！');
        }else{
            return redirect()->route('users.edit', $user->id)->with('success', '个人资料更新成功！');
        }
    }

    //** 关注的人列表  */
    public function followings(User $user)
    {
        $users = $user->followings()->paginate(30);
        $title = '关注的人';
        return view('users.show_follow',compact('users','title'));
    }
    /** 粉丝列表 */
    public function followers(User $user)
    {
        $users = $user->followers()->paginate(30);
        $title = '粉丝';
        return view('users.show_follow',compact('users','title'));
    }

    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();
        $user->email = $user->temp_mail;
        $user->temp_mail = null ;
        $user->activation_token = null;
        $user->save();
        // Auth::login($user);
        session()->flash('success', '恭喜你，邮箱激活成功！');
        return redirect()->route('users.show', [$user]);
    }
    public function sendEmailConfirmationTo(Request $request)
    {
        $user = Auth::user();
        //推送到队列执行，发送激活邮件
        dispatch(new SendActivedEmail($user));
        return back()->with('success', '邮件发送成功，请注意查收!');
    }
    
}
