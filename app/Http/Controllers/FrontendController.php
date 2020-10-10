<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roomtype;
use App\Food;
use App\Foodcategory;
use App\Booking;
use App\Guest;
use App\Country;
use App\Membertype;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
		$month = date('m');
		$bestroomtype = DB::table('roomtypes')
					->join('rooms', 'roomtypes.id', '=', 'rooms.roomtype_id')
					->join('booking_room', 'booking_room.room_id', '=', 'rooms.id')
					->join('bookings', 'booking_room.booking_id', '=', 'bookings.id')
					->select('roomtypes.*', DB::raw('count(rooms.id) as count'))
					->whereMonth('bookings.bookstartdate', $month)
					->groupBy('rooms.roomtype_id')
					->orderBy('count', 'desc')
					->first();
		if (!$bestroomtype) {
            $bestroomtype = Roomtype::find(1);
        }
		$roomtypes = Roomtype::where('id', '!=', $bestroomtype->id)->limit(4)->get();
		$footerroomtypes = Roomtype::limit(5)->get();
		// dd($roomtypes);

		return view('frontend.index', compact('bestroomtype', 'roomtypes', 'footerroomtypes'));
}

    public function roomtypedetail($id)
    {
		$roomtype = Roomtype::find($id);
		$footerroomtypes = Roomtype::limit(5)->get();
		return view('frontend.roomtype.detail', compact('roomtype', 'footerroomtypes'));
    }

    public function list()
    {
        $roomtypes = Roomtype::all();
        $footerroomtypes = Roomtype::limit(5)->get();
        return view('frontend.roomtype.list', compact('roomtypes', 'footerroomtypes'));
    }

    public function hotelservicelist()
    {
        $footerroomtypes = Roomtype::limit(5)->get();
        return view('frontend.hotelservice.index', compact('footerroomtypes'));
    }

    public function menulist()
    {
        $footerroomtypes = Roomtype::limit(5)->get();
        $food = Food::all();
        $foodcategories = Foodcategory::all();
        return view('frontend.hotelservice.menu', compact('footerroomtypes', 'food', 'foodcategories'));
    }

    public function servicelist()
    {
        $footerroomtypes = Roomtype::limit(5)->get();
        return view('frontend.hotelservice.menu', compact('footerroomtypes'));
    }

    public function orderfood()
    {
        $bookings = Booking::where('guest_id', Auth::user()->guest->id)
                    ->where('status', 'check in')->get();
        $footerroomtypes = Roomtype::limit(5)->get();
        return view('frontend.hotelservice.orderfood', compact('footerroomtypes', 'bookings'));
    }

    // guest information 
    public function profile()
    {
        $guest = Guest::find(Auth::user()->guest->id);
        if ($guest->membertype_id) {
            $nextlevel = Membertype::where('level', $guest->membertype->level + 1)->first();
        } else {
            $nextlevel = "";
        }
        $countries = Country::all();
        $footerroomtypes = Roomtype::limit(5)->get();

        $totalnight = Booking::where('guest_id', Auth::user()->guest->id)
                    ->where('status', 'check out')->sum('duration');
        $totalstay = Booking::where('guest_id', Auth::user()->guest->id)
                    ->where('status', 'check out')->count();
        $totalamount = Booking::where('guest_id', Auth::user()->guest->id)
                    ->where('status', 'check out')->sum('grandtotal');

        return view('frontend.guest.profile', compact('footerroomtypes', 'guest', 'nextlevel', 'countries', 'totalnight', 'totalstay', 'totalamount'));
    }

}
