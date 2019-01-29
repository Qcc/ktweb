<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedColumnsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $columns = [
            [
                'name'        => '沟通动态',
                'description' => '沟通科技公司动态',
                'slug' => 'Shenzhen-KouTon-technology-Co.,Ltd-news',
            ],
            [
                'name'        => '行业资讯',
                'description' => '企业管理软件行业资讯',
                'slug' => 'industry-news',
            ],
            [
                'name'        => '管理智库',
                'description' => '企业管理新闻资讯',
                'slug' => 'management-think-tank',
            ],
        ];

        DB::table('columns')->insert($columns);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('columns')->truncate();
    }
}
