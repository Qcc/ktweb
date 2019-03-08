<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemparticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temparticle', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category')->nullable()->comment('分类');
            $table->string('title')->index()->comment('标题');
            $table->text('body')->comment('正文');
            $table->text('content1')->nullable()->comment('回复1');
            $table->text('content2')->nullable()->comment('回复2');
            $table->text('content3')->nullable()->comment('回复3');
            $table->text('content4')->nullable()->comment('回复4');
            $table->text('content5')->nullable()->comment('回复5');
            $table->text('content6')->nullable()->comment('回复6');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temparticle');
    }
}
