<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// backend
Route::middleware('auth')->group(function () {
	Route::get('dashboard', 'BackendController@dashboard')->name('dashboard');

	Route::resource('membertypes', 'MemberTypeController');

	Route::resource('roomtypes', 'RoomTypeController');

	Route::resource('rooms', 'RoomController');
	Route::get('getroomno/{floor}', 'RoomController@getRoomNo')->name('rooms.getroomno');

	Route::resource('staff', 'StaffController');

	Route::resource('guests', 'GuestController');

	Route::resource('bookings', 'BookingController');
});