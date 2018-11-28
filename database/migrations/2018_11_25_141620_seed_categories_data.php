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
                'name'        => '精斗云',
                'description' => '精斗云',
            ],
            [
                'name'        => '金蝶ERP',
                'description' => '金蝶ERP',
            ],
            [
                'name'        => '其他',
                'description' => '其他',
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
