<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowersTable extends Migration
{
    /**
     * 创建粉丝表，用户之间可以互相关注，关注后可以收到所关注用户的最新动态.
     * 创建粉丝表
     * 被关注的用户（user_id）和粉丝（follower_id），
     * 我们可以通过被关注用户（user_id）来获取到他所有的粉丝，
     * 也能通过一个粉丝（follower_id）来获取到他关注的所有用户
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->integer('follower_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followers');
    }
}
