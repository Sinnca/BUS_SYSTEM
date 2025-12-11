@extends('layouts.app')

@section('title', 'Complete Payment')

@section('content')
    <div class="container">
        <h1 class="mb-4">Complete Payment</h1>

        <div class="card">
            <div class="card-body">
                <h5>Reservation Code: {{ $reservation->reservation_code }}</h5>
                <p>Total Amount: <strong>₱{{ number_format($reservation->total_price, 2) }}</strong></p>

                <!-- Stripe Payment Form -->
                <form id="payment-form">
                    @csrf
                    <div id="card-element" class="mb-3"></div>
                    <button id="submit" class="btn btn-primary">Pay Now</button>
                    <div id="payment-message" class="mt-3 text-danger" style="display:none;"></div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env("STRIPE_KEY") }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit');
        const paymentMessage = document.getElementById('payment-message');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            submitButton.disabled = true;
            paymentMessage.style.display = 'none';

            // Create PaymentMethod
            const {paymentMethod, error} = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
            });

            if (error) {
                paymentMessage.style.display = 'block';
                paymentMessage.textContent = error.message;
                submitButton.disabled = false;
                return;
            }

            // Send PaymentMethod.id to backend
            fetch('{{ route("payment.process", $reservation->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    payment_method_id: paymentMethod.id
                })
            })
                .then(res => res.json())
                .then(async data => {
                    if (data.requires_action) {
                        // Handle 3D Secure
                        const {error: confirmError} = await stripe.confirmCardPayment(
                            data.payment_intent_client_secret
                        );
                        if (confirmError) {
                            paymentMessage.style.display = 'block';
                            paymentMessage.textContent = confirmError.message;
                            submitButton.disabled = false;
                        } else {
                            window.location.href = '{{ route("payment.success", $reservation->id) }}';
                        }
                    } else if (data.success) {
                        window.location.href = '{{ route("payment.success", $reservation->id) }}';
                    } else {
                        paymentMessage.style.display = 'block';
                        paymentMessage.textContent = data.message;
                        submitButton.disabled = false;
                    }
                })
                .catch(err => {
                    paymentMessage.style.display = 'block';
                    paymentMessage.textContent = 'Payment failed. Please try again.';
                    submitButton.disabled = false;
                    console.error(err);
                });
        });
    </script>
@endsection
