<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->nullable()->comment('真实姓名');
            $table->string('nickname')->nullable()->unique()->comment('昵称');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->unique()->comment('手机');
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('company')->nullable();
            $table->string('telephone')->nullable()->comment('座机');
            $table->string('introduction')->nullable()->comment('简介');
            $table->string('activation_token')->nullable()->comment('找回密码');
            $table->boolean('activated')->default(true)->comment('用户状态');
            $table->boolean('mail_activated')->default(false)->comment('邮箱激活');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    // App\Models\User::create(['username'=> 'kevin','nickname'=> 'kk','email'=>'kevin@kouton.com','phone'=>'15889730027','password'=>bcrypt('password'),'permission'=>1000])

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
