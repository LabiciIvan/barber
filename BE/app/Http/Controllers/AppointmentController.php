<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Services\AppointmentService;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Shop;
use App\Models\User;

class AppointmentController extends Controller
{
    public function index(Shop $shop, AppointmentService $appointmentService)
    {
        return $appointmentService->index($shop);
    }

    public function show(Appointment $appointment, AppointmentService $appointmentService)
    {
        return $appointmentService->show($appointment);
    }

    public function store(StoreAppointmentRequest $request, Shop $shop, User $barber, Service $service, AppointmentService $appointmentService)
    {
        return $appointmentService->store($request->validated(), $shop, $barber, $service);
    }
}
