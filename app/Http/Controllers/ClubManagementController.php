<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Category;
use App\Models\Productcol;
use App\Models\Solutioncol;
use App\Models\Customercol;

class ClubManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }  
     /**
      * 默认社区类目
      *
      * @return void
      */
    public function column()
    {
        $categorys = Category::all();
        return view('management.column',compact('categorys'));
    }
    /**
     * 获取产品 解决方案 客户案例类名
     *
     * @return void
     */
    public function columns(Request $request)
    {
        // 获取分类失败
        $data = [
            'code'=>1,
            'msg'=>'获取分类失败'
        ];
        if($request->type == 'productcol'){
            $data = Productcol::all();
        }else if($request->type == 'solutioncol'){
            $data = Solutioncol::all();
        }else if($request->type == 'customercol'){
            $data = Customercol::all();
        }else if($request->type == 'seo'){
            $data = DB::table('seos')->get();
        }
        return $data;
    }
    public function system()
    {
        return view('management.system');
    }
    public function recommend()
    {
        return view('management.recommend');
    }
    public function webRecommend()
    {
        return view('management.web_recommend');
    }
    /**
     * 后台批量展示用户
     *
     * @return void
     */
    public function users(){
        $users = User::paginate(8);
        return view('management.users',compact('users'));
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
        return view('management.roles',compact('roles'));
    }
    /**
     * 展示所有权限
     *
     * @param Role $role
     * @return void
     */
    public function permissions(Permission $permission)
    {
        $permissions = Permission::all();
        return $permissions;
    }
    /**
     * 展示拥有角色的用户
     *
     * @return void
     */
    public function roleusers(Request $request, Role $role)
    {
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
    public function rolepermission(Request $request, Role $role)
    {
        // 获取所有角色拥有的所有权限
        $role = Role::find($request->id);
        $permissions = $role->permissions;
        return $permissions;
    }
    /**
     * 角色新增 删除
     *
     * @return void
     */
    public function roleedit()
    {

    }
    /**
     * 角色添加/删除用户，角色添加删除权限
     *
     * @return void
     */
    public function userandpermission(Request $request, Role $role, Permission $permission, User $user)
    {
        $data = [
            'code' => 1,
            'msg' => '操作失败！',
        ];
        $role = Role::find($request->roleid);
        if($request->type == 'user'){
            $user = User::find($request->userid);
            if($request->action == 'delete'){
                $user->removeRole($role);
                $data = [
                    'code' => 0,
                    'msg' => '移除用户成功！',
                ];
            }else if($request->action == 'add'){
                $user->assignRole($role);
                $data = [
                    'code' => 0,
                    'msg' => '添加用户成功！',
                ];
            }
        }else if($request->type == 'permission'){
            // 得到权限
            $permissions = $request->permissionid;
            if(is_array($permissions)){
                $permissions = array_keys($permissions);
            };
            $permission = Permission::find($permissions);
            if($request->action == 'delete'){
                $role->revokePermissionTo($permission);
                $data = [
                    'code' => 0,
                    'msg' => '移除权限成功！',
                ];
            }else if($request->action == 'add'){
                $role->givePermissionTo($permission);
                $data = [
                    'code' => 0,
                    'msg' => '添加权限成功！',
                ];
            }
        }
        return $data;
    }
    public function settings()
    {
        return view('management.settings');
    }
     
}
