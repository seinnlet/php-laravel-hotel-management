<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roomtype;
use Illuminate\Support\Facades\DB;

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
}
