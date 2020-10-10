<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Booking;
use App\Staff;
use App\Guest;
use App\Room;
use App\Order;
use App\Service;
use App\Food;
use App\Foodcategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BackendController extends Controller
{
  public function dashboard() {

  	$role = Auth::user()->getRoleNames()->first();

  	if ($role == "Admin") {
			
			$bookingcount = Booking::where('status', '!=', 'cancel')->count();
			$roomcount = Room::all()->count();
			$staffcount = Staff::all()->count();
			$guestcount = Guest::all()->count();
			$membercount = Guest::has('membertype')->count();

      $linearchartbookings = Booking::select(
                  DB::raw('count(id) as bookingcount'),
                  DB::raw("DATE_FORMAT(bookstartdate, '%m') as months ")
                  )
              ->whereYear('bookstartdate', date('Y'))
              ->groupBy('months')
              ->get();

      $today = date('Y-m-d');
      $successbookingcount = Booking::where('status', 'check out')->count();
      $cancelbookingcount = Booking::where('status', 'cancel')->count();
      $allbookingcount = Booking::where('bookstartdate', '<', $today)->count();

      $month = date('m');
      $bestroomtypes = DB::table('roomtypes')
                    ->join('rooms', 'roomtypes.id', '=', 'rooms.roomtype_id')
                    ->join('booking_room', 'booking_room.room_id', '=', 'rooms.id')
                    ->join('bookings', 'booking_room.booking_id', '=', 'bookings.id')
                    ->select('roomtypes.*', DB::raw('count(rooms.id) as count'))
                    ->whereMonth('bookings.bookstartdate', $month)
                    ->groupBy('rooms.roomtype_id')
                    ->orderBy('count', 'desc')
                    ->limit(3)
                    ->get();
      
      $comingupbookings = Booking::where('status', 'booked')
                    ->whereMonth('bookstartdate', $month)
                    ->limit(5)
                    ->get();
      
      $checkinrooms = array();
      for ($i=0; $i < 10; $i++) { 
        $roomcounts = DB::table('rooms')
                      ->join('booking_room', 'booking_room.room_id', '=', 'rooms.id')
                      ->join('bookings', 'booking_room.booking_id', '=', 'bookings.id')
                      ->select('rooms.roomno')
                      ->where('bookings.status', '!=', 'cancel')
                      ->whereRaw('"'.$today.'" between `bookstartdate` and `bookenddate`')
                      ->get();
        $today = date('Y-m-d', strtotime($today . ' +1 day'));
        array_push($checkinrooms, $roomcounts);
      }


			return view('backend.dashboard', compact('bookingcount', 'roomcount', 'staffcount', 'guestcount', 'membercount', 'linearchartbookings', 'successbookingcount', 'allbookingcount', 'bestroomtypes', 'comingupbookings', 'checkinrooms', 'cancelbookingcount'));
  	
  	} else if ($role == "Reservation Staff") {
  	   
      $comingupbookingcount = Booking::where('status', 'booked')->count();
      $roomcount = Room::all()->count();
      $checkinroomcount = Room::where('status', '2')->count();
      $guestcount = Guest::all()->count();
      $membercount = Guest::has('membertype')->count();

      $linearchartbookings = Booking::select(
                  DB::raw('count(id) as bookingcount'),
                  DB::raw("DATE_FORMAT(bookstartdate, '%m') as months ")
                  )
              ->whereYear('bookstartdate', date('Y'))
              ->groupBy('months')
              ->get();

      $today = date('Y-m-d');
      $successbookingcount = Booking::where('status', 'check out')->count();
      $cancelbookingcount = Booking::where('status', 'cancel')->count();
      $allbookingcount = Booking::where('bookstartdate', '<', $today)->count();

      $month = date('m');
      $bestroomtypes = DB::table('roomtypes')
                    ->join('rooms', 'roomtypes.id', '=', 'rooms.roomtype_id')
                    ->join('booking_room', 'booking_room.room_id', '=', 'rooms.id')
                    ->join('bookings', 'booking_room.booking_id', '=', 'bookings.id')
                    ->select('roomtypes.*', DB::raw('count(rooms.id) as count'))
                    ->whereMonth('bookings.bookstartdate', $month)
                    ->groupBy('rooms.roomtype_id')
                    ->orderBy('count', 'desc')
                    ->limit(3)
                    ->get();
      
      $comingupbookings = Booking::where('status', 'booked')
                    ->whereMonth('bookstartdate', $month)
                    ->limit(5)
                    ->get();
      
      $checkinrooms = array();
      for ($i=0; $i < 10; $i++) { 
        $roomcounts = DB::table('rooms')
                      ->join('booking_room', 'booking_room.room_id', '=', 'rooms.id')
                      ->join('bookings', 'booking_room.booking_id', '=', 'bookings.id')
                      ->select('rooms.roomno')
                      ->where('bookings.status', '!=', 'cancel')
                      ->whereRaw('"'.$today.'" between `bookstartdate` and `bookenddate`')
                      ->get();
        $today = date('Y-m-d', strtotime($today . ' +1 day'));
        array_push($checkinrooms, $roomcounts);
      }


  		return view('backend.rstaffdashboard', compact('comingupbookingcount', 'roomcount', 'checkinroomcount', 'guestcount', 'membercount', 'linearchartbookings', 'successbookingcount', 'allbookingcount', 'bestroomtypes', 'comingupbookings', 'checkinrooms', 'cancelbookingcount'));
  	
  	} else if ($role == "Service Staff") {
  	
      $todayusedservicecount = DB::table('room_service')
                          ->whereDate('created_at',  Carbon::today())
                          ->count();
      $servicecount = Service::all()->count();
      $roomcount = Room::all()->count();
      $checkinroomcount = Room::where('status', '2')->count();
      $servicestaffcount = Role::with('users')->where('name', 'Service Staff')->count();

      $linechartservices = DB::table('room_service')
                ->select(
                  DB::raw('count(id) as servicecount'),
                  DB::raw("DATE_FORMAT(created_at, '%m') as months ")
                  )
                ->whereYear('created_at', date('Y'))
                ->groupBy('months')
                ->get();

      $pieservices = DB::table('services')
                ->join('room_service', 'room_service.service_id', '=', 'services.id')
                ->select('services.*', DB::raw('count(room_service.id) as count'))
                ->whereMonth('room_service.created_at', date('m'))
                ->whereYear('room_service.created_at', date('Y'))
                ->orderBy('count', 'desc')
                ->groupBy('services.id')
                ->limit(3)
                ->get();

      $todaynewservices = DB::table('room_service')
                ->join('services', 'room_service.service_id', '=', 'services.id')
                ->join('rooms', 'room_service.room_id', '=', 'rooms.id')
                ->select('room_service.*', 'rooms.roomno', 'services.name')
                ->whereDate('room_service.created_at',  Carbon::today())
                ->where('room_service.status', 'Request')
                ->orderBy('room_service.created_at', 'asc')
                ->get();

      $todaydoneservicecount = DB::table('room_service')
                ->whereDate('room_service.created_at',  Carbon::today())
                ->where('room_service.status', 'Done')
                ->count();


  		return view('backend.sstaffdashboard', compact('todayusedservicecount', 'servicecount', 'roomcount', 'checkinroomcount', 'servicestaffcount', 'linechartservices', 'pieservices', 'todaynewservices', 'todaydoneservicecount'));
  	
  	} else if ($role == "Kitchen Staff") {

      $ordercount = Order::all()->count();
      $menucount = Food::all()->count();
      $foodcategorycount = Foodcategory::all()->count();
      $kitchenstaffcount = Role::with('users')->where('name', 'Kitchen Staff')->count();

      // for charts
      $linechartorders = Order::select(
                  DB::raw('count(id) as ordercount'), 
                  DB::raw("DATE_FORMAT(created_at,'%m') as months")
                )
                ->whereYear('created_at', date('Y'))
                ->groupBy('months')
                ->get();

      $foodcategories = Foodcategory::withCount('food')->orderBy('food_count', 'desc')->get();
      
      $todayneworders = Order::whereDate('created_at',  Carbon::today())
                ->where('status', 'ordered')
                ->orderBy('created_at', 'asc')
                ->get();
      
      $todaydoneordercount = Order::whereDate('created_at',  Carbon::today())
                ->where('status', 'finished')
                ->count();

      $expensivemenus = Food::orderBy('unitprice', 'desc')->limit(2)->get();

      $topmenus = DB::table('food')
                ->join('food_order', 'food_order.food_id', '=', 'food.id')
                ->select('food.*', DB::raw('SUM(food_order.qty) as qty'))
                ->orderBy('qty', 'desc')
                ->groupBy('food.id')
                ->limit(3)
                ->get();
      // dd($topmenus);

  		return view('backend.kstaffdashboard', compact('ordercount', 'menucount', 'foodcategorycount', 'kitchenstaffcount', 'linechartorders', 'foodcategories', 'todayneworders', 'todaydoneordercount', 'expensivemenus', 'topmenus'));

  	}
	}
}
