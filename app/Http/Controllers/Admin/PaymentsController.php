<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PaymentsController extends Controller
{
    /**
     * Display a listing of payments.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::all();
        return view('admin.payments', compact('payments'));
    }

    /**
     * Show the form for creating a new payment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // You can fetch the list of available bookings and payment methods here to display in the payment form
        // Example: $bookings = Booking::all();
        //          $paymentMethods = ['credit_card', 'paypal', 'bank_transfer'];
        //          return view('payments.create', compact('bookings', 'paymentMethods'));

        return view('payments.create');
    }

    /**
     * Store a newly created payment in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation rules for the payment form
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'transaction_id' => 'required|string|unique:payments,transaction_id',
            'status' => 'required|string|in:pending,completed,failed',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return redirect()->route('payments.create')
                ->withErrors($validator)
                ->withInput();
        }

        Payment::create($request->all());

        // Optionally, you can add a success message and redirect to the payments list page
        return redirect()->route('payments.index')
            ->with('success', 'Payment created successfully!');
    }

    /**
     * Display the specified payment.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified payment.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        return view('payments.edit', compact('payment'));
    }

    /**
     * Update the specified payment in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        // Validation rules for the payment form (similar to the store method)
        // ...

        // if ($validator->fails()) {
        //     return redirect()->route('payments.edit', $payment->id)
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $payment->update($request->all());

        // Optionally, you can add a success message and redirect to the payments list page
        return redirect()->route('payments.index')
            ->with('success', 'Payment updated successfully!');
    }

    /**
     * Remove the specified payment from the database.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        // Optionally, you can add a success message and redirect to the payments list page
        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully!');
    }
}
