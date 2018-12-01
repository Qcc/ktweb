<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
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
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
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
    
}
