<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('columns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index()->comment('名称');
            $table->string('icon')->nullable()->comment('图标');
            $table->text('description')->nullable()->comment('描述');
            $table->boolean('directory')->default(false)->coment('是否有子分类录');
            $table->integer('parent')->nullable()->unsigned()->comment('所属目录');
            $table->integer('post_count')->default(0)->comment('帖子数');
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
        Schema::dropIfExists('columns');
    }
}
