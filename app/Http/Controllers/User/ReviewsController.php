<?php

namespace App\Http\Controllers\User;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ReviewsController extends Controller
{
    /**
     * Display a listing of reviews.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::all();
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new review.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // You can fetch the list of available buses and trip routes here to display in the review form
        // Example: $buses = Bus::all();
        //          $tripRoutes = TripRoute::all();
        //          return view('reviews.create', compact('buses', 'tripRoutes'));

        return view('reviews.create');
    }

    /**
     * Store a newly created review in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation rules for the review form
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'bus_id' => 'required|exists:buses,id',
            'trip_route_id' => 'required|exists:trip_routes,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return redirect()->route('reviews.create')
                ->withErrors($validator)
                ->withInput();
        }

        Review::create($request->all());

        // Optionally, you can add a success message and redirect to the reviews list page
        return redirect()->route('reviews.index')
            ->with('success', 'Review created successfully!');
    }

    /**
     * Display the specified review.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified review.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified review in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        // Validation rules for the review form (similar to the store method)
        // ...

        // if ($validator->fails()) {
        //     return redirect()->route('reviews.edit', $review->id)
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $review->update($request->all());

        // Optionally, you can add a success message and redirect to the reviews list page
        return redirect()->route('reviews.index')
            ->with('success', 'Review updated successfully!');
    }

    /**
     * Remove the specified review from the database.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();

        // Optionally, you can add a success message and redirect to the reviews list page
        return redirect()->route('reviews.index')
            ->with('success', 'Review deleted successfully!');
    }
}
