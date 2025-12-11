@extends('layouts.app')

@section('title', 'Payment Successful')

@section('content')
    <div class="container">
        <div class="alert alert-success text-center">
            <h2>Payment Successful!</h2>
            <p>Your reservation <strong>{{ $reservation->reservation_code }}</strong> has been paid.</p>
            <a href="{{ route('my.bookings') }}" class="btn btn-primary">Go to My Bookings</a>
        </div>
    </div>
@endsection
