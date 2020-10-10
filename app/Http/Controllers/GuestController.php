<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guest;
use App\Membertype;
use App\Booking;
use App\User;
use Illuminate\Support\Facades\File;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guests = Guest::orderBy('created_at')->get();
        return view('backend.guest.index', compact('guests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guest = Guest::find($id);
        return view('backend.guest.show', compact('guest'));
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
        $messages = [
            'email.unique' => '* This Email Address is already Existed.',
            'name.required' => '* Please enter Full Name.',
            'email.required' => '* Please enter Email Address.',
            'phone1.required' => '* Please enter Phone Number.',
            'city.required' => '* Please enter City.',
        ];

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:App\User,email,'.$id,
            'phone1' => 'required',
            'city' => 'required',
        ], $messages);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $profile = $request->oldprofile;
        if ($request->newprofile) {
            $imagename = date('Ymd').time().'.'.$request->newprofile->extension();
            $request->newprofile->move(public_path('backend/img/guest/'), $imagename);
            $profile = 'backend/img/guest/'.$imagename;
            // delete
            $file = public_path($request->oldprofile);
            if (File::exists($file) && $request->oldprofile!="backend/img/guest/user.png") {
                File::delete($file);
            }
        } 

        $guest = Guest::where('user_id', $id)->first();
        $guest->profilepicture = $profile;
        $guest->phone1 = $request->phone1;
        $guest->phone2 = $request->phone2;
        $guest->city = $request->city;
        $guest->country = $request->country;
        $guest->save();

        return redirect()->route('profile')->withSuccessMessage('Your Profile is Successfully Updated.');

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

    public function createMember($id)
    {
        $guest = Guest::find($id);
        $membertypes = Membertype::all();
        $lastmember = Guest::orderBy('member_id', 'desc')->first();
        $explode = explode('-', $lastmember->member_id);
        $member_id = date('Y-md-').(++$explode[2]);
        return view('backend.guest.createmember', compact('guest', 'membertypes', 'member_id'));
    }
    public function storeMember(Request $request, $id)
    {   
        $guest = Guest::find($id);
        $guest->memberstartdate = $request->memberstartdate;
        $guest->membertype_id = $request->membertype_id;
        $guest->member_id = $request->member_id;
        $guest->save();

        return redirect()->route('guests.index')->withSuccessMessage('New Member is Successfully Added.');
    }
}
