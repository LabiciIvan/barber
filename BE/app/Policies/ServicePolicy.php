<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\Shop;
use App\Models\User;

class ServicePolicy
{
    public function create(User $user): bool
    {
        return ($user->role === 'owner' || $user->role === 'admin');
    }

    public function update(User $user, Service $service, Shop $shop): bool
    {
        $hasService = $shop->services()->where('id', $service->id)->exists();

        // Must have service and either user is an admin or owner of the shop.
        return ($hasService && ($user->role === 'admin' || $user->role === 'owner' && $user->shop_id === $shop->id));
    }

    public function delete(User $user, Service $service, Shop $shop): bool
    {
        $hasService = $shop->services()->where('id', $service->id)->exists();

        // Must have service and either user is an admin or owner of the shop.
        return ($hasService && ($user->role === 'admin' || $user->role === 'owner' && $user->shop_id === $shop->id));
    }
}
