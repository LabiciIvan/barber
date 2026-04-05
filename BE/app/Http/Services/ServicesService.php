<?php

namespace App\Http\Services;

use App\Models\Shop;
use App\Models\Service;
use App\Http\Traits\CustomResponse;
use App\Http\Resources\ServiceResource;

class ServicesService {

    use CustomResponse;

    public function index(Shop $shop) {
        return ServiceResource::collection($shop->services()->includeTrashed(request()->boolean('delete'))->get());
    }

    public function store($data)
    {
        try {
            return new ServiceResource(Service::create($data));
        } catch (\Throwable $e) {
            return $this->failed($e->getMessage());
        }
    }

    public function update($data, Service $service)
    {
        try {
            $service->update($data);

            return new ServiceResource($service);
        } catch (\Throwable $e) {
            return $this->failed($e->getMessage());
        }
    }

    public function delete(Service $service)
    {
        try {
            return Service::where('id', $service->id)->delete();
        } catch(\Throwable $e) {
            return $this->failed($e->getMessage());
        }
    }
}