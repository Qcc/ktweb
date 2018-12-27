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
    // 添加精华 置顶，用户需要有管理权限
    public function manage(User $user, Topic $topic)
    {
        return $user->can('manage_contents');
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
