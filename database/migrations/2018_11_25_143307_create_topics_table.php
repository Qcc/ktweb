<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration 
{
	public function up()
	{
		Schema::create('topics', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index()->comment('标题');
            $table->text('body')->comment('正文');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index()->comment('栏目');
            $table->integer('reply_count')->unsigned()->default(0)->comment('回复数');
            $table->integer('view_count')->unsigned()->default(0)->comment('阅读数');
            $table->integer('great_count')->unsigned()->default(0)->comment('点赞数');
            $table->boolean('excellent')->default(false)->comment('精华标志');
            $table->dateTime('excellent_time')->nullable()->comment('加精时间');
            $table->string('excellent_user')->nullable()->comment('加精人');
            $table->boolean('topping')->default(false)->comment('置顶标志');
            $table->string('topping_user')->nullable()->comment('置顶人');
            $table->dateTime('top_expired')->nullable()->comment('置顶过期');
            $table->integer('last_reply_user_id')->unsigned()->default(0)->comment('最后回复');
            $table->integer('order')->unsigned()->default(0)->comment('排序');
            $table->text('excerpt')->nullable()->comment('摘要');
            $table->string('slug')->nullable()->comment('seo链接');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('topics');
	}
}
