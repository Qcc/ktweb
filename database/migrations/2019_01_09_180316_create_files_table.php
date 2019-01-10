<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hash')->unique()->comment('文件哈希');
            $table->string('name')->comment('原名称');
            $table->string('size')->comment('大小');
            $table->string('save_name')->comment('保存名称');
            $table->string('path')->comment('路径');
            $table->string('suffix')->comment('后缀');
            $table->boolean('logined')->default(false)->comment('下载权限');
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
        Schema::dropIfExists('files');
    }
}
