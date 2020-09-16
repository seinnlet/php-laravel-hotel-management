<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Roomtype;

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
        return view('backend.room.index', compact('rooms'));
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
}
