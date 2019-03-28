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
            $table->boolean('format')->default(false)->comment('状态');
            $table->string('source')->unique()->comment('来源');
            $table->string('category')->nullable()->comment('分类');
            $table->string('title')->index()->comment('标题');
            $table->text('body')->comment('正文');
            $table->text('reply1')->nullable()->comment('回复1');
            $table->text('reply2')->nullable()->comment('回复2');
            $table->text('reply3')->nullable()->comment('回复3');
            $table->text('reply4')->nullable()->comment('回复4');
            $table->text('reply5')->nullable()->comment('回复5');
            $table->text('reply6')->nullable()->comment('回复6');
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
