<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Business;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinessPolicy extends Policy
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

    public function update(User $user, Business $business)
    {
        if($business->status){
            return $user->isAuthorOf($business);
        }else{
            return $user->can('revice_business');
        }
    }

    public function destroy(User $user, Business $business)
    {
        return $user->can('manage_business');
    }
}
