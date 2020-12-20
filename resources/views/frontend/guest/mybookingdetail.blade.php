@extends('frontendtemplate')

@section('title', 'Hotel Riza - My Booking Detail')

@section('css')
	<style type="text/css">
		body {
	    background: #201D18;
		}
    .booking-detail {
      font-size: .9rem;
    }
	</style>
@endsection

@section('content')

	<main id="main">
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
        	<h2></h2>
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('mybookings') }}">My Bookings</a></li>
            <li>Detail</li>
          </ol>
        </div>

      </div>
    </section>

    <section class="inner-page">
      <div class="container">
        
        <h5 class="text-theme font-weight-bold mb-4">Booking ID: {{ $booking->bookingid }}</h5>

        <div class="booking-detail">

          {{-- intro part --}}
          <div class="row">
            <div class="col-md-6 mb-3">
              <strong>Customer:</strong> {{ $booking->guest->user->name }} <br>
              {{ $booking->guest->user->email }} <br>
              {{ $booking->guest->city }}, {{ $booking->guest->country }}
            </div>
            <div class="col-md-6 mb-3">
              <table class="table table-sm table-borderless">
                <tr>
                  <th>Arrival :</th>
                  <td>
                    {{ $booking->checkindatetime ? date('Y-m-d', strtotime($booking->checkindatetime)) : date('Y-m-d', strtotime($booking->bookstartdate)) }}
                    @if($booking->checkindatetime)
                      [Check in Time: {{ date('h:i A', strtotime($booking->checkindatetime)) }}]
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Departaure :</th>
                  <td>
                    {{ $booking->checkoutdatetime ? date('Y-m-d', strtotime($booking->checkoutdatetime)) : date('Y-m-d', strtotime($booking->bookenddate)) }}
                    @if($booking->checkoutdatetime)
                      [Check in Time: {{ date('h:i A', strtotime($booking->checkoutdatetime)) }}]
                    @endif
                  </td>
                </tr>
              </table>
            </div>
          </div>

          {{-- room detail --}}
          <div class="table-responsive my-3">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th colspan="2">Booking Status : <span class="
                    @if ($booking->status == 'cancel')
                      text-danger
                    @elseif ($booking->status == 'check in')
                      text-success
                    @else 
                      text-theme 
                    @endif
                    text-capitalize">{{ $booking->status }}</span></th>
                  <td colspan="4">
                    @if ($booking->earlycheckin)
                      <span class="text-theme"><i class="fas fa-check"></i></span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>No.</th>
                  <th>Room Type</th>
                  <th>No of Rooms</th>
                  <th>Room No.</th>
                  <th>Sub Total Cost</th>
                  <th>Notes</th>
                </tr>
              </thead>
              <tbody>
                @php $i = 1; $totalextrabed = 0; $latecheckout = 0; $latecheckoutcost = 0; @endphp
                @foreach ($roomtypes as $roomtype)
                  @php $noofrooms = 0; $roomnos = ""; $extrabed = 0; @endphp
                  @foreach ($booking->rooms as $room)
                      
                    @if ($room->roomtype->name == $roomtype->name)
                      @php 
                        $noofrooms++; 
                        $roomnos .= $room->roomno . ", ";
                        $extrabed += $room->pivot->extrabed;
                        $latecheckout += $room->pivot->latecheckout;
                        $latecheckoutcost += ($room->pivot->latecheckout) ? ($roomtype->pricepernight/2) : 0;
                        $totalextrabed += $room->pivot->extrabed;
                      @endphp
                    @endif

                  @endforeach
                  @if ($noofrooms != 0)
                    <tr>
                      <td>{{ $i }}.</td>
                      <td>{{ $roomtype->name }} <br><small>(${{ number_format($roomtype->pricepernight, 2) }})</small></td>
                      <td>{{ $noofrooms }}</td>
                      <td>{{ substr($roomnos, 0, -2) }}</td>
                      <td>${{ number_format($roomtype->pricepernight * $noofrooms, 2) }}</td>
                      <td>
                        @if ($extrabed)
                          <em>{{ $extrabed }} extra {{ ($extrabed == 1) ? 'bed' : 'beds'}}</em>
                        @endif
                      </td>
                    </tr>
                    @php $i++ @endphp
                  @endif
                    
                @endforeach

                @if ($latecheckout)
                  <tr>
                    <th colspan="2">Late Check Out: </th>
                    <td colspan="4">{{ $latecheckout }}{{ $latecheckout == 1 ? ' Room' : ' Rooms' }} </td>
                  </tr>
                @endif

              </tbody>
            </table>
          </div>

          <hr>

          {{-- service detail --}}
          <h6 class="font-weight-bold text-theme mb-4">Extra Services</h6>
          @php $totalservicecost = 0; $totalordercost = 0;  @endphp
          @if (count($servicerooms) || count($orders))
            <div class="row">
              @if (count($servicerooms))
              <div class="{{ (count($servicerooms) && count($orders)) ? 'col-md-6' : 'col-12' }} mb-3">   
                <div class="table-responsive">
                  <table class="table table-bordered {{ (count($servicerooms) && count($orders)) ? 'table-sm' : '' }}">
                    <thead>
                      <tr>
                        <th colspan="5">Room Services</th>
                      </tr>
                      <tr>
                        <th>No.</th>
                        <th>Room No.</th>
                        <th>Service</th>
                        <th>Qty</th>
                        <th>Total Charges</th>
                      </tr>      
                    </thead>

                    <tbody>
                      @php $i=1; @endphp
                      @foreach ($booking->rooms as $room)
                        @foreach ($servicerooms as $sroom)
                          
                          @if ($room->id == $sroom->id)
                            @foreach ($sroom->services as $service)
                              <tr>
                                <td>{{ $i }}.</td>
                                <td>R-{{ $sroom->roomno }}</td>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->pivot->totalqty }}</td>
                                <td>$ {{ $service->pivot->totalcharges }}</td>
                              </tr>
                            @php $i++; $totalservicecost += $service->pivot->totalcharges; @endphp
                            @endforeach
                          @endif

                        @endforeach
                      @endforeach
                      <tr>
                        <th colspan="4">Total:</th>
                        <td>$ {{ number_format($totalservicecost, 2) }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>        
              </div>
              @endif
              
              @if (count($orders))
              <div class="{{ (count($servicerooms) && count($orders)) ? 'col-md-6' : 'col-12' }} mb-3">
                <div class="table-responsive">
                  <table class="table table-bordered {{ (count($servicerooms) && count($orders)) ? 'table-sm' : '' }}">
                    <thead>
                      <tr>
                        <th colspan="5">Food Order</th>
                      </tr>
                      <tr>
                        <th>No.</th>
                        <th>Room No.</th>
                        <th>Order No.</th>
                        <th>Ordered Time</th>
                        <th>Total Cost</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i = 1; @endphp
                      @foreach ($booking->rooms as $room)
                        @foreach ($orders as $order)
                          
                          @if ($room->id == $order->room_id)
                            <tr>
                              <td>{{ $i }}.</td>
                              <td>R-{{ $room->roomno }}</td>
                              <td>O-{{ $order->id }} </td>
                              <td><small>{{ $order->created_at->format('Y-m-d H:i') }}</small></td>
                              <td>$ {{ $order->totalprice }}</td>
                            </tr>
                            @php $i++; $totalordercost += $order->totalprice; @endphp
                          @endif

                        @endforeach
                      @endforeach
                      <tr>
                        <th colspan="4">Total:</th>
                        <td>$ {{ number_format($totalordercost, 2) }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              @endif
              
            </div>
          @else
            <p class="font-italic mb-5 noextraservice">No Extra Service is Used.</p>
          @endif

          <hr>

          {{-- payment detail --}}
          <h6 class="font-weight-bold text-theme mb-4">Payment Info</h6>
          <div class="table-responsive my-3">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="vertical-align: top;">Payment:</th>
                  <td>
                    {{ $booking->payment->paymenttype }} <br>
                    @if ($booking->payment->status == "paid deposit")
                      (<small><em>Deposit Amount: $ {{ number_format($booking->payment->depositamount, 2) }}</em></small>)
                    @else
                      (<small class="text-capitalize"><em> 
                        @if ($booking->payment->status == 'refunded')
                         {{ $booking->payment->status }}: $ {{ number_format($booking->payment->depositamount, 2) }}
                        @else
                          Payment Complete
                        @endif
                      </em></small>)
                    @endif
                  </td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>Room Total Cost : </th>
                  <td>$ {{ number_format($booking->totalcost, 2) }}</td>
                </tr>
                @if ($totalextrabed)
                  <tr>
                    <th>Extra Bed : <span class="font-weight-light">($10.00 x {{ $totalextrabed }})</span> </th>
                    <td>$ {{ number_format($totalextrabed * 10, 2) }} </td>
                  </tr>
                @endif
             
                @if ($totalservicecost + $totalordercost)
                  <tr>
                    <th>Extra Service Cost:</th>
                    <td>$ {{ number_format($totalservicecost + $totalordercost, 2) }}</td>
                  </tr>
                @endif

              @if ($booking->status == 'check out')
                  
                @if ($latecheckoutcost)
                  <tr>
                    <th>Late Checkout:</th>
                    <td>$ {{ number_format($latecheckoutcost, 2) }}</td>
                  </tr>
                @endif
                @if ($booking->propertydamagecost != 0.00)
                  <tr>
                    <th>Property Damage Cost:</th>
                    <td>
                      $ {{ number_format($booking->propertydamagecost, 2) }}
                      @if ($booking->notebystaff)
                        <button class="btn btn-outline-primary btn-sm px-2 ml-3" data-toggle="modal" data-target="#modal">View Notes</button>
                      @endif
                    </td>
                  </tr>
                @endif
                <tr>
                  @php 
                    $total = $booking->totalcost + $totalservicecost + $totalordercost + ($extrabed * 10) + $latecheckoutcost;
                    $tax = $total * 0.05;
                  @endphp
                  <th>Tax: (5%)</th>
                  <td>$ {{ number_format($tax, 2) }}</td>
                </tr>
                <tr>
                  <th>Grand Total :</th>
                  <td><span class="text-theme font-weight-bold">$ {{ number_format($booking->grandtotal,2) }}</span></td>
                </tr>
                @if ($booking->pointsused)
                  <tr>
                    <th>Notes: </th>
                    <td>
                      @php $savedamount = $booking->pointsused * 0.01 @endphp
                      Points Used: {{ $booking->pointsused }} | [- $ {{ number_format($savedamount, 2) }}]
                      <br><br>
                      <span class="text-info font-weight-bold">$ {{ number_format($booking->grandtotal - $savedamount,2) }}</span> (Paid)
                    </td>
                  </tr>
                @endif

              @endif

                @if ($booking->status == 'cancel')
                  <th>
                    Note: <i class="fas fa-exclamation-circle"></i> <br>
                    Cancelled Date: {{ $booking->canceldate }}
                  </th>
                  <td>
                    <span class="btn btn-danger btn-block disabled">This booking was Cancelled.</span>
                  </td>
                @endif

              </tbody>
            </table>
          </div>
        </div>
          
      </div>
    </section>

  </main><!-- End #main -->

@endsection