<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Room;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('backend.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms = Room::whereHas('bookings', function ($query) {
                        $query->where('status', 'check in'); })
                        ->orderBy('roomno')->get();
        // dd($rooms);
        return view('backend.order.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // $messages = [
        //     'room_id.numeric' => '* Please select Room Type.',
        // ];
        // $validatedData = $request->validate([
        //     'room_id' => 'required|numeric',
        // ], $messages);

        $cart = json_decode($request->cartobj);
        $order = new Order;
        $order->room_id = $request->room_id;
        $order->totalprice = $request->totalprice;
        $order->note = $request->note;
        $order->status = 'ordered';
        $order->save();

        foreach ($cart->order_list as $row) {
            $order->food()->attach($row->id,['qty'=>$row->quantity]);
        }

        return response()->json('successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('backend.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $order->status = 'finished';
        $order->save();

        return redirect()->route('orders.index')->withSuccessMessage('Order O-'.$id.' is Added as Finished.');
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
}
