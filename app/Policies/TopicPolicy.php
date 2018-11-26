<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Topic;

class TopicPolicy extends Policy
{
    /**
     * 更新时判断是否为当前用户
     *
     * @param User $user
     * @param Topic $topic
     * @return void
     */
    public function update(User $user, Topic $topic)
    {
        return $user->isAuthorOf($topic);
    }

    /**
     * 删除时判断是否为当前用户
     *
     * @param User $user
     * @param Topic $topic
     * @return void
     */
    public function destroy(User $user, Topic $topic)
    {
        return $user->isAuthorOf($topic);
    }
}
