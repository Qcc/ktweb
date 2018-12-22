<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $seos = [
            [
                'city'        => '北京',
            ],
            [
                'city'        => '深圳',
            ],
            [
                'city'        => '广州',
            ],
            [
                'city'        => '上海',
            ],
        ];

        DB::table('seos')->insert($seos);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('seos')->truncate();
    }
}
