<?php

namespace Database\Seeders;

use App\Models\Availability;
use App\Models\User;
use Illuminate\Database\Seeder;

class AvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barbers = User::where('role', '=', 'barber')->get();

        Availability::factory()
            ->count($barbers->count())
            ->make()
            ->each(function ($availability, $index) use ($barbers) {
                $barber = $barbers[$index];

                $availability->user_id = $barber['id'];

                $availability->save();
            });
    }
}
