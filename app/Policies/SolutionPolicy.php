<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Solution;

class SolutionPolicy extends Policy
{
     
    public function update(User $user, Solution $solution)
    {
        return $user->isAuthorOf($solution);
    }

   
    public function destroy(User $user, Solution $solution)
    {
        return $user->isAuthorOf($solution);
    }
}
