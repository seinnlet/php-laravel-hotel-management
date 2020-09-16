<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Membertype;

class MemberTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $membertypes = Membertype::all();
        return view('backend.membertype.index', compact('membertypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.membertype.create');
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
            'name.unique' => '* This Member Type is already Existed.',
            'name.required' => '* Please enter Member Type Name.',
            'numberofstays.required' => '* Please define minimum number of stays for new member type.',
            'numberofnights.required' => '* Please define minimum number of nights for new member type.',
            'paidamount.required' => '* Please define minimum paid amount for new member type.',
            'earnpoints.min' => '* Please enter 0 - 100 value.',
            'laundrydiscount.min' => '* Please enter 0 - 100 value.',
            'fooddiscount.min' => '* Please enter 0 - 100 value.',
            'numberofstays.min' => '* Please enter 0 - 100 value.',
            'numberofnights.min' => '* Please enter 0 - 100 value.',
            'paidamount.min' => '* Please enter positive value.'
        ];

        $request->validate([
            'name' => 'required|unique:membertypes',
            'earnpoints' => 'min:0|max:100',
            'laundrydiscount' => 'min:0|max:100',
            'fooddiscount' => 'min:0|max:100',
            'numberofstays' => 'required|min:0|max:100|numeric',
            'numberofnights' => 'required|min:0|max:100|numeric',
            'paidamount' => 'required|min:0|max:1000000|numeric',
        ], $messages);

        // store data
        $membertype = new Membertype;
        $membertype->name = $request->name;
        $membertype->earnpoints = ($request->earnpoints) ? $request->earnpoints : 0;
        $membertype->laundrydiscount = ($request->laundrydiscount) ? $request->laundrydiscount : 0;
        $membertype->fooddiscount = ($request->fooddiscount) ? $request->fooddiscount : 0;
        $membertype->additionalbenefits = $request->additionalbenefits;
        $membertype->numberofstays = $request->numberofstays;
        $membertype->numberofnights = $request->numberofnights;
        $membertype->paidamount = $request->paidamount;
        $membertype->save();

        return redirect()->route('membertypes.index')->withSuccessMessage('New Member Type is Successfully Added.');
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
        $membertype = Membertype::find($id);
        return view('backend.membertype.edit', compact('membertype'));
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
            'name.required' => '* Please enter Room Type Name.',
            'numberofstays.required' => '* Please define minimum number of stays for new member type.',
            'numberofnights.required' => '* Please define minimum number of nights for new member type.',
            'paidamount.required' => '* Please define minimum paid amount for new member type.',
            'earnpoints.min' => '* Please enter 0 - 100 value.',
            'laundrydiscount.min' => '* Please enter 0 - 100 value.',
            'fooddiscount.min' => '* Please enter 0 - 100 value.',
            'numberofstays.min' => '* Please enter 0 - 100 value.',
            'numberofnights.min' => '* Please enter 0 - 100 value.',
            'paidamount.min' => '* Please enter positive value.'
        ];

        $request->validate([
            'name' => 'required',
            'earnpoints' => 'min:0|max:100',
            'laundrydiscount' => 'min:0|max:100',
            'fooddiscount' => 'min:0|max:100',
            'numberofstays' => 'required|min:0|max:100|numeric',
            'numberofnights' => 'required|min:0|max:100|numeric',
            'paidamount' => 'required|min:0|max:1000000|numeric',
        ], $messages);

        $membertype = Membertype::find($id);
        $membertype->name = $request->name;
        $membertype->earnpoints = ($request->earnpoints) ? $request->earnpoints : 0;
        $membertype->laundrydiscount = ($request->laundrydiscount) ? $request->laundrydiscount : 0;
        $membertype->fooddiscount = ($request->fooddiscount) ? $request->fooddiscount : 0;
        $membertype->additionalbenefits = $request->additionalbenefits;
        $membertype->numberofstays = $request->numberofstays;
        $membertype->numberofnights = $request->numberofnights;
        $membertype->paidamount = $request->paidamount;
        $membertype->save();

        return redirect()->route('membertypes.index')->withSuccessMessage($membertype->name . ' is Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $membertype = Membertype::find($id);
        $membertype->delete();

        return redirect()->route('membertypes.index')->withSuccessMessage($membertype->name. ' is Successfully Deleted.');
    }
}
