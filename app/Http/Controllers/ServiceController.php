<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Room;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('backend.service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.service.create');
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
            'name.required' => '* Please enter Service Name.',
            'name.unique' => '* This Service already Existed.',
            'unitcharge.required' => '* Please enter Service Charges.',
            'unitcharge.numeric' => 'Please enter number value for Charges.',
            'unitcharge.min' => 'Charges should be greater than 0.',
        ];

        $validatedData = $request->validate([
            'name' => 'required|unique:services',
            'unitcharge' => 'required|min:0|max:100000|numeric',
        ], $messages);

        $service = new Service; 
        $service->name = $request->name;
        $service->unitcharge = $request->unitcharge;
        $service->save();

        return redirect()->route('services.index')->withSuccessMessage('New Service is Successfully Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);
        $rooms = Room::whereHas('bookings', function ($query) {
                        $query->where('status', 'check in'); })
                        ->orderBy('roomno')->get();

        return view('backend.service.show', compact('service', 'rooms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        return view('backend.service.edit', compact('service'));
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
            'name.required' => '* Please enter Service Name.',
            'name.unique' => '* This Service already Existed.',
            'unitcharge.required' => '* Please enter Service Charges.',
            'unitcharge.numeric' => 'Please enter number value for Charges.',
            'unitcharge.min' => 'Charges should be greater than 0.',
        ];

        $validatedData = $request->validate([
            'name' => 'required|unique:App\Service,name,'.$id,
            'unitcharge' => 'required|min:0|max:100000|numeric',
        ], $messages);

        $service = Service::find($id);
        $service->name = $request->name;
        $service->unitcharge = $request->unitcharge;
        $service->save();

        return redirect()->route('services.index')->withSuccessMessage($service->name . ' is Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();

        return redirect()->route('services.index')->withSuccessMessage($service->name. ' is Successfully Deleted.');
    }

    public function useService(Request $request, $id)
    {
        // dd($request);
        $messages = [
            'room_id.numeric' => '* Please choose Room No.',
            'totalqty.required' => '* Please enter Service Charges.',
            'totalqty.numeric' => 'Please enter number value for Charges.',
            'totalqty.min' => 'Charges should be greater than 0.',
        ];

        $validatedData = $request->validate([
            'room_id' => 'required|numeric',
            'totalqty' => 'required|min:1|max:100000|numeric',
        ], $messages);

        $service = Service::find($id);
        $service->rooms()->attach($request->room_id, ['totalcharges'=> $request->totalcharges, 'totalqty' => $request->totalqty, 'note' => $request->note ]);

        return redirect()->route('services.list')->withSuccessMessage('Service Usage is Successfully Recorded.');
    }

    public function usageList()
    {
        $rooms = Room::all();
        return view('backend.service.usagelist', compact('rooms'));
    }
}
