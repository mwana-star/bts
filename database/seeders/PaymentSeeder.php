<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\User;
use App\Models\Booking;
use Faker\Factory as Faker;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all users and bookings
        $users = User::all();
        $bookings = Booking::all();

        // Seed some payments
        foreach (range(1, 15) as $index) {
            Payment::create([
                'user_id' => $faker->randomElement($users)->id,
                'booking_id' => $faker->randomElement($bookings)->id,
                'amount' => $faker->randomFloat(2, 50, 500),
                'payment_method' => $faker->randomElement(['credit_card', 'paypal', 'bank_transfer']),
                'transaction_id' => $faker->unique()->uuid,
                'status' => $faker->randomElement(['pending', 'completed', 'failed']),
                // Add other fields related to payments here
            ]);
        }
    }
}
