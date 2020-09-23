<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Payment;
use App\Roomtype;
use App\Country;
use App\User;
use App\Guest;
use App\Room;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::orderBy('bookstartdate', 'desc')->get();
        return view('backend.booking.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roomtypes = Roomtype::orderBy('created_at')->get();
        $countries = Country::all();
        // $users = User::all();
        $users = User::whereHas('roles', function($q){
                        $q->where('name', 'Guest');
                    })->get();
        // dd($users);
        return view('backend.booking.create', compact('roomtypes', 'countries', 'users'));
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
            'bookdate.required' => '* Please select Booking Date.',
            'todate.required' => '* Please select Booking Date.',
            'totalcost.required' => '* Please confirm Rooms.',
            'noofadult.required' => '* Please confirm No of People.',
            'paymenttype.regex' => '* Please select Payment Type.',
        ];

        $request->validate([
            'bookdate' => 'required',
            'todate' => 'required',
            'totalcost' => 'required',
            'noofadult' => 'required',
            'paymenttype' => 'required|regex:/^[\pL\s\-]+$/u',
        ], $messages);

        if ($request->guesttype == "new") {
            $message = [
                'email.unique' => '* This Email Address is already Existed.',
                'name.required' => '* Please enter Guest Name.',
                'email.required' => '* Please enter Email Address.',
                'phone1.required' => '* Please enter Phone Number.',
                'city.required' => '* Please enter City.',
            ];

            $request->validate([
                'name' => 'required',
                'email' => 'required|unique:App\User,email',
                'phone1' => 'required',
                'city' => 'required',
                'country' => 'required'
            ], $message);
        }

        // check the guest first
        $guest_id = "";
        if ($request->guesttype == "new") {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('12345678');
            $user->assignRole('Guest');
            $user->save();

            $guest = new Guest;
            $guest->phone1 = $request->phone1;
            $guest->phone2 = $request->phone2;
            $guest->city = $request->city;
            $guest->country = $request->country;
            $guest->user_id = $user->id;
            $guest->staff_id = Auth::user()->staff->id;
            $guest->save();

            $guest_id = $guest->id;
        } else {
            $guest_id = $request->guest_id;
        }

        $booking = new Booking;
        $booking->bookingid = $request->bookingid;
        $booking->bookstartdate = $request->bookdate;
        $booking->bookenddate = $request->todate;
        $booking->duration = $request->duration;
        $booking->bookingtype = $request->bookingtype;
        $booking->noofadult = $request->noofadult;
        $booking->noofchildren = $request->noofchildren ? $request->noofchildren : 0;
        $booking->estimatedarrivaltime = $request->estimatedarrivaltime;
        $booking->earlycheckin = $request->earlycheckin ? 1 : 0;
        $booking->latecheckout = $request->latecheckout ? 1 : 0;
        $booking->note = $request->note;
        $booking->totalcost = $request->totalcost;
        $booking->grandtotal = 0;
        $booking->status = 'booked';
        $booking->guest_id = $guest_id;
        $booking->staff_id = Auth::user()->staff->id;
        $booking->save();

        $payment = new Payment;
        $payment->booking_id = $booking->id;
        $payment->paymenttype = $request->paymenttype;
        $payment->advancepaymentpercentage = $request->advancepaymentpercentage;
        $payment->advancepayment = $request->advancepayment;
        $payment->status = 'paid deposit';
        $payment->save();

        $startdate = $request->bookdate;
        $enddate = $request->todate;

        for ($i=0; $i < count($request->roomtype); $i++) { 
            $roomtype_id = $request->roomtype[$i];
            if ($request->noofroom[$i]) {
                for ($j=0; $j < $request->noofroom[$i]; $j++) { 
                    $room = Room::whereDoesntHave('bookings', 
                            function (Builder $query) use ($startdate, $enddate) {
                                $query->where('bookings.status', 'booked')
                                      ->whereBetween('bookstartdate', [$startdate, $enddate])
                                      ->orWhereBetween('bookenddate', [$startdate, $enddate]);
                                })->where('roomtype_id', $roomtype_id)->first();
                    $room_id = $room->id;
                    $extrabed = $request->extrabed[$i]; 
                    $booking->rooms()->attach($room_id,['extrabed'=>$extrabed, 'status'=>'booked']);
                }
            }
        }
                
        return redirect()->route('bookings.index')->withSuccessMessage('New Booking is Successfully Recorded.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::find($id);
        $roomtypes = Roomtype::all();
        return view('backend.booking.show', compact('booking', 'roomtypes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getGuestData($id)
    {
        $user = User::find($id);
        $membertypename = $user->guest->membertype ? $user->guest->membertype->name : 'Not a Member yet';
        return response()->json([
                    'guest_id'=> $user->guest->id,
                    'name'=> $user->name,
                    'email'=> $user->email,
                    'phone1'=> $user->guest->phone1,
                    'phone2'=> $user->guest->phone2,
                    'city'=> $user->guest->city,
                    'country'=> $user->guest->country,
                    'points'=> $user->guest->points,
                    'memberstartdate'=> $user->guest->memberstartdate,
                    'membertype'=> $membertypename,
                ]);
    }

    public function getAvailableRooms($startdate, $enddate)
    {
        // dd($startdate);
        $rooms = Room::whereDoesntHave('bookings', function (Builder $query) use ($startdate, $enddate) {
                    $query->where('bookings.status', 'booked')
                          ->whereBetween('bookstartdate', [$startdate, $enddate])
                          ->orWhereBetween('bookenddate', [$startdate, $enddate]);
                    })->get();
        $roomtypes = Roomtype::orderBy('created_at')->get();
        // dd($rooms);
        return response()->json(array('rooms' => $rooms, 'roomtypes' => $roomtypes));
    }

    public function getTotalCost(Request $request)
    {
        // dd($request);
        $count = count($request->roomtype);
        $totalcost = 0;

        $roomtypes = Roomtype::all();
        for ($i=0; $i < $count; $i++) { 
            foreach ($roomtypes as $roomtype) {
                if ($roomtype->id == $request->roomtype[$i]) {
                    $totalcost += (int)$roomtype->pricepernight * (int) $request->noofroom[$i];
                }
            }
        }
        $totalcost = $totalcost * (int)$request->duration;
        return response()->json(['totalcost' => $totalcost]);
    }

    public function getCheckinList()
    {
        $today = date('Y-m-d');
        $bookings = Booking::where('bookstartdate', '>=', $today)
                            ->orderBy('bookstartdate', 'desc')->get();
        // dd($bookings);
        return view('backend.booking.checkin', compact('bookings'));
    }
}
