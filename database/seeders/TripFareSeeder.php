<?php

namespace Database\Seeders;

use App\Models\TripFare;
use App\Models\TripRoute;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TripFareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all the trip routes to associate fares with them
        $tripRoutes = TripRoute::all();

        foreach ($tripRoutes as $tripRoute) {
            TripFare::create([
                'trip_route_id' => $tripRoute->id,
                'base_fare' => $faker->randomFloat(2, 50, 200),
                'discount' => $faker->randomFloat(2, 0, 50),
                'discount_type' => $faker->randomElement(['percentage', 'fixed']),
                'additional_fee' => $faker->randomFloat(2, 0, 30),
                'additional_fee_type' => $faker->randomElement(['percentage', 'fixed']),
            ]);
        }
    }
}
