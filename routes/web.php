<?php

use App\Http\Controllers\Admin\ScheduleGeneratorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\Admin\TripController as AdminTripController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;

// User Controllers
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\TripController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\DashboardController;
//email
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
// Verification notice page
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

// Send verification email again
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Verify user after clicking the email link
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard'); // redirect after verifying
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/dashboard', function () {
    return view('user.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root route - redirect to home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/trips', [\App\Http\Controllers\User\TripController::class, 'index'])
    ->name('trips.index');

// Public Routes (accessible without login)
Route::get('/trips/search', [TripController::class, 'search'])->name('trips.search');
Route::get('/trips/{trip}', [TripController::class, 'show'])->name('trips.show');

// Authenticated User Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // User Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/my-bookings', [DashboardController::class, 'bookings'])->name('my.bookings');

    // Booking Routes
    Route::get('/booking/seats/{trip}', [BookingController::class, 'showSeats'])->name('booking.seats');
    Route::post('/booking/confirm', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/confirmation/{id}', [BookingController::class, 'confirmation'])->name('booking.confirmation');

    // Profile Routes (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Buses Management
    Route::resource('buses', BusController::class);

    // Trips Management
    Route::resource('trips', AdminTripController::class);

    // Reservations Management
    Route::get('/reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/{reservation}', [AdminReservationController::class, 'show'])->name('reservations.show');
});
// ADMIN - Automatic Schedule Generator
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/schedules/generator', [ScheduleGeneratorController::class, 'index'])
        ->name('admin.schedules.generator');

    Route::post('/admin/schedules/generate', [ScheduleGeneratorController::class, 'generate'])
        ->name('admin.schedules.generate');
});

// Include Breeze authentication routes
require __DIR__ . '/auth.php';
