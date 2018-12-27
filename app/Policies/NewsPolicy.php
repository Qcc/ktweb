<?php

namespace App\Policies;

use App\Models\User;
use App\Models\News;

class NewsPolicy extends Policy
{
    /**
     * 更新时判断是否为当前用户
     *
     * @param User $user
     * @param News $news
     * @return void
     */
    public function update(User $user, News $news)
    {
        return $user->isAuthorOf($news);
    }

    /**
     * 删除时判断是否为当前用户
     *
     * @param User $user
     * @param News $news
     * @return void
     */
    public function destroy(User $user, News $news)
    {
        return $user->isAuthorOf($news);
    }

    public function create(User $user, News $news)
    {   
        return $user->can('manage_contents');
    }
}
