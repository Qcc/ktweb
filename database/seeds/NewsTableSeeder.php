<?php

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\User;
use App\Models\Column;

class NewsTableSeeder extends Seeder
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
        $column_ids = Column::all()->pluck('id')->toArray();

        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        $allnews = factory(News::class)
                        ->times(500) //填充500 条话题数据
                        ->make()
                        ->each(function ($news, $index)
                            use ($user_ids, $column_ids, $faker)
        {
            // 从用户 ID 数组中随机取出一个并赋值
            $news->user_id = $faker->randomElement($user_ids);

            // 话题分类，同上
            $news->column_id = $faker->randomElement($column_ids);
        });

        // 将数据集合转换为数组，并插入到数据库中
        News::insert($allnews->toArray());
    }
}
