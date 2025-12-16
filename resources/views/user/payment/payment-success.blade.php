@extends('layouts.app')

@section('title', 'Payment Successful')

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
    .success-container {
        max-width: 800px;
        margin: 3rem auto;
        padding: 0 1rem;
    }

    /* Success Card */
    .success-card {
        background: #ffffff;
        border-radius: 1rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    /* Header Section */
    .success-header {
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .success-icon {
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

    .success-icon svg {
        width: 50px;
        height: 50px;
        color: white;
    }

    .success-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin: 0;
        letter-spacing: -0.5px;
    }

    .success-subtitle {
        font-family: 'Inter', sans-serif;
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.9);
        margin-top: 0.5rem;
        font-weight: 400;
    }

    .reservation-code {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.3rem;
        font-weight: 600;
        color: white;
        margin-top: 1rem;
    }

    /* Content Section */
    .success-content {
        padding: 3rem 2.5rem;
        text-align: center;
    }

    .message-text {
        font-family: 'Inter', sans-serif;
        font-size: 1.1rem;
        color: #475569;
        margin-bottom: 2.5rem;
        line-height: 1.6;
    }

    /* Action Button */
    .btn-custom {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.1rem;
        font-weight: 600;
        padding: 1rem 3rem;
        border-radius: 0.5rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        background: #10b981;
        color: white;
    }

    .btn-custom:hover {
        background: #059669;
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(16, 185, 129, 0.4);
        color: white;
    }

    .btn-icon {
        width: 24px;
        height: 24px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .success-title {
            font-size: 2rem;
        }

        .animated-header {
            padding: 2rem 1.5rem;
        }

        .success-content {
            padding: 2rem 1.5rem;
        }

        .btn-custom {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="success-container">
    <div class="success-card">
        <!-- Animated Header -->
        <div class="animated-header success-header">
            <div class="success-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h1 class="success-title">Payment Successful!</h1>
            <p class="success-subtitle">Your reservation has been confirmed</p>
            <div class="reservation-code">{{ $reservation->reservation_code }}</div>
        </div>

        <!-- Content -->
        <div class="success-content">
            <p class="message-text">
                Your reservation <strong>{{ $reservation->reservation_code }}</strong> has been paid.
            </p>
            
            <a href="{{ route('my.bookings') }}" class="btn-custom">
                <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Go to My Bookings
            </a>
        </div>
    </div>
</div>
@endsection