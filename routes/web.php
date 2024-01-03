<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('bookings.index');
});

Route::resource('bookings', BookingController::class);
Route::post('bookings/checkbooking', [BookingController::class, 'checkBooking'])->name('bookings.checkBooking');
