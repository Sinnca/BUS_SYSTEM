@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container py-5" style="max-width: 980px;">

    <!-- Header -->
    <div class="text-center mb-5">
        <h1 class="fw-bold text-white" style="font-size: 2.2rem;">
            My Profile
        </h1>
        <p class="text-white mt-2">
            Manage your account information, security, and preferences
        </p>
    </div>

    <!-- Profile Info -->
    <div class="card shadow-lg border-0 rounded-4 mb-5">
        <div class="card-body p-4 p-md-5">
            <h5 class="fw-semibold mb-4 text-primary">
                <i class="fas fa-user-circle me-2"></i> Profile Information
            </h5>
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <!-- Password -->
    <div class="card shadow-lg border-0 rounded-4 mb-5">
        <div class="card-body p-4 p-md-5">
            <h5 class="fw-semibold mb-4 text-primary">
                <i class="fas fa-lock me-2"></i> Update Password
            </h5>
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <!-- Danger Zone -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4 p-md-5">
            <h5 class="fw-semibold mb-4 text-danger">
                <i class="fas fa-triangle-exclamation me-2"></i> Danger Zone
            </h5>
            @include('profile.partials.delete-user-form')
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    /* ===== CARD LOOK (MATCH LOGIN) ===== */
    .card {
        background: #ffffff;
        box-shadow: 0 20px 45px rgba(0,0,0,.08);
    }

    /* ===== INPUTS ===== */
    input, select, textarea {
        height: 44px;
        border-radius: 12px !important;
        border: 1px solid #e5e7eb !important;
        font-size: 0.95rem;
        padding: 0.55rem 0.9rem;
        transition: all .2s ease;
    }

    input:focus, select:focus, textarea:focus {
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 0.2rem rgba(99,102,241,.15);
    }

    textarea {
        height: auto;
    }

    /* ===== BUTTONS ===== */
    button, input[type="submit"] {
        border-radius: 12px !important;
        padding: 0.55rem 1.4rem;
        font-weight: 600;
        transition: all .2s ease;
    }

    button:hover, input[type="submit"]:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 20px rgba(0,0,0,.15);
    }

    /* Primary CTA */
    .btn-primary {
        background: linear-gradient(135deg, #4f46e5, #3b82f6);
        border: none;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #4338ca, #2563eb);
    }

    /* Danger buttons */
    .btn-danger {
        border-radius: 12px;
        font-weight: 600;
    }

    /* Section titles */
    h5 {
        letter-spacing: .3px;
    }
</style>
@endpush

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CDN (fallback / utility use) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
        rel="stylesheet"
    >