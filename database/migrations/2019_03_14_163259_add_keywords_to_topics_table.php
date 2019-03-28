<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeywordsToTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->string('keywords')->nullable()->comment('关键字');
            $table->string('source')->unique()->nullable()->comment('来源');
            $table->string('last_reply_user')->nullable()->comment('最后者');
            $table->string('last_reply_time')->nullable()->comment('最后回复时间');
            $table->string('last_reply_content')->nullable()->comment('回复内容');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->dropColumn('keywords');
            $table->dropColumn('source');
            $table->dropColumn('last_reply_user');
            $table->dropColumn('last_reply_time');
            $table->dropColumn('last_reply_content');
        });
    }
}
