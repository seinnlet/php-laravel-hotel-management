@extends('backendtemplate')

@section('title', 'BookingDetail')

@section('css')
	<style type="text/css">
		table td, table th, .noextraservice {
			font-size: .8rem;
			color: #6c757d;
		}
		table th {
			font-weight: 600;
		}
		hr {
      margin: 1.2rem auto 2.2rem;
      background-color: #fff;
      border-top: 1px dashed #ccc !important;
    }
	</style>
@endsection

@section('content')

	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Booking Detail</h5>
      @if ($booking->status == 'check out')
        <a href="{{ asset('backend/pdf/'.$booking->bookingid.'.pdf') }}" class="btn btn-primary float-right rounded" target="_blank"><i class="fas fa-external-link-alt fa-sm mr-2 text-gray-100"></i> View Invoice</a>
      @else
        <a href="{{ route('bookings.index') }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
      @endif
			
			<div class="clearfix"></div>
		</div>

		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Booking ID: {{ $booking->bookingid }}</h3>
      </div>
      <div class="card-body">

      	{{-- Detail Header Part --}}
      	<div class="row">
      		<div class="col-md-6">
      			<table class="table table-borderless table-sm">
      				<tr>
      					<th>Booking Type :</th>
      					<td>{{ $booking->bookingtype }}</td>
      				</tr>
      				<tr>
      					<th>Duration :</th>
      					<td>
      						{{ $booking->checkindatetime ? date('Y-m-d', strtotime($booking->checkindatetime)) : $booking->bookstartdate }} to {{ $booking->bookenddate }} <br>
      						<small><em>({{ $booking->duration }} {{ ($booking->duration == 1) ? 'Night' : 'Nights'}})</em></small>
      					</td>
      				</tr>
      				@if ($booking->staff_id)
      				<tr>
      					<th>Recorded by :</th>
      					<td>{{ $booking->staff->user->name }}</td>
      				</tr>
      				@endif
      			</table>
      		</div>
      		<div class="col-md-6">
      			<table class="table table-borderless table-sm">
      				<tr>
      					<th>Guest Name :</th>
      					<td>{{ $booking->guest->user->name }}</td>
      				</tr>
      				<tr>
      					<th>Membertype:</th>
      					<td>
      						@if ($booking->guest->membertype_id)
      							<span class="text-primary font-weight-medium">{{ $booking->guest->membertype->name }}</span>
      						@else
      							Not a Member yet
      						@endif
      						<br>
    							<small><em>({{ $booking->guest->points }} {{ ($booking->guest->points == 1 || $booking->guest->points == 0) ? 'Point' : 'Points'}})</em></small>
      					</td>
      				</tr>
      				<tr>
      					<th>Total People:</th>
      					<td>
      						{{ $booking->noofadult }} {{ ($booking->noofadult == 1) ? 'Adult' : 'Adults'}}
      						@if ($booking->noofchildren)
      							, {{ $booking->noofchildren }} {{ ($booking->noofchildren == 1) ? 'Child' : 'Children'}}
      						@endif
      					</td>
      				</tr>
      			</table>
      		</div>
      	</div>
      	<hr>

      	{{-- Booking Detail --}}
      	<h6 class="h6 mb-4">Room Detail</h6>
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
                    text-primary 
                  @endif
                  text-capitalize">{{ $booking->status }}</span></th>
		      			<td colspan="4">
			      			@if ($booking->earlycheckin)
                    <span class="text-primary"><i class="fas fa-check"></i></span> Early Check in {{ ($booking->checkindatetime) ? '|' : '' }}
                  @endif
                  @if ($booking->checkindatetime)
                    Check in Time: {{ date('H:i', strtotime($booking->checkindatetime)) }} | 
                  @endif
                  @if ($booking->checkoutdatetime)
                    Check out Time: {{ date('H:i', strtotime($booking->checkoutdatetime)) }} | 
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

      	{{-- Services --}}
      	<h6 class="h6 mb-4">Extra Services</h6>
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
                            <td><a href="{{ route('orders.show', $order->id) }}">O-{{ $order->id }} <sup><i class="fas fa-external-link-alt"></i></sup></a></td>
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


      	{{-- Calculation --}}
      	<h6 class="h6 mb-4">Payment</h6>
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
		      			<td><span class="text-primary font-weight-bold">$ {{ number_format($booking->grandtotal,2) }}</span></td>
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

  {{-- Modal --}}
  <div class="modal" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-secondary font-weight-medium" id="exampleModalLabel">Property Damage Notes</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h6 class="font-weight-medium text-primary">- Notes by Staff -</h6>
          <p class="my-3">{{ $booking->notebystaff }}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@endsection