<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Http\Controllers\BookingController;

class StripeController extends Controller
{
    public function checkout($booking)
    {
        $booking = Booking::findOrFail($booking);
        return view('checkout', compact('booking'));
    }

    public function session(Request $request, $booking)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
 
        $booking = Booking::findOrFail($booking);
        $productname = "Booking #{$booking->id} Payment";
        $total = (int) ($booking->accepted_price ?? $booking->offer_price) * 100; // Stripe requires amount in cents
 
        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'MVR',
                        'product_data' => [
                            "name" => $productname,
                        ],
                        'unit_amount'  => $total,
                    ],
                    'quantity'   => 1,
                ],
                 
            ],
            'mode'        => 'payment',
            'success_url' => route('success', ['booking' => $booking->id]),
            'cancel_url'  => route('checkout', ['booking' => $booking->id]),
        ]);
 
        return redirect()->away($session->url);
    }

    public function success($booking)
    {
        // Redirect back to the seeker dashboard with success message
        return redirect()->route('posts.poster-bookings')->with('accepted', 'Payment Successful! Your Tasker will be notified of the payment shortly.');
    }
}