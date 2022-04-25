<?php

declare(strict_types=1);

use App\Orchid\Screens\Amenity\AmenityEditScreen;
use App\Orchid\Screens\Amenity\AmenityListScreen;
use App\Orchid\Screens\Booking\BookingEditScreen;
use App\Orchid\Screens\Booking\BookingListScreen;
use App\Orchid\Screens\BookingStatus\BookingStatusEditScreen;
use App\Orchid\Screens\BookingStatus\BookingStatusListScreen;
use App\Orchid\Screens\Customer\CustomerEditScreen;
use App\Orchid\Screens\Customer\CustomerListScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\Meal\MealEditScreen;
use App\Orchid\Screens\Meal\MealListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\Room\RoomEditScreen;
use App\Orchid\Screens\Room\RoomListScreen;
use App\Orchid\Screens\RoomBedType\RoomBedTypeEditScreen;
use App\Orchid\Screens\RoomBedType\RoomBedTypeListScreen;
use App\Orchid\Screens\RoomStatus\RoomStatusEditScreen;
use App\Orchid\Screens\RoomStatus\RoomStatusListScreen;
use App\Orchid\Screens\RoomType\RoomTypeEditScreen;
use App\Orchid\Screens\RoomType\RoomTypeListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Platform > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('User'), route('platform.systems.users.edit', $user));
    });

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.systems.users.create'));
    });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

// Platform > System > Roles > Role
Route::screen('roles/{roles}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Example screen');
    });

Route::screen('example-fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('example-layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('example-charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('example-editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('example-cards', ExampleCardsScreen::class)->name('platform.example.cards');
Route::screen('example-advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');

//Route::screen('idea', 'Idea::class','platform.screens.idea');

// Amenities (Udogodnienia)
Route::screen('amenity/{amenity?}', AmenityEditScreen::class)->name('platform.amenity.edit');
Route::screen('amenities', AmenityListScreen::class)->name('platform.amenity.list');

// Bookings
Route::screen('booking/{booking?}', BookingEditScreen::class)->name('platform.booking.edit');
Route::screen('bookings', BookingListScreen::class)->name('platform.booking.list');

// BookingStatuses
Route::screen('booking-status/{bookingstatus?}', BookingStatusEditScreen::class)->name('platform.booking-status.edit');
Route::screen('booking-statuses', BookingStatusListScreen::class)->name('platform.booking-status.list');

// Customers
Route::screen('customer/{customer?}', CustomerEditScreen::class)->name('platform.customer.edit');
Route::screen('customers', CustomerListScreen::class)->name('platform.customer.list');

// RoomTypes
Route::screen('meal/{meal?}', MealEditScreen::class)->name('platform.meal.edit');
Route::screen('meals', MealListScreen::class)->name('platform.meal.list');

// Rooms
Route::screen('room/{room?}', RoomEditScreen::class)->name('platform.room.edit');
Route::screen('rooms', RoomListScreen::class)->name('platform.room.list');

// RoomBedTypes
Route::screen('room-bed-type/{roombedtype?}', RoomBedTypeEditScreen::class)->name('platform.room-bed-type.edit');
Route::screen('room-bed-types', RoomBedTypeListScreen::class)->name('platform.room-bed-type.list');

// RoomStatuses
Route::screen('room-status/{roomstatus?}', RoomStatusEditScreen::class)->name('platform.room-status.edit');
Route::screen('room-statuses', RoomStatusListScreen::class)->name('platform.room-status.list');

// RoomTypes
Route::screen('room-type/{roomtype?}', RoomTypeEditScreen::class)->name('platform.room-type.edit');
Route::screen('room-types', RoomTypeListScreen::class)->name('platform.room-type.list');

