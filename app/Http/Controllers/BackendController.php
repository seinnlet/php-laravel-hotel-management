<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Booking;
use App\Staff;
use App\Guest;
use App\Room;

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

			return view('backend.dashboard', compact('bookingcount', 'roomcount', 'staffcount', 'guestcount', 'membercount'));
  	
  	} else if ($role == "Reservation Staff") {
  	   
      $comingupbookingcount = Booking::where('status', 'booked')->count();
      $roomcount = Room::all()->count();
      $checkinroomcount = Room::where('status', '2')->count();
      $guestcount = Guest::all()->count();
      $membercount = Guest::has('membertype')->count();
  		return view('backend.rstaffdashboard', compact('comingupbookingcount', 'roomcount', 'checkinroomcount', 'guestcount', 'membercount'));
  	
  	} else if ($role == "Service Staff") {
  	
  		return view('backend.sstaffdashboard');
  	
  	} else if ($role == "Kitchen Staff") {

  		return view('backend.kstaffdashboard');

  	}
	}
}
