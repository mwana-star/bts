<?php

namespace App\Http\Controllers\User;

use App\Models\UserAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarbonFootprintController extends Controller
{
     /**
     * Calculate and store the carbon footprint based on the user's evaluation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function calculateCarbonFootprint(Request $request)
    {
        $validatedData = $request->validate([
            'location' => 'required|string',
            'household_size' => 'required|integer',
            'energy_consumption' => 'required|numeric',
            'transportation' => 'required|string',
            'food_consumption' => 'required|string',
            'waste_disposal' => 'required|string',
            'lifestyle_choices' => 'required|string',
        ]);

        // Apply conversion factors to calculate emissions for each category
        $electricityEmissions = $validatedData['energy_consumption'] * $electricityConversionFactor;
        $transportationEmissions = $validatedData['distance_traveled'] * $transportationConversionFactor;
        $foodEmissions = $validatedData['food_consumption'] * $foodConversionFactor;
        $wasteEmissions = $validatedData['waste_generation'] * $wasteConversionFactor;

        // Sum up the emissions from different categories to get the total carbon footprint
        $totalCarbonFootprint = $electricityEmissions + $transportationEmissions + $foodEmissions + $wasteEmissions;

        // Associate the calculated carbon footprint with the user's account
        $userAccount = UserAccount::findOrFail($request->user_id);
        $userAccount->carbon_footprint = $totalCarbonFootprint;
        $userAccount->save();

        return redirect()->route('dashboard')->with('success', 'Carbon footprint calculated successfully.');
    }
}
