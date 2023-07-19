<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class Bookings extends Controller
{
    /**
     * Display a listing of bookings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::all();
        return view('admin.bookings', compact('bookings'));
    }

    /**
     * Show the form for creating a new booking.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // You can fetch the list of available buses and trip routes here to display in the booking form
        // Example: $buses = Bus::all();
        //          $tripRoutes = TripRoute::all();
        //          return view('bookings.create', compact('buses', 'tripRoutes'));

        return view('bookings.create');
    }

    /**
     * Store a newly created booking in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation rules for the booking form
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'bus_id' => 'required|exists:buses,id',
            'trip_route_id' => 'required|exists:trip_routes,id',
            'booking_date' => 'required|date',
            'num_passengers' => 'required|integer|min:1',
            'total_cost' => 'required|numeric|min:0',
            'payment_status' => 'required|string|in:pending,completed,failed',
            'is_cancelled' => 'required|boolean',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return redirect()->route('bookings.create')
                ->withErrors($validator)
                ->withInput();
        }

        Booking::create($request->all());

        // Optionally, you can add a success message and redirect to the bookings list page
        return redirect()->route('bookings.index')
            ->with('success', 'Booking created successfully!');
    }

    /**
     * Display the specified booking.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified booking.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update the specified booking in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        // Validation rules for the booking form (similar to the store method)
        // ...

        // if ($validator->fails()) {
        //     return redirect()->route('bookings.edit', $booking->id)
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $booking->update($request->all());

        // Optionally, you can add a success message and redirect to the bookings list page
        return redirect()->route('bookings.index')
            ->with('success', 'Booking updated successfully!');
    }

    /**
     * Remove the specified booking from the database.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        // Optionally, you can add a success message and redirect to the bookings list page
        return redirect()->route('bookings.index')
            ->with('success', 'Booking deleted successfully!');
    }
}
