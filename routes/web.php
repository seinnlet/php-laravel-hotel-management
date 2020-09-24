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
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

// backend
Route::group(['middleware' => ['auth','role:Admin|Reservation Staff|Service Staff|Chef']], function () {
	Route::get('dashboard', 'BackendController@dashboard')->name('dashboard');

	Route::resources([
		'membertypes' => 'MemberTypeController',
		'roomtypes' => 'RoomTypeController',
		'rooms' => 'RoomController',
		'staff' => 'StaffController',
		'guests' => 'GuestController',
		'bookings' => 'BookingController',
	]); 

	// ajax
	Route::get('getroomno/{floor}', 'RoomController@getRoomNo')->name('rooms.getroomno');
	Route::get('getguestdata/{id}', 'BookingController@getGuestData')->name('bookings.getguestdata');
	Route::get('getavailablerooms/{startdate}/{enddate}', 'BookingController@getAvailableRooms')->name('bookings.getavailablerooms');
	Route::get('gettotalcost', 'BookingController@getTotalCost')->name('bookings.gettotalcost');

	// booking check in, check out routes
	Route::prefix('checkin')->name('bookings.')->group(function () {
		Route::get('/', 'BookingController@getCheckinList')->name('checkinindex');
		Route::get('/{id}', 'BookingController@getCheckinDetail')->name('checkindetail');
		Route::post('/{id}/update', 'BookingController@updateBookingRoom')->name('updatebookingroom');
		Route::get('/{id}/store', 'BookingController@checkin')->name('checkin');
	});
	Route::prefix('checkout')->name('bookings.')->group(function () {
		Route::get('/', 'BookingController@getCheckoutList')->name('checkoutindex');
	});
});