<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EnergyConsumption;
use App\Http\Controllers\Controller;

class EnergyController extends Controller
{
    public function index()
    {
        $page_title = 'Energy'; // Update the page title

        $userId = session('user_id');
        $energyConsumption = EnergyConsumption::where('user_id', $userId)->get();

        return view('user.energy', [
            'page_title' => $page_title,
            'energyConsumption' => $energyConsumption,
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'electricity_usage' => 'required|numeric|min:0',
            'generator_fuel_consumption' => 'required|numeric|min:0',
            'cooking_fuel_type' => 'required',
            'location' => 'required',
        ]);

        $userId = $request->session()->get('user_id');

        $energyConsumption = new EnergyConsumption();
        $energyConsumption->user_id = $userId;
        $energyConsumption->electricity_usage = $validatedData['electricity_usage'];
        $energyConsumption->generator_fuel_consumption = $validatedData['generator_fuel_consumption'];
        $energyConsumption->cooking_fuel_type = $validatedData['cooking_fuel_type'];
        $energyConsumption->location = $validatedData['location'];
        $energyConsumption->save();

        // Calculate and update the energy emissions
        $this->updateEnergyEmissions($userId);

        // Optionally, you can perform additional logic or redirect the user to a success page
        return redirect()->back()->with('success', 'Energy consumption data saved successfully.');
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
        $energyData = EnergyConsumption::where('user_id', $userId)->first(); // Retrieve energy consumption data for the user

        $emissionFactor = $this->getEmissionFactorForGrid($energyData->location); // Retrieve the emission factor for the electricity grid in the user's location

        $electricityEmissions = $energyData->electricity_usage * $emissionFactor; // Calculate emissions from electricity usage

        $cookingFuelEmissions = $this->getEmissionFactorForFuel($energyData->cooking_fuel_type) * $energyData->generator_fuel_consumption; // Calculate emissions from cooking fuel and generator

        $totalEmissions = $electricityEmissions + $cookingFuelEmissions; // Sum up emissions

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
