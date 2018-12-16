<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration 
{
	public function up()
	{
		Schema::create('customers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index();
            $table->string('image');
            $table->string('name')->comment('公司');
            $table->string('icon')->nullable()->comment('图标');
            $table->string('banner')->nullable()->comment('banner图');
            $table->text('body');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('customercol_id')->unsigned()->index();
            $table->integer('productcol_id')->unsigned()->index();
            $table->integer('solutioncol_id')->unsigned()->index();
            $table->integer('order')->unsigned()->default(0);
            $table->text('excerpt')->nullable();
            $table->text('keywords')->comment('关键词');
            $table->string('slug')->nullable();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('customers');
	}
}
