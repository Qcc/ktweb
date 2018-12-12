<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index()->comment('标题');
            $table->string('image')->comment('首图');
            $table->text('body')->comment('正文');
            $table->integer('user_id')->unsigned()->index()->comment('作者');
            $table->integer('productcol_id')->unsigned()->index()->comment('分类');
            $table->integer('order')->unsigned()->default(0)->comment('排序');
            $table->text('keywords')->comment('关键词');
            $table->text('excerpt')->nullable()->comment('摘要');
            $table->string('slug')->nullable()->comment('seo链接');
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
        Schema::dropIfExists('products');
    }
}
