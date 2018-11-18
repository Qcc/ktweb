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
            $table->string('username')->nullable()->unique();
            $table->string('nickname')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->integer('permission');
            $table->string('activation_token')->nullable();
            $table->boolean('activated')->default(false);
            $table->boolean('mail_activated')->default(true);
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
