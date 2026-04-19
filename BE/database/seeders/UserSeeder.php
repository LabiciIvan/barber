<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shops = Shop::pluck('id');

        User::factory()
            ->count(10)
            ->make()
            ->each(function ($user) use ($shops) {
                if ($user->role === 'barber' || $user->role === 'owner') {
                    $user->shop_id = $shops->random();
                    $user->save();
                } else {
                    // If user isn't barber or owner then don't associate with a shop.
                    $user->save();
                }
            });
    }
}
