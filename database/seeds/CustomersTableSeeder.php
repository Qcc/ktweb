<?php

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\User;
use App\Models\Customercol;
use App\Models\Productcol;
use App\Models\Solutioncol;

class CustomersTableSeeder extends Seeder
{
    /**
     * 填充粉丝数据表.
     *
     * @return void
     */
    public function run()
    {
    // 所有用户 ID 数组，如：[1,2,3,4]
    $user_ids = User::all()->pluck('id')->toArray();

    // 所有分类 ID 数组，如：[1,2,3,4]
    $customercol_ids = Customercol::all()->pluck('id')->toArray();
    $productcol_ids = Productcol::all()->pluck('id')->toArray();
    $solutioncol_ids = Solutioncol::all()->pluck('id')->toArray();

    // 获取 Faker 实例
    $faker = app(Faker\Generator::class);

    $customers = factory(Customer::class)
                    ->times(100) //填充500 条话题数据
                    ->make()
                    ->each(function ($customer, $index)
                        use ($user_ids, $customercol_ids,$productcol_ids,$solutioncol_ids, $faker)
    {
        // 从用户 ID 数组中随机取出一个并赋值
        $customer->user_id = $faker->randomElement($user_ids);

        // 客户行业
        $customer->customercol_id = $faker->randomElement($customercol_ids);
        // 使用产品
        $customer->productcol_id = $faker->randomElement($productcol_ids);
        // 使用方案
        $customer->solutioncol_id = $faker->randomElement($solutioncol_ids);
    });

    // 将数据集合转换为数组，并插入到数据库中
    Customer::insert($customers->toArray());
    }

}

