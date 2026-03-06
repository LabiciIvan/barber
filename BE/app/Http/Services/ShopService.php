<?php

namespace App\Http\Services;

use App\Models\Shop;
use App\Http\Traits\CustomResponse;
use App\Http\Resources\ShopResource;
use App\Http\Resources\ShopThemeResource;
use Illuminate\Support\Facades\Log;

class ShopService
{
    use CustomResponse;

    public function index()
    {
        return ShopResource::collection(Shop::with('barbers.availability')->paginate(4))->additional(['status' => 'success']);
    }

    public function shopWithRelation(Shop $shop) {
        return new ShopResource($shop->load('barbers.availability'));
    }

    public function shopTheme(Shop $shop) {
        return new ShopThemeResource($shop);
    }

    public function store($data)
    {
        try {
            return new ShopResource(Shop::create($data));
        } catch (\Throwable $e) {
            return $this->failed($e->getMessage());
        }
    }

    public function update(array $data, Shop $shop)
    {
        try {
            if (isset($data['theme_settings'])) {
                $data['theme_settings'] = array_merge($shop->theme_settings ?? [], $data['theme_settings']);
            }

            $shop->update($data);

            return new ShopResource($shop);
        } catch (\Throwable $e) {
            return $this->failed($e->getMessage());
        }
    }

    public function delete(Shop $shop)
    {
        try {
            $shop->delete();

            return response()->noContent();

        } catch (\Throwable $e) {
            return $this->failed($e->getMessage());
        }
    }

    public function restore(Shop $shop)
    {
        try {
            $shop->restore();

            return new ShopResource($shop->fresh());

        } catch (\Throwable $e) {
            return $this->failed($e->getMessage());
        }
    }
}