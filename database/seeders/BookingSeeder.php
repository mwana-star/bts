<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Bus;
use App\Models\TripRoute;
use Faker\Factory as Faker;

class BookingSeeder extends Seeder
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

        // Seed some bookings
        foreach (range(1, 20) as $index) {
            Booking::create([
                'user_id' => $faker->randomElement($users)->id,
                'bus_id' => $faker->randomElement($buses)->id,
                'trip_route_id' => $faker->randomElement($tripRoutes)->id,
                'booking_date' => $faker->dateTimeBetween('-1 year', '+1 year'),
                'num_passengers' => $faker->numberBetween(1, 5),
                'total_cost' => $faker->randomFloat(2, 50, 500),
                'payment_status' => $faker->randomElement(['pending', 'completed', 'failed']),
                'is_cancelled' => $faker->boolean(10), // 10% chance of being cancelled
                // Add other fields related to bookings here
            ]);
        }
    }
}
