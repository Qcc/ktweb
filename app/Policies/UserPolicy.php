<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    // 更新时判断当前登录用户与请求操作用户是否一致
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }
}
