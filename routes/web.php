<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Accounts\Login;
use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\Bookings;
use App\Http\Controllers\User\EnergyController;
use App\Http\Controllers\User\ReviewsController;
use App\Http\Controllers\User\BookingsController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\TripFareController;
use App\Http\Controllers\Admin\TripRouteController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\TransportationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Login::class, 'register'])->name('account.register');

Route::get('/auth/login', [Login::class, 'index'])->name('account.login');
Route::post('/auth/user/login', [Login::class, 'login2'])->name('login.user');

Route::get('/auth/logout', [Login::class, 'logout'])->name('account.logout');

Route::get('/auth/forgot_password', [Login::class, 'forgotPassword'])->name('account.forgotPassword');
Route::post('/auth/forgot_password/send_password_reset_link', [Login::class, 'sendResetPasswordLink'])->name('account.sendResetPasswordLink');
Route::get('/auth/reset_password/{token}', [Login::class, 'resetPassword'])->name('password.reset');
Route::post('/auth/reset_password/password/update', [Login::class, 'updatePassword'])->name('password.change');

Route::post('/auth/user/register', [Login::class, 'registerUser'])->name('account.registerUser');

// /Route::get('admin/dashboard/', [AdminDashboard::class, 'index'])->name('admin.dashboard');

//  Admin Dashboard Routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');

    Route::get('/users', [AdminDashboard::class, 'user'])->name('admin.users');
    Route::get('/users/view/{user}', [AdminDashboard::class, 'viewUser'])->name('admin.viewUser');

    Route::get('/buses', [BusController::class, 'index'])->name('buses.index');
    Route::get('/buses/create', [BusController::class, 'create'])->name('admin.createBus');
    Route::post('/buses', [BusController::class, 'store'])->name('admin.storeBus');
    Route::get('/buses/{bus}', [BusController::class, 'show'])->name('buses.show');
    Route::get('/buses/{bus}/edit', [BusController::class, 'edit'])->name('admin.editBus');
    Route::put('/buses/{bus}', [BusController::class, 'update'])->name('admin.updateBus');
    Route::delete('/buses/{bus}', [BusController::class, 'destroy'])->name('admin.deleteBus');

    Route::get('/trip_routes', [TripRouteController::class, 'index'])->name('trip_routes.index');
    Route::get('/trip_routes/create', [TripRouteController::class, 'create'])->name('admin.createTripRoute');
    Route::post('/trip_routes', [TripRouteController::class, 'store'])->name('admin.storeTripRoute');
    Route::get('/trip_routes/{tripRoute}', [TripRouteController::class, 'show'])->name('admin.showTripRoutes');
    Route::get('/trip_routes/{tripRoute}/edit', [TripRouteController::class, 'edit'])->name('admin.editTripRoute');
    Route::put('/trip_routes/{tripRoute}', [TripRouteController::class, 'update'])->name('admin.updateTripRoute');
    Route::delete('/trip_routes/{tripRoute}', [TripRouteController::class, 'destroy'])->name('admin.deleteTripRoute');


    Route::get('/trip_fares', [TripFareController::class, 'index'])->name('trip_fares.index');
    Route::get('/trip_fares/create', [TripFareController::class, 'create'])->name('admin.createTripFare');
    Route::post('/trip_fares', [TripFareController::class, 'store'])->name('admin.storeTripFare');
    Route::get('/trip_fares/{tripFare}', [TripFareController::class, 'show'])->name('trip_fares.show');
    Route::get('/trip_fares/{tripFare}/edit', [TripFareController::class, 'edit'])->name('admin.editTripFare');
    Route::put('/trip_fares/{tripFare}', [TripFareController::class, 'update'])->name('admin.updateTripFare');
    Route::delete('/trip_fares/{tripFare}', [TripFareController::class, 'destroy'])->name('admin.deleteTripFare');


    Route::get('/bookings', [Bookings::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [Bookings::class, 'create'])->name('admin.createBooking');
    Route::post('/bookings', [Bookings::class, 'store'])->name('admin.storeBooking');
    Route::get('/bookings/{booking}', [Bookings::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{booking}/edit', [Bookings::class, 'edit'])->name('admin.editBooking');
    Route::put('/bookings/{booking}', [Bookings::class, 'update'])->name('admin.updateBooking');
    Route::delete('/bookings/{booking}', [Bookings::class, 'destroy'])->name('admin.deleteBooking');


    Route::get('/payments', [PaymentsController::class, 'index'])->name('payments.index');
    Route::get('/payments/create', [PaymentsController::class, 'create'])->name('admin.createPayment');
    Route::post('/payments', [PaymentsController::class, 'store'])->name('admin.storePayment');
    Route::get('/payments/{payment}', [PaymentsController::class, 'show'])->name('payments.show');
    Route::get('/payments/{payment}/edit', [PaymentsController::class, 'edit'])->name('admin.editPayment');
    Route::put('/payments/{payment}', [PaymentsController::class, 'update'])->name('admin.updatePayment');
    Route::delete('/payments/{payment}', [PaymentsController::class, 'destroy'])->name('admin.deletePayment');
});

//  Agent Dashboard Routes
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    // Route::get('/bookings', [BookingsController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [BookingsController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingsController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingsController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{booking}/edit', [BookingsController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{booking}', [BookingsController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking}', [BookingsController::class, 'destroy'])->name('bookings.destroy');

    Route::get('/reviews', [ReviewsController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/create', [ReviewsController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewsController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}', [ReviewsController::class, 'show'])->name('reviews.show');
    Route::get('/reviews/{review}/edit', [ReviewsController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [ReviewsController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewsController::class, 'destroy'])->name('reviews.destroy');
});
