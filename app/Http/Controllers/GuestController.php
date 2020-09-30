<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guest;
use App\Membertype;
use App\Booking;

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
