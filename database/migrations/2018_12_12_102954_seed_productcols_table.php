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
                'description' => '累计超过5000+企业使用CTBS高级版应用虚拟化平台发布应用',
                'banner' => '/images/topics2.png',             
                'icon' => '/images/ctbs_advance.png',
                'title' => '高并发、高可用、原生安全的应用虚拟化接入平台'
            ],
            [
                'name'        => 'CTBS企业版',
                'description' => 'Windows软件无需任何修改，发布即可跨平台使用支持移动端',
                'banner' => '/images/topics2.png',                 
                'icon' => '/images/enterprise.png',
                'title' => '集团应用虚拟化解决方案，支持大并发复杂业务应用发布'
            ],
            [
                'name'        => '智慧桌面RAS',
                'description' => '非常便捷的应用虚拟化平台，一键部署一键发布支持云服务器',
                'banner' => '/images/topics2.png',                 
                'icon' => '/images/cloud-desk.png',
                'title' => '小微企业应用虚拟化法宝，节约IT成本，简洁一键部署'
            ],
            [
                'name'        => '金蝶云·星空',
                'description' => '成长型企业数字化创新云服务平台',
                'banner' => '/images/topics2.png',                 
                'icon' => '/images/start.png',
                'title' => '企业上云，大势所趋'
            ],
            [
                'name'        => '金蝶云·苍穹',
                'description' => '新一代大企业云服务平台',
                'banner' => '/images/topics2.png',                 
                'icon' => '/images/cangqiong.png',
                'title' => '中国自主可控和基于云原生架构的企业级云服务平台'
            ],
            [
                'name'        => '精斗云',
                'description' => '小微企业一站式云服务平台 管账、管货、管生意！',
                'banner' => '/images/topics2.png',                 
                'icon' => '/images/jdy-2.png',
                'title' => '面向各种需求的精斗云应用'
            ],
            [
                'name'        => '云之家',
                'description' => 'IDC数据显示：金蝶云之家连续三年大中型企业社交化移动办公软件市场占有率第一',
                'banner' => '/images/topics2.png',                 
                'icon' => '/images/cloudhome.png',
                'title' => '云之家 一站式智能协同办公平台'
            ],
            [
                'name'        => '金蝶EAS',
                'description' => '双模驱动，引领集团企业数字化转型',
                'banner' => '/images/topics2.png',                 
                'icon' => '/images/eas-1.png',
                'title' => '集团型企业如何保持可持续增长'
            ],
            [
                'name'        => '金蝶K3 WISE',
                'description' => '云服务、ERP、物联网，构建企业工业互联网与数字化管理平台',
                'banner' => '/images/topics2.png',                 
                'icon' => '/images/k3wise-1.png',
                'title' => '完整支撑成长型企业业务应用的数字化管理平台'
            ],
            [
                'name'        => '金蝶KIS系列',
                'description' => '中国小微企业云管理软件知名品牌',
                'banner' => '/images/topics2.png',                 
                'icon' => '/images/kis-1.png',
                'title' => '小企业管理+移动互联网'
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
