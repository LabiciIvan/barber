<?php

namespace App\Http\Controllers;

use App\Http\Services\BarberService;
use App\Models\Shop;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    public function index(Shop $shop, BarberService $barberService)
    {
        return $barberService->index($shop);
    }
}
