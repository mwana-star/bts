<?php

namespace Database\Seeders;

use App\Models\TripRoute;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TripRouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            TripRoute::create([
                'origin' => $faker->city,
                'destination' => $faker->city,
                'distance' => $faker->randomFloat(2, 50, 500),
                'estimated_travel_time' => $faker->time('H:i'),
                'route_code' => 'ROUTE' . $faker->unique()->randomNumber(4),
                'description' => $faker->sentence,
                'route_map' => $faker->imageUrl(640, 480, 'transport'),
                'active' => $faker->boolean(90), // 90% chance of being active
            ]);
        }
    }
}
