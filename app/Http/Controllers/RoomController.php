<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Roomtype;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();

        $day = new Carbon('first day of this month');
        $day = $day->format('Y-m-d');
        $lastday = new Carbon('last day of this month');
        $lastday = (int) $lastday->format('d');

        $firstsatday = new Carbon('first Saturday of this month');
        $firstsatday = (int) $firstsatday->format('d');

        $checkinrooms = array();
        for ($i=0; $i < $lastday; $i++) { 
            $roomcounts = DB::table('rooms')
                        ->join('booking_room', 'booking_room.room_id', '=', 'rooms.id')
                        ->join('bookings', 'booking_room.booking_id', '=', 'bookings.id')
                        ->select('rooms.roomno')
                        ->where('bookings.status', '!=', 'cancel')
                        ->whereRaw('"'.$day.'" between `bookstartdate` and `bookenddate`')
                        ->get();
            $day = date('Y-m-d', strtotime($day . ' +1 day'));
            array_push($checkinrooms, $roomcounts);
        }

        return view('backend.room.index', compact('rooms', 'checkinrooms', 'lastday', 'firstsatday'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roomtypes = Roomtype::orderBy('name')->get();
        return view('backend.room.create', compact('roomtypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'to.required' => '* Please enter No of Room you want to create.',
            'roomtype_id.numeric' => '* Please select Room Type.',
            'floor.numeric' => '* Please select Floor of the Room.'
        ];
        // dd($request);
        $validatedData = $request->validate([
            'to' => 'required',
            'roomno' => 'required',
            'roomtype_id' => 'required|numeric',
            'floor' => 'required|numeric'
        ], $messages);

        
        $roomno = (int) $request->roomno;
        $to = $request->to;
        $skipno = $request->skipno == 'default' ? '' : $request->skipno;

        $j = 0;
        for ($i=0; $i < $to; $i++) { 
            if ($skipno != $roomno) {
                $room = new Room;
                $room->roomno = $roomno;
                $room->roomtype_id = $request->roomtype_id;
                $room->status = 1;
                $room->save();
                $j++;
            } 
            $roomno++;
        }
        return redirect()->route('rooms.index')->withSuccessMessage($j . ($j == 1 ? ' New Room is' : ' New Rooms are') .' Successfully Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::find($id);
        $roomtypes = Roomtype::orderBy('name')->get();
        return view('backend.room.edit', compact('room','roomtypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'roomno.required' => '* Please enter Room No.',
            'roomno.unique' => '* This Room No is already Existed.',
            'roomtype_id.numeric' => '* Please select Room Type.',
        ];
        // dd($request);
        $validatedData = $request->validate([
            'roomno' => 'required|unique:App\Room,roomno,'.$id,
            'roomtype_id' => 'required|numeric',
        ], $messages);

        $room = Room::find($id);
        $room->roomno = $request->roomno;
        $room->roomtype_id = $request->roomtype_id;
        $room->save();

        return redirect()->route('rooms.index')->withSuccessMessage('Room '. $room->roomno . ' is Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::find($id);
        $room->delete();

        return redirect()->route('rooms.index')->withSuccessMessage('Room '. $room->roomno. ' is Successfully Deleted.');
    }

    public function getRoomNo($floor)
    {
        $room = Room::where('roomno', 'like', $floor.'%')
                   ->orderBy('roomno', 'desc')
                   ->first();
        // dd($room->roomno);
        $roomno = $room ? $room->roomno : '';
        return response()->json(['latestroomno'=> $roomno]);
    }

    public function clean($id)
    {
        $room = Room::find($id);
        $isclean = false;
        if ($room->status != 3) {
            $room->status = 3;
            $room->save();
            $isclean = true;
        } else {
            $checkroom = Room::whereHas('bookings', function ($query) {
                    $query->where('bookings.status', 'check in'); })
                    ->where('id', $id)->get();
            if(count($checkroom)) {
                $room->status = 2;
                $room->save();
            } else {
                $room->status = 1;
                $room->save();
            }
        }

        return redirect()->route('rooms.index')->withSuccessMessage('Room '. $room->roomno . ' is '.  ($isclean ? 'now being Cleaned.' : ' has been Cleaned.'));
    }

    public function getCheckinRooms($month, $year)
    {
        $day = $year.'-'.$month.'-01';
        $fullnamemonth = date("F", mktime(0, 0, 0, $month, 10));

        $lastday = new Carbon('last day of '.$fullnamemonth.' '.$year);
        $lastday = (int) $lastday->format('d');

        $firstsatday = new Carbon('first Saturday of '.$fullnamemonth.' '.$year);
        $firstsatday = (int) $firstsatday->format('d');

        $checkinrooms = array();
        for ($i=0; $i < $lastday; $i++) { 
            $roomcounts = DB::table('rooms')
                        ->join('booking_room', 'booking_room.room_id', '=', 'rooms.id')
                        ->join('bookings', 'booking_room.booking_id', '=', 'bookings.id')
                        ->select('rooms.roomno')
                        ->where('bookings.status', '!=', 'cancel')
                        ->whereRaw('"'.$day.'" between `bookstartdate` and `bookenddate`')
                        ->get();
            $day = date('Y-m-d', strtotime($day . ' +1 day'));
            array_push($checkinrooms, $roomcounts);
        }

        $rooms = Room::select('roomno')->orderBy('roomno')->get();

        return response()->json([
                'rooms' => $rooms,
                'checkinrooms' => $checkinrooms,
                'lastday' => $lastday,
                'firstsatday' => $firstsatday
            ]);
    }
}
