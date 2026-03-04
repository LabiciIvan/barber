<?php

namespace App\Policies;

use App\Models\Shop;
use App\Models\User;

class ShopPolicy
{
    public function create(User $user): bool
    {
        return ($user->role === 'owner' || $user->role === 'admin');
    }

    public function update(User $user, Shop $shop): bool
    {
        return (($user->role === 'owner' && $user->shop_id === $shop->id) || $user->role === 'admin');
    }

    public function delete(User $user, Shop $shop): bool
    {
        return (($user->role === 'owner' && $user->shop_id === $shop->id) || $user->role === 'admin');
    }

    public function restore(User $user): bool
    {
        return $user->role === 'admin';
    }
}
