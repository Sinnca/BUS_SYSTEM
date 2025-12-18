@extends('layouts.app')

@section('title', 'Verify Email')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-7">

            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h3 class="fw-bold mb-2">Verify Your Email</h3>

                <!-- Changed text color to white -->
                <p class="text-white">
                    Thanks for signing up! Before getting started, please verify your email
                    by clicking on the link we just sent to your inbox.
                </p>

                <p class="text-white mb-4">
                    Didn’t receive the email? We can send you another.
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success rounded-3">
                        A new verification link has been sent to your email address.
                    </div>
                @endif
                <div class="d-flex justify-content-between align-items-center mt-4">

                    {{-- Resend Verification --}}
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button class="btn btn-primary px-4 rounded-pill fw-semibold">
                            Resend Email
                        </button>
                    </form>

                    {{-- Logout --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger px-4 rounded-pill fw-semibold">
                            Log Out
                        </button>
                    </form>

                </div>


            </div>
        </div>
    </div>
@endsection
