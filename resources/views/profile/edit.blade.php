@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <div class="container py-4">

        <h2 class="mb-4 fw-bold" style="color: #333;">My Profile</h2>

        <!-- Update Profile Information -->
        <div class="mb-5">
            @include('profile.partials.update-profile-information-form')
        </div>

        <hr class="my-4">

        <!-- Update Password -->
        <div class="mb-5">
            @include('profile.partials.update-password-form')
        </div>

        <hr class="my-4">

        <!-- Delete Account -->
        <div class="mb-5">
            @include('profile.partials.delete-user-form')
        </div>

    </div>

    @push('styles')
        <style>
            /* Enhance buttons */
            button, input[type="submit"] {
                border-radius: 0.5rem;
                padding: 0.5rem 1.5rem;
                font-weight: 500;
                transition: all 0.2s;
            }

            button:hover, input[type="submit"]:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            }

            /* Make Save buttons more visible */
            .btn-primary {
                background-color: #4b6cb7;
                border-color: #4b6cb7;
                color: #fff;
            }

            .btn-primary:hover {
                background-color: #3a539b;
                border-color: #3a539b;
                color: #fff;
            }

            /* Optional: minimalist input styling */
            input, select, textarea {
                border-radius: 0.4rem;
                border: 1px solid #ccc;
                padding: 0.5rem 0.75rem;
            }
        </style>
    @endpush

@endsection
