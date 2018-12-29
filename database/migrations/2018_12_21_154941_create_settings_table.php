<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->string('banner');
            $table->string('link');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('icon1')->nullable();
            $table->string('icon_title1')->nullable();
            $table->string('icon_link1')->nullable();
            $table->string('icon2')->nullable();
            $table->string('icon_title2')->nullable();
            $table->string('icon_link2')->nullable();
            $table->string('icon3')->nullable();
            $table->string('icon_title3')->nullable();
            $table->string('icon_link3')->nullable();
            $table->string('icon4')->nullable();
            $table->string('icon_title4')->nullable();
            $table->string('icon_link4')->nullable();
            $table->string('icon5')->nullable();
            $table->string('icon_title5')->nullable();
            $table->string('icon_link5')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
