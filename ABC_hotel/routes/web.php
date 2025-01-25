<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MealPlanController;
use App\Http\Controllers\Admin\NewsAlertController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\public\PublicController;
use App\Http\Controllers\Receptionist\DashboardController as ReceptionistDashboardController;
use App\Http\Controllers\Receptionist\InquiryController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes (accessible to everyone including guests)
//Route::get('/', function () {
//    return view('welcome');
//});

// Public routes
Route::get('/', [PublicController::class, 'home'])->name('welcome');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'submitInquiry'])->name('contact.submit');

// Room related routes
Route::get('/rooms', [PublicController::class, 'rooms'])->name('rooms');
Route::get('/rooms/{category}', [PublicController::class, 'roomCategory'])->name('rooms.category');

// Meal plans
Route::get('/meal-plans', [PublicController::class, 'mealPlans'])->name('meal-plans');

// Booking routes for guest users
Route::get('/room/{room}', [\App\Http\Controllers\public\RoomController::class, 'bookingDetails'])->name('booking.details');
Route::get('/book/{room}', [\App\Http\Controllers\public\BookingController::class, 'bookingForm'])->name('booking.form');
Route::post('/book/{room}', [\App\Http\Controllers\public\BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/confirmation/{booking}', [\App\Http\Controllers\public\BookingController::class, 'confirmation'])->name('booking.confirmation');

//News Alert routes
Route::get('/api/news-alerts', [\App\Http\Controllers\NewsAlertController::class, 'getActiveAlerts']);

// Authentication required routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard route with role-based redirection
    Route::get('/dashboard', function (Request $request) {
        if ($request->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($request->user()->isReceptionist()) {
            return redirect()->route('receptionist.dashboard');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');

    // Admin routes
    Route::middleware(['check.role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('rooms', RoomController::class);
        Route::resource('meal-plans', MealPlanController::class);
        Route::resource('bookings', BookingController::class);
        Route::resource('news-alerts', NewsAlertController::class);

        Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    });

    // Receptionist routes
    Route::middleware(['check.role:receptionist'])->prefix('receptionist')->name('receptionist.')->group(function () {
        Route::get('/dashboard', [ReceptionistDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('bookings', \App\Http\Controllers\Receptionist\BookingController::class);
        Route::post('bookings/{booking}/update-status', [\App\Http\Controllers\Receptionist\BookingController::class, 'updateStatus'])
            ->name('bookings.update-status');

        Route::get('rooms', [\App\Http\Controllers\Receptionist\RoomController::class, 'index'])->name('rooms.index');
        Route::patch('rooms/{room}/status', [\App\Http\Controllers\Receptionist\RoomController::class, 'updateStatus'])
            ->name('rooms.update-status');

        Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
        Route::get('/inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
        Route::post('/inquiries/{inquiry}/respond', [InquiryController::class, 'respond'])->name('inquiries.respond');
    });

    // User routes
    Route::middleware(['check.role:user'])->prefix('user')->name('user.')->group(function () {
        // Dashboard routes
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/stats', [UserDashboardController::class, 'getBookingStats'])->name('dashboard.stats');
        Route::get('/dashboard/available-rooms', [UserDashboardController::class, 'getAvailableRooms'])->name('dashboard.available-rooms');

        // Profile routes
        Route::get('/profile', [UserDashboardController::class, 'profile'])->name('profile');

        // Booking routes
        Route::resource('bookings', \App\Http\Controllers\User\BookingController::class);
        Route::post('bookings/{booking}/cancel', [\App\Http\Controllers\User\BookingController::class, 'cancel'])
            ->name('bookings.cancel');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
