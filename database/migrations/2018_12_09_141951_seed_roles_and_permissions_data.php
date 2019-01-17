<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SeedRolesAndPermissionsData extends Migration
{
    /**
     * 初始化权限系统.
     *
     * @return void
     */
    public function up()
    {
        // 清除缓存
        app()['cache']->forget('spatie.permission.cache');

        // 先创建权限
        Permission::create(['name' => 'manage_contents','cn_name'=>'管理社区帖子']);

        Permission::create(['name' => 'web_manage','cn_name'=>'网站管理']);
        Permission::create(['name' => 'manage_users','cn_name'=>'用户管理']);
        Permission::create(['name' => 'manage_roles','cn_name'=>'权限管理']);
        Permission::create(['name' => 'manage_business','cn_name'=>'商机管理']);
        Permission::create(['name' => 'upload_files','cn_name'=>'上传附件']);
        Permission::create(['name' => 'revice_business','cn_name'=>'商机收发']);
        Permission::create(['name' => 'manage_report','cn_name'=>'举报管理']);
        Permission::create(['name' => 'employee_identity','cn_name'=>'员工身份']);
        Permission::create(['name' => 'customer_identity','cn_name'=>'客户身份']);
        Permission::create(['name' => 'parnter_identity','cn_name'=>'代理商身份']);

        // 创建站长角色，并赋予权限
        $founder = Role::create(['name' => 'Webmaster','cn_name'=>'超级管理员']);
        $founder->givePermissionTo('manage_contents');
        $founder->givePermissionTo('web_manage');
        $founder->givePermissionTo('manage_users');
        $founder->givePermissionTo('manage_roles');
        $founder->givePermissionTo('manage_business');
        $founder->givePermissionTo('revice_business');
        $founder->givePermissionTo('manage_report');
        $founder->givePermissionTo('upload_files');
        $founder->givePermissionTo('employee_identity');

        // 创建员工角色，并赋予权限
        $employee = Role::create(['name' => 'Employee','cn_name'=>'员工']);
        $employee->givePermissionTo('employee_identity');
        // 创建客户角色，并赋予权限
        $customer = Role::create(['name' => 'Customer','cn_name'=>'客户']);
        $customer->givePermissionTo('customer_identity');
        // 创建代理商角色，并赋予权限
        $parnter = Role::create(['name' => 'Parnter','cn_name'=>'代理商']);
        $parnter->givePermissionTo('parnter_identity');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 清除缓存
        app()['cache']->forget('spatie.permission.cache');

        // 清空所有数据表数据
        $tableNames = config('permission.table_names');

        Model::unguard();
        DB::table($tableNames['role_has_permissions'])->delete();
        DB::table($tableNames['model_has_roles'])->delete();
        DB::table($tableNames['model_has_permissions'])->delete();
        DB::table($tableNames['roles'])->delete();
        DB::table($tableNames['permissions'])->delete();
        Model::reguard();
    }
}
