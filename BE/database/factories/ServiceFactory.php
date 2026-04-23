<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shop_id'           => null,
            'name'              => fake()->randomElement(['Classic Haircut', 'Skin Fade', 'Beard Trim & Shape', 'Haircut & Styling', 'Luxury Shave']),
            'duration_minutes'  => fake()->numberBetween(15, 60),
            'price'             => fake()->randomFloat(2, 10, 50),
            'active'            => true,
        ];
    }
}
