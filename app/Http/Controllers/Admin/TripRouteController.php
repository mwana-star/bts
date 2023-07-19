<?php

namespace App\Http\Controllers\Admin;

use App\Models\TripRoute;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TripRouteController extends Controller
{
    public function index()
    {
        $tripRoutes = TripRoute::all();
        return view('admin.trip_routes', compact('tripRoutes'));
    }

    public function create()
    {
        return view('trip_routes.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'origin' => 'required|string',
            'destination' => 'required|string',
            'distance' => 'required|numeric',
            'estimated_travel_time' => 'required|date_format:H:i',
            'route_code' => 'required|string|unique:trip_routes',
            // Add validation rules for other fields here
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Get the input data and handle checkboxes
        $data = $request->except(['_token', '_method']);
        $data['active'] = Arr::get($data, 'active', false);

        // Create the trip route record
        $tripRoute = TripRoute::create($data);

        // Optionally, you can add a success message and redirect to the trip route details page
        return redirect()->route('trip_routes.index', $tripRoute->id)
            ->with('success', 'Trip route created successfully!');
    }

    public function show(TripRoute $tripRoute)
    {
        return view('trip_routes.show', compact('tripRoute'));
    }

    public function edit(TripRoute $tripRoute)
    {
        return view('trip_routes.edit', compact('tripRoute'));
    }

    public function update(Request $request, TripRoute $tripRoute)
    {
        $validator = Validator::make($request->all(), [
            'origin' => 'required|string',
            'destination' => 'required|string',
            'distance' => 'required|numeric',
            'estimated_travel_time' => 'required|date_format:H:i',
            'route_code' => 'required|string|unique:trip_routes,route_code,' . $tripRoute->id,
            // Add validation rules for other fields here
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $tripRoute->update($request->all());

        // Optionally, you can add a success message and redirect to the trip route details page
        return redirect()->route('trip_routes.index')
            ->with('success', 'Trip route updated successfully!');
    }

    public function destroy(TripRoute $tripRoute)
    {
        $tripRoute->delete();

        // Optionally, you can add a success message and redirect to the trip route list page
        return redirect()->route('trip_routes.index')
            ->with('success', 'Trip route deleted successfully!');
    }
}
