<?php

namespace App\Observers;

use App\Models\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function creating(User $user)
    {
        $user->nickname = hiddenPhone($user->phone);
    }

    public function updating(User $user)
    {
        //
    }
}