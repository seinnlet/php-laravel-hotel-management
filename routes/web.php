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
Route::prefix('roomtype')->name('roomtypes.')->group(function () {
	Route::get('/{slug}', 'FrontendController@roomtypedetail')->name('detail');
	Route::get('/', 'FrontendController@list')->name('list');
});

// frontend need login routes
Route::middleware('auth')->group(function () {

	Route::prefix('hotelservices')->name('hotelservices.')->group(function () {
		Route::get('/', 'FrontendController@hotelservicelist')->name('index');

		Route::get('/menus', 'FrontendController@menulist')->name('menu');
		Route::get('/menus/order', 'FrontendController@orderfood')->name('orderfood');

		Route::get('/roomservices', 'FrontendController@servicelist')->name('roomservice');
	});

	Route::resource('orders', 'OrderController')->only('store');
	Route::resource('guests', 'GuestController')->only('update');
	
	Route::prefix('guest')->group(function () {
		Route::get('/profile', 'FrontendController@profile')->name('profile');
		Route::get('/mybookings', 'FrontendController@mybookings')->name('mybookings');
		Route::get('/mybookings/{booking}', 'FrontendController@mybookingdetail')->name('mybookingdetail');
	});

});

Auth::routes();
Route::get('admin/login', 'LoginController@login')->name('admin.login');

// backend
Route::group(['middleware' => ['admin','role:Admin|Reservation Staff|Service Staff|Kitchen Staff']], function () {
	Route::get('dashboard', 'BackendController@dashboard')->name('dashboard');

	Route::get('changepassword', 'LoginController@changepassword')->name('changepassword')->middleware('password.confirm');;
	Route::post('changepassword', 'LoginController@updatepassword')->name('updatepassword');

	Route::resources([
		'membertypes' => 'MemberTypeController',
		'roomtypes' => 'RoomTypeController',
		'rooms' => 'RoomController',
		'staff' => 'StaffController',
		'bookings' => 'BookingController',
		'foodcategories' => 'FoodcategoryController',
		'menus' => 'MenuController',
		'services' => 'ServiceController',
	]); 

	Route::resource('orders', 'OrderController')->only(['index', 'create', 'edit', 'show']);
	Route::resource('guests', 'GuestController')->except('update');

	// ajax
	Route::get('getroomno/{floor}', 'RoomController@getRoomNo')->name('rooms.getroomno');
	Route::get('getguestdata/{id}', 'BookingController@getGuestData')->name('bookings.getguestdata');
	Route::get('getavailablerooms/{startdate}/{enddate}', 'BookingController@getAvailableRooms')->name('bookings.getavailablerooms');
	Route::get('gettotalcost', 'BookingController@getTotalCost')->name('bookings.gettotalcost');
	Route::get('getcheckinrooms/{month}/{year}', 'RoomController@getCheckinRooms')->name('rooms.getcheckinrooms');

	// booking check in, check out routes
	Route::prefix('checkin')->name('bookings.')->group(function () {
		Route::get('/', 'BookingController@getCheckinList')->name('checkinindex');
		Route::get('/{id}', 'BookingController@getCheckinDetail')->name('checkindetail');
		Route::post('/{id}/update', 'BookingController@updateBookingRoom')->name('updatebookingroom');
		Route::get('/{id}/store', 'BookingController@checkin')->name('checkin');
		Route::get('/{id}/cancel', 'BookingController@cancel')->name('cancel');
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