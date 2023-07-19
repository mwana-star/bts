<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use App\Models\Transportation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransportationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::all(); // Retrieve all users

        foreach ($users as $user) {
            for ($i = 0; $i < 10; $i++) {
                $mode = $faker->randomElement(['walking', 'cycling', 'public_transport', 'car', 'motorbike']);
                $distance = $faker->randomFloat(2, 1, 100);
                $frequency = $faker->randomElement(['daily', 'weekly', 'monthly']);
                $duration = $faker->randomFloat(2, 10, 240);
                $createdAt = $faker->dateTimeBetween('-1 year', 'now'); // Random date within the past year

                Transportation::create([
                    'user_id' => $user->id,
                    'mode' => $mode,
                    'distance' => $distance,
                    'frequency' => $frequency,
                    'duration' => $duration,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);

                // Calculate and update the transportation carbon emission for the user
                $this->updateTransportationCarbonEmission($user->id);
            }
        }
    }

    private function updateTransportationCarbonEmission($userId)
    {
        $transportationEmissions = $this->calculateTransportationEmissions($userId);

        $user = User::find($userId);
        $user->transportation_carbon_emission = $transportationEmissions;
        $user->save();
    }

    private function calculateTransportationEmissions($userId)
    {
        $transportationData = Transportation::where('user_id', $userId)->get(); // Retrieve transportation data for the user

        $totalEmissions = 0;

        foreach ($transportationData as $trip) {
            $emissionFactor = $this->getEmissionFactorForMode($trip->mode); // Retrieve the emission factor for the transportation mode

            $emission = $trip->distance * $emissionFactor; // Calculate emissions for the trip

            $totalEmissions += $emission; // Sum up emissions
        }

        return $totalEmissions;
    }

    private function getEmissionFactorForMode($mode)
    {
        // Define emission factors for different transportation modes
        $emissionFactors = [
            'walking' => 0.9, // Emission factor for walking (in kg CO2 per km)
            'cycling' => 0.7, // Emission factor for cycling (in kg CO2 per km)
            'public_transport' => 0.6, // Emission factor for public transport (in kg CO2 per km)
            'car' => 0.2, // Emission factor for car (in kg CO2 per km)
            'motorbike' => 0.15 // Emission factor for motorbike (in kg CO2 per km)
        ];

        return $emissionFactors[$mode] ?? 0.0; // Return 0.0 if the emission factor is not defined for the mode
    }

}
