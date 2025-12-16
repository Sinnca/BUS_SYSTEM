@extends('layouts.app')

@section('title', 'Complete Payment')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-4">
                    <h1 class="display-5 fw-bold text-primary mb-2">Complete Your Payment</h1>
                    <p class="text-muted">Secure payment powered by Stripe</p>
                </div>

                <div class="card shadow-lg border-0">
                    <div class="card-body p-4 p-md-5">
                        <!-- Reservation Details -->
                        <div class="reservation-details mb-4 p-4 bg-light rounded">
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="text-muted small mb-1">Reservation Code</label>
                                    <h5 class="text-black mb-0 fw-bold">{{ $reservation->reservation_code }}</h5>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <label class="text-muted small mb-1">Total Amount</label>
                                    <h3 class="mb-0 text-primary fw-bold">₱{{ number_format($reservation->total_price, 2) }}</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Form -->
                        <form id="payment-form" method="POST">
                            @csrf
                            
                            <div class="mb-4 text-white">
                                <label class="form-label fw-semibold mb-3">
                                    <i class="fas fa-credit-card me-2"></i>Card Information
                                </label>
                                <div id="card-element" class="form-control p-3" style="height: auto; border: 2px solid #e0e0e0; border-radius: 8px;"></div>
                            </div>

                            <!-- Payment Message -->
                            <div id="payment-message" class="alert alert-danger d-none mb-4" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span id="payment-message-text"></span>
                            </div>

                            <!-- Submit Button -->
                            <button id="submit" type="button" class="btn btn-primary btn-lg w-100 py-3 fw-semibold">
                                <i class="fas fa-lock me-2"></i>
                                <span id="button-text">Pay ₱{{ number_format($reservation->total_price, 2) }}</span>
                            </button>

                            <!-- Security Badge -->
                            <div class="text-center mt-4">
                                <p class="small text-white mb-0">
                                    <i class="fas fa-shield-alt text-success me-1"></i>
                                    Secured by Stripe • Your payment information is encrypted
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Custom Card Element Styling */
        #card-element {
            background-color: #ffffff;
            transition: border-color 0.2s ease;
        }

        #card-element:focus-within {
            border-color: #0d6efd !important;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }

        /* Payment Button Styling */
        #submit {
            border-radius: 8px;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            border: none;
        }

        #submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
        }

        #submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Card Styling */
        .card {
            border-radius: 16px;
            overflow: hidden;
        }

        .reservation-details {
            border-left: 4px solid #0d6efd;
        }

        /* Spinner Animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 0.8s linear infinite;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
            
            .card-body {
                padding: 1.5rem !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        console.log('Payment script loaded');

        const stripe = Stripe('{{ env("STRIPE_KEY") }}');
        const elements = stripe.elements({
            fonts: [{
                cssSrc: 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap',
            }]
        });
        
        const cardElement = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#32325d',
                    fontFamily: '"Inter", sans-serif',
                    fontSmoothing: 'antialiased',
                    '::placeholder': {
                        color: '#aab7c4',
                    },
                },
                invalid: {
                    color: '#dc3545',
                    iconColor: '#dc3545',
                },
            },
        });
        
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit');
        const buttonText = document.getElementById('button-text');
        const paymentMessage = document.getElementById('payment-message');
        const paymentMessageText = document.getElementById('payment-message-text');

        // Show validation errors
        cardElement.on('change', (event) => {
            if (event.error) {
                showError(event.error.message);
            } else {
                hideError();
            }
        });

        // Handle form submission
        submitButton.addEventListener('click', async (e) => {
            e.preventDefault();
            console.log('Pay button clicked');

            submitButton.disabled = true;
            buttonText.innerHTML = '<span class="spinner me-2"></span>Processing...';
            hideError();

            // Create PaymentMethod
            const {paymentMethod, error} = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
            });

            if (error) {
                console.error('Stripe error:', error);
                showError(error.message);
                resetButton();
                return;
            }

            console.log('PaymentMethod created:', paymentMethod.id);

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
                console.log('Backend response:', data);

                if (data.requires_action) {
                    console.log('3D Secure required');
                    buttonText.innerHTML = '<span class="spinner me-2"></span>Verifying...';
                    
                    const {error: confirmError} = await stripe.confirmCardPayment(
                        data.payment_intent_client_secret
                    );

                    if (confirmError) {
                        console.error('3D Secure error:', confirmError);
                        showError(confirmError.message);
                        resetButton();
                    } else {
                        console.log('Payment succeeded after 3D Secure');
                        buttonText.innerHTML = '<i class="fas fa-check me-2"></i>Payment Successful!';
                        setTimeout(() => {
                            window.location.href = '{{ route("payment.success", $reservation->id) }}';
                        }, 1000);
                    }
                } else if (data.success) {
                    console.log('Payment succeeded');
                    buttonText.innerHTML = '<i class="fas fa-check me-2"></i>Payment Successful!';
                    setTimeout(() => {
                        window.location.href = '{{ route("payment.success", $reservation->id) }}';
                    }, 1000);
                } else {
                    console.error('Payment failed:', data.message);
                    showError(data.message || 'Payment failed. Please try again.');
                    resetButton();
                }
            } catch (err) {
                console.error('Fetch error:', err);
                showError('Payment failed. Please try again.');
                resetButton();
            }
        });

        function showError(message) {
            paymentMessageText.textContent = message;
            paymentMessage.classList.remove('d-none');
            paymentMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        function hideError() {
            paymentMessage.classList.add('d-none');
        }

        function resetButton() {
            submitButton.disabled = false;
            buttonText.innerHTML = 'Pay ₱{{ number_format($reservation->total_price, 2) }}';
        }
    </script>
@endpush