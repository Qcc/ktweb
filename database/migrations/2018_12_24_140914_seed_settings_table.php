<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $seos = 
            [
                'key'        => 'side_advertising',
                'value'        => serialize([
                    [
                    'link'=>'http://ktweb.test/topics/26',
                    'img'=>'/images/side-1-image.png',
                    ],
                    [
                    'link'=>'http://ktweb.test/topics/26',
                    'img'=>'/images/side-1-image.png',
                    ],
                ]),
        ];

        DB::table('settings')->insert($seos);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')->truncate();
    }
}
