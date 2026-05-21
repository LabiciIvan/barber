<?php

namespace App\Http\Services;

use App\Http\Resources\AppointmentResource;
use App\Http\Traits\CustomResponse;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Shop;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AppointmentService
{
    use CustomResponse;

    public function index(Shop $shop)
    {
        return AppointmentResource::collection(Appointment::where('shop_id', $shop->id)->get());
    }

    public function show(Appointment $appointment)
    {
        return new AppointmentResource($appointment);
    }

    public function store($data, Shop $shop, User $barber, Service $service)
    {
        $customer = Auth::user();

        try {
            $appointment = Appointment::create([
                'shop_id'          => $shop->id,
                'barber_id'        => $barber->id,
                'customer_id'      => $customer->id,
                'customer_name'    => $customer->name,
                'customer_phone'   => $customer->phone,
                'start_time'       => $data['start_time'],
                'end_time'         => $data['end_time'],
                'status'           => 'pending',
                'total_price'      => $service->price,
            ]);

            return new AppointmentResource($appointment);

        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}