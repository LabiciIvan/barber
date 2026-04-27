<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarberRequest;
use App\Http\Requests\UpdateBarberRequest;
use App\Http\Services\BarberService;
use App\Models\Shop;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    public function index(Shop $shop, BarberService $barberService)
    {
        return $barberService->index($shop);
    }

    public function store(StoreBarberRequest $request, Shop $shop, BarberService $barberService)
    {
        $this->authorize('createBarber', [$shop]);

        return $barberService->store($request->validated(), $shop);
    }

    public function update(UpdateBarberRequest $request, User $barber, Shop $shop, BarberService $barberService)
    {
        $this->authorize('updateBarber', [$shop, $barber]);

        return $barberService->update($request->validated(), $barber);
    }

    public function delete(User $barber, Shop $shop, BarberService $barberService)
    {
        $this->authorize('deleteBarber', [$shop, $barber]);

        return $barberService->delete($barber);
    }

    public function restore(User $barber, Shop $shop, BarberService $barberService)
    {
        // Re-use same authorization action as on delete.
        $this->authorize('deleteBarber', [$shop, $barber]);

        return $barberService->restore($barber);
    }
}
