<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\User;
class TopicFollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topic = Topic::find(1);
        $users = User::all();

        // 获取所有用户 ID 数组
        $follower_ids = $users->pluck('id')->toArray();

        // 所有用户都关注ID为1的文章
        $topic->topicFollowers($follower_ids);
    }
}
