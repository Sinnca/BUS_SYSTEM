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
                <form id="payment-form" action="{{ route('payment.process', $reservation->id) }}" method="POST">
                    @csrf

                    <div id="card-element" class="mb-3"></div>

                    <button id="submit" class="btn btn-primary">
                        Pay Now
                    </button>

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
        const card = elements.create('card');
        card.mount("#card-element");

        const form = document.getElementById("payment-form");
        const message = document.getElementById("payment-message");
        const submitBtn = document.getElementById("submit");

        form.addEventListener("submit", async (e) => {
            e.preventDefault();

            submitBtn.disabled = true;

            const { paymentMethod, error } = await stripe.createPaymentMethod({
                type: "card",
                card: card
            });

            if (error) {
                message.style.display = "block";
                message.textContent = error.message;
                submitBtn.disabled = false;
                return;
            }

            const response = await fetch(form.action, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    payment_method_id: paymentMethod.id
                })
            });

            const data = await response.json();

            if (data.requires_action) {
                const result = await stripe.confirmCardPayment(data.payment_intent_client_secret);
                if (result.error) {
                    message.style.display = "block";
                    message.textContent = result.error.message;
                    submitBtn.disabled = false;
                } else {
                    window.location.href = '{{ route("payment.success", $reservation->id) }}';
                }
            } else if (data.success) {
                window.location.href = '{{ route("payment.success", $reservation->id) }}';
            } else {
                message.style.display = "block";
                message.textContent = data.message;
                submitBtn.disabled = false;
            }
        });
    </script>
@endsection
