<?php

use Illuminate\Database\Seeder;
use App\Models\Solutioncol;
use App\Models\Productcol;
use App\Models\User;
use App\Models\Solution;

class SolutionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 所有用户 ID 数组，如：[1,2,3,4]
        $user_ids = User::all()->pluck('id')->toArray();

        // 所有分类 ID 数组，如：[1,2,3,4]
        $solutioncol_ids = Solutioncol::all()->pluck('id')->toArray();
        $productcol_ids = Productcol::all()->pluck('id')->toArray();

        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        $solutions = factory(Solution::class)
                        ->times(500) //填充500 条话题数据
                        ->make()
                        ->each(function ($solution, $index)
                            use ($user_ids, $solutioncol_ids,$productcol_ids, $faker)
        {
            // 从用户 ID 数组中随机取出一个并赋值
            $solution->user_id = $faker->randomElement($user_ids);

            // 话题分类，同上
            $solution->solutioncol_id = $faker->randomElement($solutioncol_ids);
            $solution->productcol_id = $faker->randomElement($productcol_ids);
        });

        // 将数据集合转换为数组，并插入到数据库中
        Solution::insert($solutions->toArray());
    }
}
