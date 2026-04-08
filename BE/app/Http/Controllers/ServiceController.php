<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Service;
use Illuminate\Support\Facades\Cache;
use App\Http\Services\ServicesService;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends Controller
{
    public function index(Shop $shop, ServicesService $servicesService)
    {
        // return Cache::remember("shop_services_{$shop->id}", 300, function () use ($shop, $servicesService) {
            return $servicesService->index($shop);
        // });
    }

    public function store(StoreServiceRequest $request, ServicesService $servicesService)
    {
        $this->authorize('create', Service::class);

        return $servicesService->store($request->validated());
    }

    public function update(UpdateServiceRequest $request, ServicesService $servicesService, Service $service, Shop $shop)
    {
        $this->authorize('update', [$service, $shop]);

        return $servicesService->update($request->validated(), $service);
    }

    public function delete(ServicesService $servicesService, Service $service, Shop $shop)
    {
        $this->authorize('delete', [$service, $shop]);

        $servicesService->delete($service);
    }
}
