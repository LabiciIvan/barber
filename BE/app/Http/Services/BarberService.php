<?php

namespace App\Http\Services;

use App\Models\Shop;
use App\Models\User;
use App\Http\Resources\UserResource;

class BarberService
{
    public function index(Shop $shop) {
        return UserResource::collection($shop->barbers()->with('availability')->get());
    }
}