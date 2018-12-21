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
        Permission::create(['name' => 'manage_club_contents','cn_name'=>'管理社区帖子']);
        Permission::create(['name' => 'club_recommend','cn_name'=>'社区推荐']);
        Permission::create(['name' => 'club_advertising','cn_name'=>'社区侧边广告']);
        Permission::create(['name' => 'web_advertising','cn_name'=>'主站广告']);
        Permission::create(['name' => 'web_recommend','cn_name'=>'主站推荐']);
        Permission::create(['name' => 'manage_users','cn_name'=>'用户管理']);
        Permission::create(['name' => 'manage_roles','cn_name'=>'权限管理']);
        Permission::create(['name' => 'send_kouton','cn_name'=>'发布沟通动态']);
        Permission::create(['name' => 'manage_kouton','cn_name'=>'管理沟通动态']);
        Permission::create(['name' => 'send_news','cn_name'=>'发布行业资讯']);
        Permission::create(['name' => 'manage_news','cn_name'=>'管理行业资讯']);
        Permission::create(['name' => 'send_manage','cn_name'=>'发布管理智库']);
        Permission::create(['name' => 'manage_manage','cn_name'=>'管理管理智库']);
        Permission::create(['name' => 'send_product','cn_name'=>'发布产品功能']);
        Permission::create(['name' => 'manage_product','cn_name'=>'管理产品功能']);
        Permission::create(['name' => 'send_solution','cn_name'=>'发布解决方案']);
        Permission::create(['name' => 'manage_solution','cn_name'=>'管理解决方案']);
        Permission::create(['name' => 'send_customer','cn_name'=>'发布客户案例']);
        Permission::create(['name' => 'manage_customer','cn_name'=>'管理客户案例']);
        Permission::create(['name' => 'manage_business','cn_name'=>'商机管理']);
        Permission::create(['name' => 'revice_business','cn_name'=>'商机收发']);
        Permission::create(['name' => 'manage_report','cn_name'=>'举报管理']);

        // 创建站长角色，并赋予权限
        $founder = Role::create(['name' => 'Webmaster','cn_name'=>'超级管理员']);
        $founder->givePermissionTo('manage_club_contents');
        $founder->givePermissionTo('club_recommend');
        $founder->givePermissionTo('club_advertising');
        $founder->givePermissionTo('web_advertising');
        $founder->givePermissionTo('web_recommend');
        $founder->givePermissionTo('manage_users');
        $founder->givePermissionTo('manage_roles');
        $founder->givePermissionTo('send_kouton');
        $founder->givePermissionTo('manage_kouton');
        $founder->givePermissionTo('send_news');
        $founder->givePermissionTo('manage_news');
        $founder->givePermissionTo('send_manage');
        $founder->givePermissionTo('manage_manage');
        $founder->givePermissionTo('send_product');
        $founder->givePermissionTo('manage_product');
        $founder->givePermissionTo('send_solution');
        $founder->givePermissionTo('manage_solution');
        $founder->givePermissionTo('send_customer');
        $founder->givePermissionTo('manage_customer');
        $founder->givePermissionTo('manage_business');
        $founder->givePermissionTo('revice_business');
        $founder->givePermissionTo('manage_report');

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
