<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shops = Shop::with(['barbers', 'services'])->has('barbers')->get();

        $customers = User::where('role', 'customer')->get();

        Appointment::factory()
            ->count($customers->count())
            ->create()
            ->each(function ($appointment, $index) use ($customers, $shops) {
                $customer = $customers[$index];

                $shop = $shops->random();

                if ($shop->barbers->isEmpty() || $shop->services->isEmpty()) {
                    return;
                }

                $barber = $shop->barbers->random();

                $services = $shop->services->where('active', true)->random(1);

                $totalDuration = $services->sum('duration_minutes');

                $totalPrice    = $services->sum('price');

                $appointment->update([
                    'shop_id'        => $shop->id,
                    'barber_id'      => $barber->id,
                    'customer_id'    => $customer->id,
                    'customer_name'  => $customer->name,
                    'customer_phone' => $customer->phone,
                    'start_time'     => now()->addDays(rand(1, 14)),
                    'end_time'       => now()->addDays(rand(1, 14))->addMinutes($totalDuration),
                    'status'         => 'pending',
                    'total_price'    => $totalPrice,
                ]);

                foreach ($services as $index => $service) {
                    $appointment->services()->attach($service->id, [
                        'price_at_booking'            => $service->price,
                        'duration_minutes_at_booking' => $service->duration_minutes,
                    ]);
                }

            });
    }
}
