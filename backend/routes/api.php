<?php

use App\Http\Controllers\Api\AmenityController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\BookingStatusController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\MealController;
use App\Http\Controllers\Api\RoomBedTypeController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\RoomStatusController;
use App\Http\Controllers\Api\RoomTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Formularz kontaktowy
Route::post('contact', [ContactController::class, 'ContactForm']);

// Amenities - Udogodnienia
Route::group(['prefix' => '/amenities'], function() {
    Route::get('/', [AmenityController::class, 'index']);
    Route::get('/{id}', [AmenityController::class, 'show']);
});

// Bookings - Rezerwacje
Route::group(['prefix' => '/bookings'], function() {
    Route::get('/', [BookingController::class, 'index']);
    Route::get('available-rooms', [BookingController::class, 'availableRooms']);
    Route::post('check', [BookingController::class, 'checkAvailability']);
    Route::post('create', [BookingController::class, 'create']);
    Route::get('/{id}', [BookingController::class, 'show']);
});

// Booking Statuses - Statusy rezerwacji
Route::group(['prefix' => '/booking-statuses'], function() {
    Route::get('/', [BookingStatusController::class, 'index']);
    Route::get('/{id}', [BookingStatusController::class, 'show']);
});

// Customers - Klienci
Route::group(['prefix' => '/customers'], function() {
    Route::get('/', [CustomerController::class, 'index']);
    Route::get('/{id}', [CustomerController::class, 'show']);
});

// Rooms - Pokoje
Route::group(['prefix' => '/rooms'], function() {
    Route::get('/', [RoomController::class, 'index']);
    Route::get('/available', [RoomController::class, 'available']);
    Route::get('/{id}', [RoomController::class, 'show']);
});

// Room Bed Types - Typy łóżek w pokojach
Route::group(['prefix' => '/room-bed-types'], function() {
    Route::get('/', [RoomBedTypeController::class, 'index']);
    Route::get('/{id}', [RoomBedTypeController::class, 'show']);
});

// Room Bed Types - Typy łóżek w pokojach
Route::group(['prefix' => '/room-statuses'], function() {
    Route::get('/', [RoomStatusController::class, 'index']);
    Route::get('/{id}', [RoomStatusController::class, 'show']);
});

// Room Types - Typy pokoi
Route::group(['prefix' => '/room-types'], function() {
    Route::get('/', [RoomTypeController::class, 'index']);
//    Route::get('/available', [RoomController::class, 'available']);
    Route::get('/{id}', [RoomTypeController::class, 'show']);
});

// Meals - Wyżywienie
Route::group(['prefix' => '/meals'], function() {
    Route::get('/', [MealController::class, 'index']);
//    Route::get('/available', [RoomController::class, 'available']);
    Route::get('/{id}', [MealController::class, 'show']);
});
