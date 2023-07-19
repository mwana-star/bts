<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bus;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BusController extends Controller
{
    /**
     * Display a listing of the buses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buses = Bus::all();
        return view('admin.buses', compact('buses'));
    }

    /**
     * Show the form for creating a new bus.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buses.create');
    }

    /**
     * Store a newly created bus in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'total_seats' => 'required|integer',
            'registration_number' => 'required|string|unique:buses',
            // Add validation rules for other fields here
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Get the input data and handle checkboxes
        $data = $request->except(['_token', '_method']);
        $data['wifi_available'] = Arr::get($data, 'wifi_available', false);
        $data['air_conditioned'] = Arr::get($data, 'air_conditioned', false);
        $data['wheelchair_accessible'] = Arr::get($data, 'wheelchair_accessible', false);

        // Create the bus record
        $bus = Bus::create($data);

        // Optionally, you can add a success message and redirect to the bus details page
        return redirect()->route('buses.index', $bus->id)
            ->with('success', 'Bus created successfully!');
    }

    /**
     * Display the specified bus.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function show(Bus $bus)
    {
        return view('buses.show', compact('bus'));
    }

    /**
     * Show the form for editing the specified bus.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bus $bus)
    {
        return view('buses.edit', compact('bus'));
    }

    /**
     * Update the specified bus in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bus $bus)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'total_seats' => 'required|integer',
            'registration_number' => 'required|string|unique:buses,registration_number,' . $bus->id,
            // Add validation rules for other fields here
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $bus->update($request->all());

        // Optionally, you can add a success message and redirect to the bus details page
        return redirect()->route('buses.index')
            ->with('success', 'Bus updated successfully!');
    }


    /**
     * Remove the specified bus from the database.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bus $bus)
    {
        $bus->delete();

        // Optionally, you can add a success message and redirect to the bus list page
        return redirect()->route('buses.index')
            ->with('success', 'Bus deleted successfully!');
    }
}
