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
                'icon' =>'/images/club.jpg' ,
                'description' => 'CTBS企业版、CTBS高级版、云桌面RAS，沟通科技应用虚拟化系统',
            ],
            [
                'name'        => '金蝶云',
                'icon' =>'/images/club.jpg' ,
                'description' => '金蝶云苍穹、金蝶云星空企业数字化创新云服务平台',
            ],
            [
                'name'        => '精斗云',
                'icon' =>'/images/club.jpg' ,
                'description' => '管账、管货、管生意，陪您一起成长',
            ],
            [
                'name'        => '金蝶ERP',
                'icon' =>'/images/club.jpg' ,
                'description' => '金蝶EAS、金蝶K3 WISE、金蝶KIS系列中国小微企业云管理软件知名品牌',
            ],
            [
                'name'        => '其他',
                'icon' =>'/images/club.jpg' ,
                'description' => '深圳市沟通科技有限公司产品社区',
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
