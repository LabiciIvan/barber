<?php

namespace App\Http\Services;

use App\Models\Shop;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Traits\CustomResponse;

class BarberService
{
    use CustomResponse;

    public function index(Shop $shop) {
        return UserResource::collection($shop->barbers()->with('availability')->get());
    }

    public function store($data) {
        try {
            $user = User::create($data);

            return new UserResource($user);

        } catch (\Throwable $e) {
            return $this->failed($e->getMessage());
        }
    }

    public function update($data, User $barber) {
        try {
            foreach($data as $column => $value) {
                $barber->$column = $value;
            }

            $barber->save();

            return new UserResource($barber);
        } catch (\Throwable $e) {
            return $this->failed($e->getMessage());
        }
    }

    public function delete(User $barber) {
        try {
            $deleted = $barber->delete();

            if ($deleted) {
                return $this->success(__('messages.soft_deleted_resource'));
            }

            return $this->error(__('messages.delete_failed'));
        } catch (\Throwable $e) {
            return $this->failed($e->getMessage());
        }
    }

    public function restore(User $barber) {
        try {
            $barber->restore();

            return new UserResource($barber);
        } catch (\Throwable $e) {
            return $this->failed($e->getMessage());
        }
    }
}