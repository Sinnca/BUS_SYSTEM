{{--@extends('layouts.app')--}}

{{--@section('title', 'Complete Payment')--}}

{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        <h1 class="mb-4">Complete Payment</h1>--}}

{{--        <div class="card">--}}
{{--            <div class="card-body">--}}
{{--                <h5>Reservation Code: {{ $reservation->reservation_code }}</h5>--}}
{{--                <p>Total Amount: <strong>₱{{ number_format($reservation->total_price, 2) }}</strong></p>--}}

{{--                <!-- Stripe Payment Form -->--}}
{{--                <form id="payment-form">--}}
{{--                    @csrf--}}
{{--                    <div id="card-element" class="mb-3"></div>--}}
{{--                    <button id="submit" class="btn btn-primary">Pay Now</button>--}}
{{--                    <div id="payment-message" class="mt-3 text-danger" style="display:none;"></div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

{{--@section('scripts')--}}
{{--    <script src="https://js.stripe.com/v3/"></script>--}}
{{--    <script>--}}
{{--        const stripe = Stripe('{{ env("STRIPE_KEY") }}');--}}
{{--        const elements = stripe.elements();--}}
{{--        const cardElement = elements.create('card');--}}
{{--        cardElement.mount('#card-element');--}}

{{--        const form = document.getElementById('payment-form');--}}
{{--        const submitButton = document.getElementById('submit');--}}
{{--        const paymentMessage = document.getElementById('payment-message');--}}

{{--        form.addEventListener('submit', async (e) => {--}}
{{--            e.preventDefault();--}}
{{--            submitButton.disabled = true;--}}
{{--            paymentMessage.style.display = 'none';--}}

{{--            // Create PaymentMethod--}}
{{--            const {paymentMethod, error} = await stripe.createPaymentMethod({--}}
{{--                type: 'card',--}}
{{--                card: cardElement,--}}
{{--            });--}}

{{--            if (error) {--}}
{{--                paymentMessage.style.display = 'block';--}}
{{--                paymentMessage.textContent = error.message;--}}
{{--                submitButton.disabled = false;--}}
{{--                return;--}}
{{--            }--}}

{{--            // Send PaymentMethod.id to backend--}}
{{--            fetch('{{ route("payment.process", $reservation->id) }}', {--}}
{{--                method: 'POST',--}}
{{--                headers: {--}}
{{--                    'Content-Type': 'application/json',--}}
{{--                    'X-CSRF-TOKEN': '{{ csrf_token() }}'--}}
{{--                },--}}
{{--                body: JSON.stringify({--}}
{{--                    payment_method_id: paymentMethod.id--}}
{{--                })--}}
{{--            })--}}
{{--                .then(res => res.json())--}}
{{--                .then(async data => {--}}
{{--                    if (data.requires_action) {--}}
{{--                        // Handle 3D Secure--}}
{{--                        const {error: confirmError} = await stripe.confirmCardPayment(--}}
{{--                            data.payment_intent_client_secret--}}
{{--                        );--}}
{{--                        if (confirmError) {--}}
{{--                            paymentMessage.style.display = 'block';--}}
{{--                            paymentMessage.textContent = confirmError.message;--}}
{{--                            submitButton.disabled = false;--}}
{{--                        } else {--}}
{{--                            window.location.href = '{{ route("payment.success", $reservation->id) }}';--}}
{{--                        }--}}
{{--                    } else if (data.success) {--}}
{{--                        window.location.href = '{{ route("payment.success", $reservation->id) }}';--}}
{{--                    } else {--}}
{{--                        paymentMessage.style.display = 'block';--}}
{{--                        paymentMessage.textContent = data.message;--}}
{{--                        submitButton.disabled = false;--}}
{{--                    }--}}
{{--                })--}}
{{--                .catch(err => {--}}
{{--                    paymentMessage.style.display = 'block';--}}
{{--                    paymentMessage.textContent = 'Payment failed. Please try again.';--}}
{{--                    submitButton.disabled = false;--}}
{{--                    console.error(err);--}}
{{--                });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}
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
                <form id="payment-form" method="POST">
                    @csrf
                    <div id="card-element" class="mb-3" style="padding: 10px; border: 1px solid #ced4da; border-radius: 4px;"></div>
                    <button id="submit" type="button" class="btn btn-primary">Pay Now</button>
                    <div id="payment-message" class="mt-3 text-danger" style="display:none;"></div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        console.log('Payment script loaded'); // Debug log

        const stripe = Stripe('{{ env("STRIPE_KEY") }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit');
        const paymentMessage = document.getElementById('payment-message');

        // Show validation errors
        cardElement.on('change', (event) => {
            if (event.error) {
                paymentMessage.style.display = 'block';
                paymentMessage.textContent = event.error.message;
            } else {
                paymentMessage.style.display = 'none';
            }
        });

        // Handle form submission
        submitButton.addEventListener('click', async (e) => {
            e.preventDefault();
            console.log('Pay button clicked'); // Debug log

            submitButton.disabled = true;
            submitButton.textContent = 'Processing...';
            paymentMessage.style.display = 'none';

            // Create PaymentMethod
            const {paymentMethod, error} = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
            });

            if (error) {
                console.error('Stripe error:', error); // Debug log
                paymentMessage.style.display = 'block';
                paymentMessage.textContent = error.message;
                submitButton.disabled = false;
                submitButton.textContent = 'Pay Now';
                return;
            }

            console.log('PaymentMethod created:', paymentMethod.id); // Debug log

            // Send PaymentMethod.id to backend
            try {
                const response = await fetch('{{ route("payment.process", $reservation->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        payment_method_id: paymentMethod.id
                    })
                });

                const data = await response.json();
                console.log('Backend response:', data); // Debug log

                if (data.requires_action) {
                    console.log('3D Secure required'); // Debug log
                    // Handle 3D Secure
                    const {error: confirmError} = await stripe.confirmCardPayment(
                        data.payment_intent_client_secret
                    );

                    if (confirmError) {
                        console.error('3D Secure error:', confirmError); // Debug log
                        paymentMessage.style.display = 'block';
                        paymentMessage.textContent = confirmError.message;
                        submitButton.disabled = false;
                        submitButton.textContent = 'Pay Now';
                    } else {
                        console.log('Payment succeeded after 3D Secure'); // Debug log
                        window.location.href = '{{ route("payment.success", $reservation->id) }}';
                    }
                } else if (data.success) {
                    console.log('Payment succeeded'); // Debug log
                    window.location.href = '{{ route("payment.success", $reservation->id) }}';
                } else {
                    console.error('Payment failed:', data.message); // Debug log
                    paymentMessage.style.display = 'block';
                    paymentMessage.textContent = data.message || 'Payment failed. Please try again.';
                    submitButton.disabled = false;
                    submitButton.textContent = 'Pay Now';
                }
            } catch (err) {
                console.error('Fetch error:', err); // Debug log
                paymentMessage.style.display = 'block';
                paymentMessage.textContent = 'Payment failed. Please try again.';
                submitButton.disabled = false;
                submitButton.textContent = 'Pay Now';
            }
        });
    </script>
@endpush
