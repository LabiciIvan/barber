<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    protected $theme = [
        'color' => '#A3C71',
        'logo'  => '/random/color/path',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'             => fake()->company(),
            'slug'             => fake()->slug(1),
            'subdomain'        => fake()->domainName(),
            'latitude'         => fake()->latitude(),
            'longitude'        => fake()->longitude(),
            'city'             => fake()->city(),
            'theme_settings'   => $this->theme
        ];
    }
}
