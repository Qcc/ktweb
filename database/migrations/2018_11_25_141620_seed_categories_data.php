<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'name'        => '虚拟化',
                'description' => '沟通科技应用虚拟化系统',
            ],
            [
                'name'        => '金蝶云',
                'description' => '金蝶云',
            ],
            [
                'name'        => '金蝶ERP',
                'description' => '金蝶ERP',
            ],
            [
                'name'        => '公告',
                'description' => '沟通科技公告',
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
}
