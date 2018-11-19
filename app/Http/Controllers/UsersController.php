<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
class UsersController extends Controller
{
    // 显示所有用户
    public function index(){

    }
    // 显示用户个人信息页面
    public function show(User $user){
        return view('wwwlayouts.users.show',compact('user'));
    }
    // 创建用户页面
    public function create(){
        return view('wwwlayouts.users.register');
    }
    // 创建用户
    public function store(Request $request){
        $this->validate($request, [
            'phone' => 'required|max:11',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收。');
        return redirect('/');
    }
    // 编辑用户个人资料页面
    public function edit(){

    }
    // 更新用户
    public function update(){

    }
    // 删除用户
    public function destroy(){

    }
}
