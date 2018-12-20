<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Hash;

class ClubManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }  
     
    public function system()
    {
        return view('management.club.system');
    }
    public function recommend()
    {
        return view('management.club.recommend');
    }
    /**
     * 后台批量展示用户
     *
     * @return void
     */
    public function users(){
        $users = User::paginate(8);
        return view('management.club.users',compact('users'));
    }

    public function userstore(Request $request, User $user)
    {
        $data = $request->all();
        if($request->password){
            $data['password'] = Hash::make($request->password);
        }
        $user = User::find($data['id']);
        $user->fill($data);
        $user->save();
        $res = [
            'code'=>0,
            'msg'=>'用户信息修改成功！'
        ];
        return $res;
    }
    public function roles()
    {
        return view('management.club.roles');
    }
    public function settings()
    {
        return view('management.club.settings');
    }
     
    public function articles()
    {
        return view('management.club.articles');
    }
    public function replys()
    {
        return view('management.club.replys');
    }
}
