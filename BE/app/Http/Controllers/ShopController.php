<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Http\Services\ShopService;
use App\Http\Traits\CustomResponse;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;

class ShopController extends Controller
{
    use CustomResponse;

    public function index(ShopService $shopService)
    {
        return $shopService->index();
    }

    public function show(Shop $shop, ShopService $shopService)
    {
        return $shopService->shopWithRelation($shop);
    }

    public function theme(Shop $shop, ShopService $shopService)
    {
        return $shopService->shopTheme($shop);
    }

    public function store(StoreShopRequest $request, ShopService $shopService)
    {
        return $shopService->store($request->validated());
    }

    public function update(UpdateShopRequest $request, ShopService $shopService, Shop $shop)
    {
        return $shopService->update($request->validated(), $shop);
    }

    public function delete(Shop $shop, ShopService $shopService) {
        $this->authorize('delete', $shop);

        return $shopService->delete($shop);
    }

    public function restore(Shop $shop, ShopService $shopService) {
        $this->authorize('restore', $shop);

        return $shopService->restore($shop);
    }

}
