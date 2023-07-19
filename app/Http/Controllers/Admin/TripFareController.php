<?php

namespace App\Http\Controllers\Admin;

use App\Models\TripFare;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TripFareController extends Controller
{
    /**
     * Display a listing of trip fares.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tripFares = TripFare::all();
        return view('admin.trip_fares', compact('tripFares'));
    }

    /**
     * Show the form for creating a new trip fare.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trip_fares.create');
    }

    /**
     * Store a newly created trip fare in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'trip_route_id' => 'required|exists:trip_routes,id',
            'base_fare' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|string',
            'additional_fee' => 'nullable|numeric|min:0',
            'additional_fee_type' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('trip_fares.create')
                ->withErrors($validator)
                ->withInput();
        }

        TripFare::create($request->all());

        // Optionally, you can add a success message and redirect to the trip fare list page
        return redirect()->route('trip_fares.index')
            ->with('success', 'Trip fare created successfully!');
    }

    /**
     * Display the specified trip fare.
     *
     * @param  \App\Models\TripFare  $tripFare
     * @return \Illuminate\Http\Response
     */
    public function show(TripFare $tripFare)
    {
        return view('trip_fares.show', compact('tripFare'));
    }

    /**
     * Show the form for editing the specified trip fare.
     *
     * @param  \App\Models\TripFare  $tripFare
     * @return \Illuminate\Http\Response
     */
    public function edit(TripFare $tripFare)
    {
        return view('trip_fares.edit', compact('tripFare'));
    }

    /**
     * Update the specified trip fare in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TripFare  $tripFare
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TripFare $tripFare)
    {
        $validator = Validator::make($request->all(), [
            'trip_route_id' => 'required|exists:trip_routes,id',
            'base_fare' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|string',
            'additional_fee' => 'nullable|numeric|min:0',
            'additional_fee_type' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('trip_fares.edit', $tripFare->id)
                ->withErrors($validator)
                ->withInput();
        }

        $tripFare->update($request->all());

        // Optionally, you can add a success message and redirect to the trip fare list page
        return redirect()->route('trip_fares.index')
            ->with('success', 'Trip fare updated successfully!');
    }

    /**
     * Remove the specified trip fare from the database.
     *
     * @param  \App\Models\TripFare  $tripFare
     * @return \Illuminate\Http\Response
     */
    public function destroy(TripFare $tripFare)
    {
        $tripFare->delete();

        // Optionally, you can add a success message and redirect to the trip fare list page
        return redirect()->route('trip_fares.index')
            ->with('success', 'Trip fare deleted successfully!');
    }
}
