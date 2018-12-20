<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Hash;
use Spatie\Permission\Models\Role;

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
    /**
     * 修改用户
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function userstore(Request $request, User $user)
    {
        $data = $request->all();
        if($request->password){
            $data['password'] = Hash::make($request->password);
        }
        $user = User::find($data['id']);
        $user->fill($data);
        if($data['activated'] == '1'){
            $user->activated = true;
        }else{
            $user->activated = false;
        }
        $user->save();
        $res = [
            'code'=>0,
            'msg'=>'用户信息修改成功！'
        ];
        return $res;
    }
    /**
     * 展示所有角色
     *
     * @param Role $role
     * @return void
     */
    public function roles(Role $role)
    {
        $roles = Role::paginate(10);
        return view('management.club.roles',compact('roles'));
    }
    /**
     * 展示拥有角色的用户
     *
     * @return void
     */
    public function roleusers(Request $request, Role $role){
        // 获取所有权限用户
        $users = User::role($request->id)->get(); 
        return $users;
    }
    /**
     * 获得角色所拥有的权限
     *
     * @param Request $request
     * @param Role $role
     * @return void
     */
    public function rolepermission(Request $request, Role $role){
        // 获取所有权限用户
        $role = Role::find($request->id);
        $permissions = $role->permissions;
        return $permissions;
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
