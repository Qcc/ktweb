<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedSolutioncolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $solutions = [
            [
                'name'        => '工业制造',
                'description' => '工业制造',
                'banner' => '/images/topics1.jpg',
            ],
            [
                'name'        => '电子',
                'description' => '电子',
                'banner' => '/images/topics2.jpg',
            ],
            [
                'name'        => '食品',
                'description' => '食品',
                'banner' => '/images/topics1.jpg',
            ],
            [
                'name'        => '日化',
                'description' => '日化',
                'banner' => '/images/topics2.jpg',
            ],
            [
                'name'        => '家具',
                'description' => '家具',
                'banner' => '/images/topics1.jpg',
            ],
            [
                'name'        => '汽车经销',
                'description' => '汽车经销',
                'banner' => '/images/topics2.jpg',
            ],
            [
                'name'        => '餐饮连锁',
                'description' => '餐饮连锁',
                'banner' => '/images/topics1.jpg',
            ],
            [
                'name'        => '教育机构',
                'description' => '教育机构',
                'banner' => '/images/topics2.jpg',
            ],
            [
                'name'        => '财务服务',
                'description' => '财务服务',
                'banner' => '/images/topics1.jpg',
            ],
            [
                'name'        => '金融服务',
                'description' => '金融服务',
                'banner' => '/images/topics2.jpg',
            ],
            [
                'name'        => '电商企业',
                'description' => '电商企业',
                'banner' => '/images/topics1.jpg',
            ],
            [
                'name'        => '全渠道零售',
                'description' => '全渠道零售',
                'banner' => '/images/topics2.jpg',
            ],
            [
                'name'        => '政府部门',
                'description' => '政府部门',
                'banner' => '/images/topics1.jpg',
            ],
            [
                'name'        => '企事业单位',
                'description' => '企事业单位',
                'banner' => '/images/topics2.jpg',
            ],
        ];

        DB::table('solutioncols')->insert($solutions);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('solutioncols')->truncate();
    }
}
