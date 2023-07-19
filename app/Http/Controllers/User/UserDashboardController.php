<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\TripRoute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    public function index()
    {
        $page_title = 'Dashboard';

        $userId = session()->get('user_id');

        $user = User::find($userId);

        // Retrieve the user's transportation carbon emission and energy emissions
        $user = User::find($userId);
        $transportationEmissions = $user->transportation_carbon_emission;
        $energyEmissions = $user->energy_emissions;

        // Calculate the total carbon footprint by summing up the emissions
        $totalCarbonFootprint = $transportationEmissions + $energyEmissions;

        $tripRoutes = TripRoute::all();

        return view('user.dashboard', [
            'page_title' => $page_title,
            'user' => $user,
            'totalCarbonFootprint' => $totalCarbonFootprint,
            'tripRoutes' => $tripRoutes,
        ]);
    }
}
