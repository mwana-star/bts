<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use App\Models\Transportation;
use App\Models\CarbonFootprint;
use App\Http\Controllers\Controller;

class TransportationController extends Controller
{
    public function index()
    {
        $page_title = 'Transportation';

        $userId = session('user_id');
        $transportations = Transportation::where('user_id', $userId)->get();

        return view('user.transportation', [
            'page_title' => $page_title,
            'transportations' => $transportations,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'mode' => 'required',
            'distance' => 'required|numeric|min:0',
            'frequency' => 'required',
            'duration' => 'required|numeric|min:0',
        ]);

        $userId = $request->session()->get('user_id');

        $transportation = new Transportation();
        $transportation->user_id = $userId;
        $transportation->mode = $validatedData['mode'];
        $transportation->distance = $validatedData['distance'];
        $transportation->frequency = $validatedData['frequency'];
        $transportation->duration = $validatedData['duration'];
        $transportation->save();

        // Calculate and update the transportation carbon emission
        $this->updateTransportationCarbonEmission($userId);

        // Optionally, you can perform additional logic or redirect the user to a success page
        return redirect()->back()->with('success', 'Transportation data saved successfully.');
    }

    private function updateTransportationCarbonEmission($userId)
    {
        $transportationEmissions = $this->calculateTransportationEmissions($userId);


        $user = User::find($userId);
        $user->transportation_carbon_emission = $transportationEmissions;
        $user->save();
        
        $energyEmissions = $user->energy_emissions;

        $totalEmissions = $transportationEmissions + $energyEmissions;



        // Store the carbon footprint record
        CarbonFootprint::create([
            'user_id' => $userId,
            'carbon_footprint' => $totalEmissions,
        ]);
    }



    public function calculateEmissions(Request $request)
    {
        // Get the authenticated user's ID or use any other logic to determine the user ID
        $userId = $request->user()->id;

        $totalEmissions = $this->calculateTransportationEmissions($userId);

        // Perform any additional logic or return the emissions data as needed
        return response()->json([
            'total_emissions' => $totalEmissions,
        ]);
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
