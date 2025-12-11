<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    /**
     * Show the payment page for a specific reservation
     *
     * @param Reservation $reservation
     * @return \Illuminate\View\View
     */
    public function showPaymentPage(Reservation $reservation)
    {
        // Return the payment view located in resources/views/user/payment/payment.blade.php
        // Pass the reservation data to the view using compact()
        return view('user.payment.payment', compact('reservation'));
    }

    /**
     * Process a payment for a reservation
     *
     * @param Request $request
     * @param Reservation $reservation
     * @return \Illuminate\Http\JsonResponse
     */
    public function processPayment(Request $request, $reservationId)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // allow SSL disable for school projects
        \Stripe\ApiRequestor::setHttpClient(
            new \Stripe\HttpClient\CurlClient([CURLOPT_SSL_VERIFYPEER => false])
        );

        // read JSON body
        $data = $request->json()->all();

        if (!isset($data['payment_method_id'])) {
            return response()->json([
                'success' => false,
                'message' => 'Payment Method ID is missing.'
            ]);
        }

        $paymentMethodId = $data['payment_method_id'];

        // get amount
        $reservation = Reservation::findOrFail($reservationId);
        $amount = $reservation->total_price * 100; // cents

        try {
            // STEP 1 — Create PaymentIntent
            $intent = \Stripe\PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'php',
                'payment_method' => $paymentMethodId,
                'confirm' => true,
            ]);

            // STEP 2 — If 3D secure required
            if ($intent->status === 'requires_action') {
                return response()->json([
                    'requires_action' => true,
                    'payment_intent_client_secret' => $intent->client_secret,
                ]);
            }

            // STEP 3 — Success
            if ($intent->status === 'succeeded') {
                return response()->json([
                    'success' => true,
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Unexpected status: ' . $intent->status
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    /**
     * Show the payment success page and mark reservation as paid
     *
     * @param Reservation $reservation
     * @return \Illuminate\View\View
     */
    public function paymentSuccess(Reservation $reservation)
    {
        // Ensure reservation is marked as paid
        $reservation->status = 'paid';
        $reservation->save();

        // Redirect to a success view located at resources/views/user/payment/payment-success.blade.php
        // Pass the reservation data to the view
        return view('user.payment.payment-success', compact('reservation'));
    }
}
