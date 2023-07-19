<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Bus;
use App\Models\TripRoute;
use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all users, buses, and trip routes
        $users = User::all();
        $buses = Bus::all();
        $tripRoutes = TripRoute::all();

        // Seed some reviews
        foreach (range(1, 20) as $index) {
            Review::create([
                'user_id' => $faker->randomElement($users)->id,
                'bus_id' => $faker->randomElement($buses)->id,
                'trip_route_id' => $faker->randomElement($tripRoutes)->id,
                'rating' => $faker->numberBetween(1, 5),
                'comment' => $faker->optional(0.7)->paragraph, // 70% chance of having a comment
                // Add other fields related to reviews here
            ]);
        }
    }
}
