<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Models\Shop;
use Illuminate\Support\Facades\Cache;
use App\Http\Services\ServicesService;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index(Shop $shop, ServicesService $servicesService)
    {
        return Cache::remember("shop_services_{$shop->id}", 300, function () use ($shop, $servicesService) {
            return $servicesService->index($shop);
        });
    }

    public function store(StoreServiceRequest $request, ServicesService $servicesService)
    {
        $this->authorize('create', Service::class);

        return $servicesService->store($request->validated());
    }
}
