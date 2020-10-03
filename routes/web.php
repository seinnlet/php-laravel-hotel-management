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

Route::get('/', 'FrontendController@index')->name('home');
Route::prefix('roomtypes')->name('roomtypes.')->group(function () {
	Route::get('/{id}/detail', 'FrontendController@roomtypedetail')->name('detail');
	Route::get('/list', 'FrontendController@list')->name('list');
});

Auth::routes();
Route::get('admin/login', 'LoginController@login')->name('admin.login');

// backend
Route::group(['middleware' => ['admin','role:Admin|Reservation Staff|Service Staff|Kitchen Staff']], function () {
	Route::get('dashboard', 'BackendController@dashboard')->name('dashboard');

	Route::resources([
		'membertypes' => 'MemberTypeController',
		'roomtypes' => 'RoomTypeController',
		'rooms' => 'RoomController',
		'staff' => 'StaffController',
		'guests' => 'GuestController',
		'bookings' => 'BookingController',
		'foodcategories' => 'FoodcategoryController',
		'menus' => 'MenuController',
		'orders' => 'OrderController',
		'services' => 'ServiceController',
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
		Route::get('/{id}', 'BookingController@getCheckoutDetail')->name('checkoutdetail');
		Route::post('/{id}/updatelatecheckout', 'BookingController@updateLateCheckout')->name('updatelatecheckout');
		Route::post('/{id}/store', 'BookingController@checkout')->name('checkout');
	});

	// register member 
	Route::prefix('guests')->name('guests.')->group(function () {
		Route::get('/{id}/createmember', 'GuestController@createMember')->name('createmember');
		Route::post('/{id}/storemember', 'GuestController@storeMember')->name('storemember');
	});

	// service usage
	Route::post('services/{id}/use', 'ServiceController@useService')->name('services.use');
	Route::get('services/{serviceid}/{roomid}/done', 'ServiceController@done')->name('services.done');
	Route::get('usedservices', 'ServiceController@usageList')->name('services.list');
	Route::get('rooms/{id}/clean', 'RoomController@clean')->name('rooms.clean');
});