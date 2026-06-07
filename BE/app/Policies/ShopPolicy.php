<?php

namespace App\Policies;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\Log;

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

    public function createBarber(User $user, Shop $shop)
    {
        return ($user->role === 'admin' || ($user->role === 'owner' && $user->shop_id === $shop->id));
    }

    /**
     * Update applies only to user with barber role or an admin.
     */
    public function updateBarber(User $user, Shop $shop, User $barber)
    {
        if ($barber->role != 'barber' || ($user->role === 'admin' && $user->id === $barber->id)) {
            return false;
        }

        return ($user->role === 'admin' || ($user->role === 'barber' && $user->id === $barber->id && $barber->shop_id === $shop->id));
    }

    /**
     * Owner of the shop can delete it's own barbers accounts only.
     */
    public function deleteBarber(User $user, Shop $shop, User $barber)
    {
        if ($barber->role != 'barber' || ($user->role != 'owner' && $user->shop_id === $shop->id)) {
            return false;
        }

        return $barber->shop_id === $shop->id;
    }
}
