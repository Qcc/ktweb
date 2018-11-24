<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
    // 显示所有用户
    public function index(){

    }
    // 显示用户个人信息页面
    public function show(User $user){
        return view('users.show',compact('user'));
    }

    // 编辑用户个人资料页面
    public function edit(User $user){
        return view('users.edit',compact('user'));
    }
    // 更新用户
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
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
    
}
