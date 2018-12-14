<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCustomercolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $customers = [
            [
                'name'        => '综合集团',
                'description' => '综合集团',
                'banner' => '/images/topics1.jpg',
                'title' => '这是一段产品标题，凑够二十五个字查看样式'
            ],
            [
                'name'        => '制造业',
                'description' => '制造业',
                'banner' => '/images/topics2.jpg',
                'title' => '这是一段产品标题，凑够二十五个字查看样式'
            ],
            [
                'name'        => '建筑房地产',
                'description' => '建筑房地产',
                'banner' => '/images/topics1.jpg',
                'title' => '这是一段产品标题，凑够二十五个字查看样式'
            ],
            [
                'name'        => '汽车配件',
                'description' => '汽车配件',
                'banner' => '/images/topics2.jpg',
                'title' => '这是一段产品标题，凑够二十五个字查看样式'
            ],
            [
                'name'        => '零售流通',
                'description' => '零售流通',
                'banner' => '/images/topics1.jpg',
                'title' => '这是一段产品标题，凑够二十五个字查看样式'
            ],
            [
                'name'        => '交通运输',
                'description' => '交通运输',
                'banner' => '/images/topics2.jpg',
                'title' => '这是一段产品标题，凑够二十五个字查看样式'
            ],
            [
                'name'        => '公共管理',
                'description' => '公共管理',
                'banner' => '/images/topics1.jpg',
                'title' => '这是一段产品标题，凑够二十五个字查看样式'
            ],
            [
                'name'        => '服务业',
                'description' => '服务业',
                'banner' => '/images/topics2.jpg',
                'title' => '这是一段产品标题，凑够二十五个字查看样式'
            ],
            [
                'name'        => '金融业',
                'description' => '金融业',
                'banner' => '/images/topics1.jpg',
                'title' => '这是一段产品标题，凑够二十五个字查看样式'
            ],
            [
                'name'        => '广电传媒',
                'description' => '广电传媒',
                'banner' => '/images/topics2.jpg',
                'title' => '这是一段产品标题，凑够二十五个字查看样式'
            ],
            [
                'name'        => '电子通讯',
                'description' => '电子通讯',
                'banner' => '/images/topics1.jpg',
                'title' => '这是一段产品标题，凑够二十五个字查看样式'
            ],
            [
                'name'        => '冶金采掘',
                'description' => '冶金采掘',
                'banner' => '/images/topics2.jpg',
                'title' => '这是一段产品标题，凑够二十五个字查看样式'
            ],
            [
                'name'        => '医药卫生',
                'description' => '医药卫生',
                'banner' => '/images/topics1.jpg',
                'title' => '这是一段产品标题，凑够二十五个字查看样式'
            ],
            [
                'name'        => '农业',
                'description' => '农业',
                'banner' => '/images/topics2.jpg',
                'title' => '这是一段产品标题，凑够二十五个字查看样式'
            ],
            [
                'name'        => '电力',
                'description' => '电力',
                'banner' => '/images/topics1.jpg',
                'title' => '这是一段产品标题，凑够二十五个字查看样式'
            ],
            [
                'name'        => '食品',
                'description' => '食品',
                'banner' => '/images/topics2.jpg',
                'title' => '这是一段产品标题，凑够二十五个字查看样式'
            ],
        ];

        DB::table('customercols')->insert($customers);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('customercols')->truncate();
    }
}
