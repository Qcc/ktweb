<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;

class ReplysTableSeeder extends Seeder
{
    public function run()
    {
        //所有用户ID 数组，例如[1,2,3,4]
        $user_ids = User::all()->pluck('id')->toArray();
        //所有话题ID数组，例如[1,2,3,4]
        $topic_ids = Topic::all()->pluck('id')->toArray();

        //获取Faker实例
        $faker = app(Faker\Generator::class);

        $replys = factory(Reply::class)
                    ->times(500) //生成500条回复数据
                    ->make()
                    ->each(function ($reply, $index) 
                    use ($user_ids, $topic_ids, $faker)
            {
                //从用户ID 话题ID 数组中随机取出一个并赋值
                $reply->user_id = $faker->randomElement($user_ids);
                $reply->topic_id = $faker->randomElement($topic_ids);
            });

        // 将数集合转换为数组并插入到数据库中
        Reply::insert($replys->toArray());
    }

}

