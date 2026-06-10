<?php

namespace App\Http\Services;

use App\Http\Resources\UserResource;
use App\Models\User;

class UserService
{
    public function show(User $user)
    {
        return new UserResource($user);
    }
}