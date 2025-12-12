<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Services\BookingService;

class PaymentController extends Controller
{
    /**
     * Show the payment page for a specific reservation
     */
    public function showPaymentPage(Reservation $reservation)
    {
        return view('user.payment.payment', compact('reservation'));
    }

    /**
     * Process a payment for a reservation
     */
    public function processPayment(Request $request, Reservation $reservation)
    {
        // Set Stripe API key
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // Disable SSL verification for local development (REMOVE IN PRODUCTION)
        \Stripe\ApiRequestor::setHttpClient(
            new \Stripe\HttpClient\CurlClient([CURLOPT_SSL_VERIFYPEER => false])
        );

        // Get payment method ID from request
        $paymentMethodId = $request->input('payment_method_id');

        if (!$paymentMethodId) {
            return response()->json([
                'success' => false,
                'message' => 'Payment Method ID is missing.'
            ]);
        }

        // Calculate amount in cents
        $amount = $reservation->total_price * 100;

        try {
            // Create PaymentIntent
            $intent = \Stripe\PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'PHP', // ✅ FIXED: Changed from 'php' to 'PHP'
                'payment_method' => $paymentMethodId,
                'confirm' => true,
                'return_url' => route('payment.success', $reservation->id),
            ]);

            // Handle 3D Secure authentication required
            if ($intent->status === 'requires_action') {
                return response()->json([
                    'requires_action' => true,
                    'payment_intent_client_secret' => $intent->client_secret,
                ]);
            }

            // Payment succeeded
            if ($intent->status === 'succeeded') {
                // Update reservation status to 'confirmed' since 'paid' doesn't exist
                $reservation->status = 'confirmed';
                $reservation->save();

                return response()->json([
                    'success' => true,
                ]);
            }

            // Unexpected status
            return response()->json([
                'success' => false,
                'message' => 'Unexpected payment status: ' . $intent->status
            ]);

        } catch (\Stripe\Exception\CardException $e) {
            // Card was declined
            return response()->json([
                'success' => false,
                'message' => $e->getError()->message
            ]);
        } catch (\Exception $e) {
            // Other errors
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }



    /**
     * Show the payment success page
     */
    public function paymentSuccess(Reservation $reservation)
    {
        // Only allow confirmed reservations to see success page
        if ($reservation->status !== 'confirmed') {
            return redirect()->route('payment.page', $reservation->id)
                ->with('error', 'Payment was not completed.');
        }

        return view('user.payment.payment-success', compact('reservation'));
    }
}

