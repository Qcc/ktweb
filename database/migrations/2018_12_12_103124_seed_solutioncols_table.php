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
                'description' => '大规模个性化制造、网络协同制造、智慧工厂、智能生产、制造协同、智能制造解决方案',
                'banner' => '/images/solutions-banner.jpg',
                'icon' => '/images/gyzz1.png',
                'title' => '我们离智能制造有多远？'
            ],
            [
                'name'        => '电子行业解决方案',
                'description' => '电子行业解决方案，将供应链、生产制造、项目管控、财务核算与产品研发全生命周期管理有效集成',
                'banner' => '/images/solutions-banner.jpg',
                'icon' => '/images/dzsc1.png',
                'title' => '建设信息一体化管理平台'
            ],
            [
                'name'        => '食品行业解决方案',
                'description' => '食品行业解决方案，助力企业建立统一营销、供应链、生产，财务、核算平台，实现集团的统一管理',
                'banner' => '/images/solutions-banner.jpg',
                'icon' => '/images/spjg1.png',
                'title' => '方案特性'
            ],
            [
                'name'        => '日化行业解决方案',
                'description' => '日化行业管理的重点集中在产品品牌管理、应对互联网对渠道的冲击和高效的生产运营的管理三个方面，日化行业供应链解决方案是销售、物流、生产和供应相协作的统一整体，并在传统管理模式的基础上，支持统一运营电子商务平台，线上与第三方电商平台、自营平台的数据集成，线下与销售门店数据共享，全方位响应客户需求。',
                'banner' => '/images/solutions-banner.jpg',
                'icon' => '/images/rhsc1.png',
                'title' => '方案特性'
            ],
            [
                'name'        => '家具行业解决方案',
                'description' => '家具行业解决方案助力家具行业建立以市场和客户需求为导向，实现企业内外资源优化配置，实现物流、资金流、信息流的有机集成，提高客户满意度和快速拓展市场为目标的敏捷高效管理平台；打造门店和经销商体系、营销体系、供应链体系、生产体系、财务体系等一体化平台。',
                'banner' => '/images/solutions-banner.jpg',
                'icon' => '/images/gyzz1.png',
                'title' => '方案特性'
            ],
            [
                'name'        => '汽车经销及服务行业',
                'description' => '面向汽车经销及服务行业解决方案，能够帮助用户应对信息化管理，互联网+转型等挑战，实现汽车经销及服务行业：业务一体化、财务业务一体化和集团管控一体化的管理目标，以汽车ERP+云服务的创新业务模式，帮助传统车商提升企业竞争能力与综合盈利能力，打造O2O服务闭环，实现移动互联网转型。',
                'banner' => '/images/solutions-banner.jpg',
                'icon' => '/images/qcxs1.png',
                'title' => '致力于推进汽车产业+互联网进程'
            ],
            [
                'name'        => '餐饮行业解决方案',
                'description' => '为餐饮企业提供整合管理解决方案及服务。帮助企业建立从总部、区域、门店到最终消费者全价值链集中管控平台。“互联网+”新时代，金蝶将与您一道致力于提升餐饮企业品牌影响力，实施标准和精细化管控等诸多管理升级与转型。',
                'banner' => '/images/solutions-banner.jpg',
                'icon' => '/images/cyls1.png',
                'title' => '方案特性'
            ],
            [
                'name'        => '教育行业解决方案',
                'description' => '培训教育为全国院校提供丰富的实践实训教学体系、智慧校园方案等，打造“随手学+云认证+人才库”的O2O人才生态圈，培养出更符合市场需求的应用型、复合型、创新型的专业人才！目前，已与全国54个城市超1000余家院校及培训机构共建ERP实验室、综合实训基地、创新创业中心等。',
                'banner' => '/images/solutions-banner.jpg',
                'icon' => '/images/jy1.png',
                'title' => '打造智慧校园 创新实践教学模式 提供人才资质认证'
            ],
            [
                'name'        => '金蝶电商云',
                'description' => '电商ERP：专业化、智能化、一体化',
                'banner' => '/images/solutions-banner.jpg',
                'icon' => '/images/dzsw1.png',
                'title' => '面向各种需求的电商云核心商品'
            ],
            [
                'name'        => '全渠道零售',
                'description' => '华为、三星、OPPO、LG等分销门店管理的一致选择',
                'banner' => '/images/solutions-banner.jpg',
                'icon' => '/images/qqdxs1.png',
                'title' => '一切商机始于营销，全渠道营销的本质是洞察消费者'
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
