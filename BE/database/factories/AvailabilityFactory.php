<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Illuminate\Support\days;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Availability>
 */
class AvailabilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $days = fake()->randomElement([
            '1,2,3,4,5',        // Mon–Fri
            '2,3,4,5,6',        // Tue–Sat
            '1,2,3,4,5,6',      // Mon–Sat
            '3,4,5,6,7',        // Wed–Sun
            '1,3,5',            // Mon, Wed, Fri
        ]);

        $startHour = fake()->numberBetween(8, 11);
        $endHour   = fake()->numberBetween($startHour + 4,min($startHour + 9, 20));

        return [
            'user_id'      => null,
            'day_of_week'  => $days,
            'start_time' => Carbon::createFromTime($startHour)->format('g:i A'),
            'end_time'   => Carbon::createFromTime($endHour)->format('g:i A'),
        ];
    }
}
