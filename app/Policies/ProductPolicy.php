<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;

class ProductPolicy extends Policy
{
    
    public function update(User $user, Product $product)
    {
        return $user->isAuthorOf($product);
    }
 
    public function destroy(User $user, Product $product)
    {
        return $user->isAuthorOf($product);
    }
    public function create(User $user, Product $product)
    {   
        return $user->can('manage_contents');
    }
}
