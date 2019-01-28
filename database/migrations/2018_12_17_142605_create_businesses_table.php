<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('姓名');
            $table->string('phone')->comment('电话');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('company')->nullable()->comment('公司');
            $table->string('demand')->nullable()->comment('需求留言');
            $table->string('city')->nullable()->comment('城市');
            $table->string('type')->comment('类型');
            $table->integer('user_id')->unsigned()->nullable()->comment('回访人');
            $table->text('feedback')->nullable()->comment('反馈');
            $table->boolean('status')->default(false)->comment('状态');
            $table->string('active_token')->nullable()->comment('回访');
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
        Schema::dropIfExists('businesses');
    }
}
