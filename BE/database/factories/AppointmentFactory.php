<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shop_id'         => null,
            'barber_id'       => null,
            'customer_id'     => null,
            'customer_name'   => fake()->name(),
            'customer_phone'  => fake()->phoneNumber(),
            'start_time'      => fake()->numberBetween(15, 60),
            'end_time'        => fake()->randomFloat(2, 10, 50),
            'status'          => fake()->randomElement(['pending', 'complete', 'cancelled']),
            'total_price'     => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
