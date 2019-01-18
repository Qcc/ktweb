<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedProductcolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $products = [
            [
                'name'        => 'CTBS高级版',
                'description' => '沟通科技CTBS高级版',
                'banner' => '/images/topics1.jpg',
                'title' => 'CTBS高级版'
            ],
            [
                'name'        => 'CTBS企业版',
                'description' => '沟通科技CTBS企业版',
                'banner' => '/images/topics2.jpg',
                'title' => 'CTBS企业版'
            ],
            [
                'name'        => '智慧桌面RAS',
                'description' => '沟通科技智慧桌面RAS',
                'banner' => '/images/topics1.jpg',
                'title' => '智慧桌面RAS'
            ],
            [
                'name'        => '金蝶云·星空',
                'description' => '金蝶云·星空',
                'banner' => '/images/topics2.jpg',
                'title' => '金蝶云·星空'
            ],
            [
                'name'        => '金蝶云·苍穹',
                'description' => '金蝶云·苍穹',
                'banner' => '/images/topics1.jpg',
                'title' => '金蝶云·苍穹'
            ],
            [
                'name'        => '精斗云',
                'description' => '精斗云',
                'banner' => '/images/topics2.jpg',
                'title' => '精斗云'
            ],
            [
                'name'        => '云之家',
                'description' => '云之家',
                'banner' => '/images/topics1.jpg',
                'title' => '云之家'
            ],
            [
                'name'        => '金蝶EAS',
                'description' => '金蝶EAS',
                'banner' => '/images/topics2.jpg',
                'title' => '金蝶EAS'
            ],
            [
                'name'        => '金蝶K3',
                'description' => '金蝶K3',
                'banner' => '/images/topics1.jpg',
                'title' => '金蝶K3'
            ],
            [
                'name'        => '金蝶KIS系列',
                'description' => '金蝶KIS系列',
                'banner' => '/images/topics2.jpg',
                'title' => '金蝶KIS系列'
            ],
        ];

        DB::table('productcols')->insert($products);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('productcols')->truncate();
    }
}
