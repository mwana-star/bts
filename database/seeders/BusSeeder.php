<?php

namespace Database\Seeders;

use App\Models\Bus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 12; $i++) {
            Bus::create([
                'name' => 'Bus ' . $i,
                'total_seats' => $faker->numberBetween(30, 60),
                'model' => $faker->word,
                'manufacture_year' => $faker->numberBetween(2010, 2023),
                'registration_number' => 'BUS' . $faker->unique()->randomNumber(6),
                'description' => $faker->sentence,
                'is_available' => $faker->boolean(90), // 90% chance of being available
                'image' => $faker->imageUrl(640, 480, 'transport'),
                'driver_name' => $faker->name,
                'contact_number' => $faker->phoneNumber,
                'wifi_available' => $faker->boolean,
                'air_conditioned' => $faker->boolean,
                'wheelchair_accessible' => $faker->boolean,
            ]);
        }
    }
}
