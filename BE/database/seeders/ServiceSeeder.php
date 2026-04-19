<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shops = Shop::pluck('id');

        Service::factory()
            ->count(50)
            ->make()
            ->each(function ($service) use( $shops) {
                $service->shop_id = $shops->random();
                $service->save();
            });
    }
}
