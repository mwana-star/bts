<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\EnergyConsumption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EnergyConsumptionSeeder extends Seeder
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
                $electricityUsage = $faker->randomFloat(2, 100, 1000); // Random electricity usage between 100 and 1000 kWh
                $generatorFuelConsumption = $faker->randomFloat(2, 5, 50); // Random generator fuel consumption between 5 and 50 units
                $cookingFuelType = $faker->randomElement(['electricity', 'gas', 'charcoal', 'firewood']);
                $location = $faker->randomElement(['location1', 'location2']);
                $createdAt = $faker->dateTimeBetween('-1 year', 'now'); // Random date within the past year

                EnergyConsumption::create([
                    'user_id' => $user->id,
                    'electricity_usage' => $electricityUsage,
                    'generator_fuel_consumption' => $generatorFuelConsumption,
                    'cooking_fuel_type' => $cookingFuelType,
                    'location' => $location,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);

                // Calculate and update the energy emissions for the user
                $this->updateEnergyEmissions($user->id);
            }
        }
    }

    private function updateEnergyEmissions($userId)
    {
        $totalEmissions = $this->calculateEnergyEmissions($userId);

        $user = User::find($userId);
        $user->energy_emissions = $totalEmissions;
        $user->save();
    }

    private function calculateEnergyEmissions($userId)
    {
        $energyData = EnergyConsumption::where('user_id', $userId)->get(); // Retrieve energy consumption data for the user

        $totalEmissions = 0;

        foreach ($energyData as $consumption) {
            $emissionFactor = $this->getEmissionFactorForGrid($consumption->location); // Retrieve the emission factor for the electricity grid in the user's location

            $electricityEmissions = $consumption->electricity_usage * $emissionFactor; // Calculate emissions from electricity usage

            $cookingFuelEmissions = $this->getEmissionFactorForFuel($consumption->cooking_fuel_type) * $consumption->generator_fuel_consumption; // Calculate emissions from cooking fuel and generator

            $totalEmissions += $electricityEmissions + $cookingFuelEmissions; // Sum up emissions
        }

        return $totalEmissions;
    }

    private function getEmissionFactorForGrid($location)
    {
        // Define emission factors for electricity grids in different locations
        $emissionFactors = [
            'location1' => 0.5, // Emission factor for location 1 (in kg CO2 per kWh)
            'location2' => 0.4 // Emission factor for location 2 (in kg CO2 per kWh)
        ];

        return $emissionFactors[$location];
    }

    private function getEmissionFactorForFuel($fuelType)
    {
        // Define emission factors for different cooking fuel types
        $emissionFactors = [
            'electricity' => 0.3, // Emission factor for electricity (in kg CO2 per unit)
            'gas' => 0.2, // Emission factor for gas (in kg CO2 per unit)
            'charcoal' => 0.5, // Emission factor for charcoal (in kg CO2 per unit)
            'firewood' => 0.7 // Emission factor for firewood (in kg CO2 per unit)
        ];

        return $emissionFactors[$fuelType];
    }
}
