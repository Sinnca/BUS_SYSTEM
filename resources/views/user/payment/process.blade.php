@extends('layouts.app')

@section('title', 'Complete Payment')

@section('content')
<style>
    /* Import Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap');

    /* Rotating Color Header Animation */
    @keyframes rotateColors {
        0% { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
        25% { background: linear-gradient(135deg, #059669 0%, #047857 100%); }
        50% { background: linear-gradient(135deg, #047857 0%, #065f46 100%); }
        75% { background: linear-gradient(135deg, #065f46 0%, #047857 100%); }
        100% { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
    }

    .animated-header {
        animation: rotateColors 8s ease-in-out infinite;
        padding: 3rem 2rem;
        border-radius: 1rem 1rem 0 0;
        position: relative;
        overflow: hidden;
    }

    .animated-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: rotate 15s linear infinite;
    }

    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Typography */
    body {
        font-family: 'Inter', sans-serif;
        background: #ffffff;
        min-height: 100vh;
    }

    h1, h2, h3, h4, h5, h6 {
        font-family: 'Space Grotesk', sans-serif;
    }

    /* Main Container */
    .payment-container {
        max-width: 700px;
        margin: 3rem auto;
        padding: 0 1rem;
    }

    /* Payment Card */
    .payment-card {
        background: #ffffff;
        border-radius: 1rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    /* Header Section */
    .payment-header {
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .payment-icon {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        backdrop-filter: blur(10px);
    }

    .payment-icon svg {
        width: 50px;
        height: 50px;
        color: white;
    }

    .payment-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin: 0;
        letter-spacing: -0.5px;
    }

    .payment-subtitle {
        font-family: 'Inter', sans-serif;
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.9);
        margin-top: 0.5rem;
        font-weight: 400;
    }

    /* Content Section */
    .payment-content {
        padding: 3rem 2.5rem;
    }

    /* Info Section */
    .info-section {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
    }

    .info-row:not(:last-child) {
        border-bottom: 1px solid #e2e8f0;
    }

    .info-label {
        font-family: 'Inter', sans-serif;
        font-size: 0.95rem;
        color: #64748b;
        font-weight: 500;
    }

    .info-value {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.1rem;
        color: #1e293b;
        font-weight: 600;
    }

    .info-value.large {
        font-size: 1.8rem;
        color: #10b981;
    }

    /* Form Section */
    .form-section {
        margin-top: 2rem;
    }

    .form-label {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1rem;
        color: #1e293b;
        font-weight: 600;
        margin-bottom: 0.75rem;
        display: block;
    }

    #card-element {
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 0.5rem;
        padding: 1.25rem;
        transition: all 0.3s ease;
    }

    #card-element:focus-within {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    /* Payment Button */
    .btn-payment {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.1rem;
        font-weight: 600;
        padding: 1rem;
        border-radius: 0.5rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        background: #10b981;
        color: white;
        width: 100%;
        margin-top: 1.5rem;
    }

    .btn-payment:hover:not(:disabled) {
        background: #059669;
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
        color: white;
    }

    .btn-payment:disabled {
        background: #94a3b8;
        cursor: not-allowed;
        transform: none;
    }

    .btn-icon {
        width: 24px;
        height: 24px;
    }

    /* Loading Spinner */
    .spinner {
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-top: 3px solid white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        animation: spin 0.8s linear infinite;
        display: none;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .btn-payment:disabled .spinner {
        display: block;
    }

    .btn-payment:disabled .btn-text {
        display: none;
    }

    /* Error Message */
    #payment-message {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #dc2626;
        padding: 1rem;
        border-radius: 0.5rem;
        font-family: 'Inter', sans-serif;
        font-size: 0.95rem;
        margin-top: 1rem;
    }

    /* Security Badge */
    .security-badge {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e2e8f0;
        color: #64748b;
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
    }

    .security-icon {
        width: 18px;
        height: 18px;
        color: #10b981;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .payment-title {
            font-size: 2rem;
        }

        .animated-header {
            padding: 2rem 1.5rem;
        }

        .payment-content {
            padding: 2rem 1.5rem;
        }
    }
</style>

<div class="payment-container">
    <div class="payment-card">
        <!-- Animated Header -->
        <div class="animated-header payment-header">
            <div class="payment-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
            </div>
            <h1 class="payment-title">Complete Payment</h1>
            <p class="payment-subtitle">Secure payment powered by Stripe</p>
        </div>

        <!-- Content -->
        <div class="payment-content">
            <!-- Reservation Info -->
            <div class="info-section">
                <div class="info-row">
                    <span class="info-label">Reservation Code</span>
                    <span class="info-value">{{ $reservation->reservation_code }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Total Amount</span>
                    <span class="info-value large">₱{{ number_format($reservation->total_price, 2) }}</span>
                </div>
            </div>

            <!-- Stripe Payment Form -->
            <form id="payment-form" action="{{ route('payment.process', $reservation->id) }}" method="POST">
                @csrf

                <div class="form-section">
                    <label class="form-label">
                        <svg style="width: 20px; height: 20px; display: inline-block; vertical-align: middle; margin-right: 0.5rem;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Card Information
                    </label>
                    <div id="card-element"></div>
                </div>

                <button id="submit" type="submit" class="btn-payment">
                    <span class="spinner"></span>
                    <span class="btn-text">
                        <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Pay Now
                    </span>
                </button>

                <div id="payment-message" style="display:none;"></div>

                <!-- Security Badge -->
                <div class="security-badge">
                    <svg class="security-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    Secured by Stripe SSL Encryption
                </div>
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
        const card = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#1e293b',
                    fontFamily: '"Inter", sans-serif',
                    '::placeholder': {
                        color: '#94a3b8',
                    },
                },
                invalid: {
                    color: '#dc2626',
                },
            },
        });
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