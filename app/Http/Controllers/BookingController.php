<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Payment;
use App\Roomtype;
use App\Country;
use App\User;
use App\Guest;
use App\Order;
use App\Room;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;
use App\Mail\CheckoutMail;
use App\Mail\GuestPasswordMail;
use App\Mail\BookingMail;

use PDF;

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
            $password = Str::random(8);
            $user->password = Hash::make($password);
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
        $booking->note = $request->note;
        $booking->totalcost = $request->totalcost;
        $booking->status = 'booked';
        $booking->guest_id = $guest_id;
        $booking->staff_id = Auth::user()->staff->id;
        $booking->save();

        $payment = new Payment;
        $payment->booking_id = $booking->id;
        $payment->paymenttype = $request->paymenttype;
        $payment->depositamount = $request->depositamount;
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
                    $booking->rooms()->attach($room_id,['extrabed'=> 0]);
                }
            }
        }

        // mail 
        if ($request->guesttype == "new") {
            $data = [
                'name' => $request->name,
                'checkindate' => $booking->bookstartdate,
                'checkoutdate' => $booking->bookenddate,
                'noofrooms' => count($booking->rooms),
                'email' => $request->email,
                'password' => $password,
            ];
            Mail::to($request->email)->send(new GuestPasswordMail($data));
        } else {
            // $duration = $booking->duration . (($booking->duration == 1) ? ' night' : ' nights');
            // $data = [
            //     'name' => $booking->guest->user->name,
            //     'checkindate' => $booking->bookstartdate,
            //     'checkoutdate' => $booking->bookenddate,
            //     'noofrooms' => count($booking->rooms),
            //     'duration' => $duration
            // ];
            // Mail::to($booking->guest->user->email)->send(new BookingMail($data));
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
        $starttime = $booking->checkindatetime;
        $endtime = ($booking->status == 'check in') ? date('Y-m-d H:i:s') : $booking->checkoutdatetime;
        $servicerooms = Room::with('services')
                    ->whereHas('services', function ($q) use ($starttime, $endtime) {
                        $q->whereBetween('room_service.created_at', [$starttime, $endtime]); 
                    })->get();
        $orders = Order::with('food')->whereBetween('created_at', [$starttime, $endtime])->get();
        return view('backend.booking.show', compact('booking', 'roomtypes', 'servicerooms', 'orders'));
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
        $totalcost = 0; $depositamount = 0;

        $roomtypes = Roomtype::all();
        for ($i=0; $i < $count; $i++) { 
            foreach ($roomtypes as $roomtype) {
                if ($roomtype->id == $request->roomtype[$i]) {
                    $depositamount += (int)$roomtype->pricepernight * (int) $request->noofroom[$i];
                }
            }
        }
        $totalcost = $depositamount * (int)$request->duration;
        return response()->json(['totalcost' => $totalcost, 'depositamount' => $depositamount]);
    }

    // check in
    public function getCheckinList()
    {
        $bookings = Booking::where('status', 'booked')
                            ->orderBy('bookstartdate')->get();
        // dd($bookings);
        return view('backend.booking.checkin', compact('bookings'));
    }
    public function getCheckinDetail($id)
    {
        // dd($id);
        $booking = Booking::find($id);
        $roomtypes = Roomtype::all();
        return view('backend.booking.checkindetail', compact('booking', 'roomtypes'));
    }
    public function updateBookingRoom(Request $request, $id)
    {
        // dd($request);
        $price = 0;
        $booking = Booking::find($id);

        for ($i=0; $i < count($request->room_id); $i++) { 
            if ($request->cancel[$i] == 0) {
                 $booking->rooms()->updateExistingPivot($request->room_id[$i],['extrabed'=>$request->extrabed[$i]]);
            } else {
                $booking->rooms()->detach($request->room_id[$i]);
                $room = Room::find($request->room_id[$i]);
                $price = $booking->totalcost - ($room->roomtype->pricepernight * $booking->duration);
                $booking->totalcost = $price;
                $booking->save();
            }
        }
        return redirect()->route('bookings.checkindetail', $booking->id)->withSuccessMessage('Room Detail is Successfully Updated.');
    }
    public function checkin($id)
    {
        $booking = Booking::find($id);
        $booking->checkindatetime = date('Y-m-d H:i:s');
        $booking->status = 'check in';

        $today = date('Y-m-d'); $totalcost = 0;
        if ($booking->bookstartdate != $today) {
            $end = Carbon::createFromFormat('Y-m-d', $booking->bookenddate);
            $start = Carbon::createFromFormat('Y-m-d', (date('Y-m-d')));
            $diff = $end->diffInDays($start);

            $booking->duration = $diff;

            foreach ($booking->rooms as $bookingroom) {
                $totalcost += $bookingroom->roomtype->pricepernight;
            }
            $booking->totalcost = $totalcost * $diff;
        }
        $booking->save();

        foreach ($booking->rooms as $bookingroom) {
            $room = Room::find($bookingroom->pivot->room_id);
            $room->status = 2;
            $room->save();
        }

        return redirect()->route('bookings.checkoutindex')->withSuccessMessage('Check in Success!');
    }

    // checkout 
    public function getCheckoutList()
    {
        $today = date('Y-m-d');
        $bookings = Booking::where('status', 'check in')
                            ->orderBy('bookenddate')->get();
        // dd($bookings);
        return view('backend.booking.checkout', compact('bookings'));
    }

    public function getCheckoutDetail($id)
    {
        $booking = Booking::find($id);
        $roomtypes = Roomtype::all();
        $starttime = $booking->checkindatetime;
        $endtime = date('Y-m-d H:i:s');
        $servicerooms = Room::with('services')
                    ->whereHas('services', function ($q) use ($starttime, $endtime) {
                        $q->whereBetween('room_service.created_at', [$starttime, $endtime]); 
                    })->get();
        $orders = Order::with('food')->whereBetween('created_at', [$starttime, $endtime])->get();
        // dd($orders);

        return view('backend.booking.checkoutdetail', compact('booking', 'roomtypes', 'servicerooms', 'orders'));
    }

    public function updateLateCheckout(Request $request, $id)
    {
        $booking = Booking::find($id);

        for ($i=0; $i < count($request->room_id); $i++) { 
            $booking->rooms()->updateExistingPivot($request->room_id[$i],['latecheckout'=>$request->latecheckout[$i]]);
        }

        return redirect()->route('bookings.checkoutdetail', $id)->withSuccessMessage('Late Checkout is Successfully Updated.');
    }

    public function checkout(Request $request, $id)
    {
        $booking = Booking::find($id);

        $booking->checkoutdatetime = date('Y-m-d H:i:s');
        $booking->taxamount = $request->taxamount;
        $booking->grandtotal = $request->grandtotal;

        if ($request->chkpropertydamagecost) {
            $booking->propertydamagecost = $request->propertydamagecost;
            $booking->notebystaff = $request->notebystaff;
        }

        $reducepoints = 0;
        if ($request->chkpointsused) {
            $booking->pointsused = $request->pointsused;
            $reducepoints = $request->pointsused;
        }
    
        $booking->status = "check out";
        $booking->save();

        if ($booking->guest->membertype_id) {
            $newpoints = round(($booking->guest->membertype->earnpoints / 100) * $request->grandtotal);
            $guest = Guest::find($booking->guest_id);
            $guest->points = ($booking->guest->points + $newpoints) - $reducepoints;
            $guest->save();
        }

        // change room status 
        foreach ($booking->rooms as $broom) {
            $room = Room::find($broom->id);
            $room->status = 1;
            $room->save();
        }

        // payment status 
        $payment = Payment::where('booking_id', $id)->first();
        $payment->status = 'complete';
        $payment->save();

        view()->share('booking',$booking);
        $pdf = PDF::loadView('backend.pdf.invoice', $booking)->save(public_path('backend/pdf/'.$booking->bookingid.'.pdf'));

        // mail
        $data = [
            'name' => $booking->guest->user->name,
            'pdf' => 'backend/pdf/'.$booking->bookingid.'.pdf'
        ];
        Mail::to($booking->guest->user->email)->send(new CheckoutMail($data));

        return redirect()->route('bookings.show', $id)->withSuccessMessage('Checkout Successful!');
    }

    public function cancel($id)
    {
        $booking = Booking::find($id);
        $booking->canceldate = date('Y-m-d');
        $booking->status = 'cancel';
        $booking->save();

        $start = Carbon::createFromFormat('Y-m-d', $booking->bookstartdate);
        $today = Carbon::createFromFormat('Y-m-d', (date('Y-m-d')));
        $diff = $start->diffInDays($today);

        if ($diff > 5) {
            $payment = Payment::where('booking_id', $id)->first();
            $payment->status = 'refunded';
            $payment->save();
        }

        return 'Cancellation Successful!';
    }
}
