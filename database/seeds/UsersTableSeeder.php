<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            '/images/avatar/avatar001.png',
            '/images/avatar/avatar002.png',
            '/images/avatar/avatar003.png',
            '/images/avatar/avatar004.png',
            '/images/avatar/avatar005.png',
            '/images/avatar/avatar006.png',
            '/images/avatar/avatar007.png',
            '/images/avatar/avatar008.png',
            '/images/avatar/avatar009.png',
            '/images/avatar/avatar010.png',
            '/images/avatar/avatar011.png',
            '/images/avatar/avatar012.png',
            '/images/avatar/avatar013.png',
        ];

        // 生成数据集合
        $users = factory(User::class)
                        ->times(500) //生成10个用户
                        ->make()
                        ->each(function ($user, $index)
                            use ($faker, $avatars)
        {
            // 从头像数组中随机取出一个并赋值
            $user->avatar = $faker->randomElement($avatars);
        });

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'kevin';
        $user->nickname = 'kevin';
        $user->phone = '15889730027';
        $user->email = 'kevin@kouton.com';
        $user->avatar = '/images/avatar/avatar013.png';
        $user->save();

        // 初始化用户角色，将 1 号用户指派为『站长』
        $user->assignRole('Webmaster');

    }
}
