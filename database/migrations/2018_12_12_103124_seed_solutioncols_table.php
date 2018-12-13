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
            ],
            [
                'name'        => '电子',
                'description' => '电子',
            ],
            [
                'name'        => '食品',
                'description' => '食品',
            ],
            [
                'name'        => '日化',
                'description' => '日化',
            ],
            [
                'name'        => '家具',
                'description' => '家具',
            ],
            [
                'name'        => '汽车经销',
                'description' => '汽车经销',
            ],
            [
                'name'        => '餐饮连锁',
                'description' => '餐饮连锁',
            ],
            [
                'name'        => '教育机构',
                'description' => '教育机构',
            ],
            [
                'name'        => '财务服务',
                'description' => '财务服务',
            ],
            [
                'name'        => '金融服务',
                'description' => '金融服务',
            ],
            [
                'name'        => '电商企业',
                'description' => '电商企业',
            ],
            [
                'name'        => '全渠道零售',
                'description' => '全渠道零售',
            ],
            [
                'name'        => '政府部门',
                'description' => '政府部门',
            ],
            [
                'name'        => '企事业单位',
                'description' => '企事业单位',
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
