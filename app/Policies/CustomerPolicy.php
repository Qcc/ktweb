<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Customer;

class CustomerPolicy extends Policy
{
    public function update(User $user, Customer $customer)
    {
        return $user->isAuthorOf($customer);
    }

    public function destroy(User $user, Customer $customer)
    {
        return $user->isAuthorOf($customer);
    }
    public function create(User $user, Customer $customer)
    {   
        return $user->can('manage_contents');
    }
}
