@extends('backendtemplate')

@section('title', 'Checkout Detail')

@section('css')
	<style type="text/css">
		table td, table th, .noextraservice, .checkoutform {
			font-size: .8rem;
			color: #464C51;
		}
    .checkoutform .form-control::-webkit-input-placeholder {
      font-size: .8rem;
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
			<a href="{{ route('bookings.checkoutindex') }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
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
      						{{ $booking->bookstartdate }} to {{ $booking->bookenddate }} <br>
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

      	{{-- Room Detail --}}
        <h6 class="h6 mb-4 float-left">Room Detail </h6>
        <button class="btn btn-outline-primary btn-sm px-3 ml-4 float-right btn-edit"><i class="fas fa-edit"></i> Add Late Checkout</button>
        <div class="clearfix"></div>
      	<div class="table-responsive my-3 room-detail">
      		<table class="table table-bordered">
      			<thead>
      				<tr>
      					<th colspan="2">Booking Status : <span class="text-primary text-capitalize">{{ $booking->status }}</span></th>
		      			<td colspan="4">
		      				@if ($booking->earlycheckin)
		      					<span class="text-primary"><i class="fas fa-check"></i></span> <span class="mr-3">Early Check in</span>
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
      					@endif
			      			
				    		@php $i++ @endphp
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

        <div class="table-responsive my-3 room-edit" style="display: none;">
          <form action="{{ route('bookings.updatelatecheckout', $booking->id) }}" method="post">
            @csrf
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Room Type</th>
                  <th>Room No.</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                
                @php $x = 1; @endphp
                  @foreach ($roomtypes as $roomtype)
                    @foreach ($booking->rooms as $room)
                        
                      @if ($room->roomtype->name == $roomtype->name)
                        <tr>
                          <td>{{ $x }}.</td>
                          <td>{{ $room->roomtype->name }}</td>
                          <td>
                            {{ $room->roomno }}
                            <input type="hidden" name="room_id[]" value="{{ $room->pivot->room_id }}">
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox">
                              <input type="hidden" name="latecheckout[]" value="{{ $room->pivot->latecheckout }}" class="latecheckoutvalue">
                              <input id="latecheckout{{ $x }}" type="checkbox" class="custom-control-input latecheckout" {{ $room->pivot->latecheckout ? 'checked' : '' }}>
                              <label for="latecheckout{{ $x }}" class="custom-control-label">Late Check out</label>
                            </div>
                          </td>
                        </tr>
                        @php $x++ @endphp
                      @endif

                    @endforeach 
                  @endforeach

                <tr>
                  <td colspan="3"></td>
                  <td colspan="2">
                    <button type="submit" class="btn btn-primary btn-sm px-5">Save</button>
                    <button type="button" class="btn btn-outline-secondary btn-cancel btn-sm px-4">Cancel</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>

      	<hr>

      	{{-- Service Detail --}}
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

      	{{-- Payment --}}
        <h6 class="h6 mb-4">Payment</h6>
        <form action="{{ route('bookings.checkout', $booking->id) }}" method="post" class="checkoutform">
           @csrf
          <div class="table-responsive my-3">

            <table class="table table-sm table-striped">
              <thead>
                <tr>
                  <th style="vertical-align: top;">Payment Type:</th>
                  <th class="font-weight-normal">
                    By {{ $booking->payment->paymenttype }} <br>
                    @if ($booking->payment->status == "paid deposit")
                      (<small><em>Deposit Amount: $ {{ number_format($booking->payment->depositamount, 2) }}</em></small>)
                   @endif
                  </th>
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
                @if ($latecheckoutcost)
                  <tr>
                    <th>Late Checkout:</th>
                    <td>$ {{ number_format($latecheckoutcost, 2) }}</td>
                  </tr>
                @endif
                <tr>
                  @php 
                    $total = $booking->totalcost + $totalservicecost + $totalordercost + ($extrabed * 10) + $latecheckoutcost;
                    $tax = $total * 0.05;
                    $grandtotal = $total + $tax;
                  @endphp
                  <th>Total:</th>
                  <td>$ {{ number_format($total, 2) }}</td>
                </tr>
                <tr>
                  <input type="hidden" name="taxamount" value="{{ $tax }}">
                  <th>Tax: (5%)</th>
                  <td>$ {{ number_format($tax, 2) }}</td>
                </tr>
              </tbody>
            </table>

          </div>

          <div class="row mb-3">
            <label class="col-md-3 col-form-label" for="damagecost">Damage Cost:</label>
            <div class="col-md-9 col-form-label">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="damagecost" name="chkpropertydamagecost">
                <label class="custom-control-label" for="damagecost">Add Property Damage</label>
              </div>
              <div id="div-damage" style="display: none;">
                <div class="input-group my-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input type="number" class="form-control" name="propertydamagecost" id="propertydamagecost" placeholder="Property Damage Cost" min="0" step=".01">
                </div>
                <textarea class="form-control" name="notebystaff" id="notebystaff" placeholder="Add Notes..."></textarea>
              </div>
            </div>
          </div>

          @if ($booking->guest->points > 10)
            <div class="row mb-3">
              <label class="col-md-3 col-form-label" for="memberpoint">Member Point:</label>
              <div class="col-md-9 col-form-label">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="memberpoint" name="chkpointsused">
                  <label class="custom-control-label" for="memberpoint">Use Now</label>
                </div>

                <div id="div-memberpoint" style="display: none;">
                  <div class="row">
                    <div class="col-12 col-md-4 mt-3">
                      <input type="number" name="pointsused" id="pointsused" class="form-control" min="0">
                      <small class="form-text text-primary">Points Used:</small>
                    </div>
                    
                    <div class="col-6 col-md-4 mt-3">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">$</span>
                        </div>
                        <input type="number" class="form-control bg-white" name="savedamount" id="savedamount" readonly>
                      </div>
                      <small class="form-text text-success">Save Amount:</small>
                    </div>

                    <div class="col-6 col-md-4 mt-3">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">$</span>
                        </div>
                        <input type="number" class="form-control bg-white" name="virtualtotal" id="virtualtotal" readonly>
                      </div>
                      <small class="form-text text-primary">Total After Using Points:</small>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          @endif
            
          <div class="row mb-3">
            <label class="col-md-3 col-form-label" for="grandtotal">Grand Total:</label>
            <div class="col-md-9">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">$</span>
                </div>
                <input type="number" class="form-control bg-white" name="grandtotal" id="grandtotal" value="{{ number_format($grandtotal, 2) }}" readonly>
              </div>
            </div>
          </div>

          <div class="row mt-5">
            <div class="col-md-9 ml-auto">
              <button type="submit" class="btn btn-primary">Check Out</button>
            </div>
          </div>

        </form>

      </div>
    </div>
  </section>
@endsection

@section('script')
  <script type="text/javascript">
    $(function () {
      $('.btn-edit').click(function() {
        $('.room-detail').hide();
        $('.room-edit').show('400');
      });

      $('.btn-cancel').click(function() {
        $('.room-edit').hide();
        $('.room-detail').show('400');
      });

      $('form').on('click', '.latecheckout', function() {
        if ($(this).prev('.latecheckoutvalue').val() == 0) {
          $(this).prev('.latecheckoutvalue').val(1)
        } else {
          $(this).prev('.latecheckoutvalue').val(0)
        }
      });

      $("#damagecost").change(function() {
        if(this.checked) {
          $('#div-damage').show('400');
        } else {
          $('#div-damage').hide();
        }
      });

      $('#propertydamagecost').on('change keyup', function() {
        let damagecost = $(this).val();
        let grandtotal = {{ number_format($grandtotal,2) }};
        if (damagecost) {
          $('#grandtotal').val((+grandtotal + +damagecost).toFixed(2));
        } else {
          $('#grandtotal').val({{ number_format($grandtotal,2) }})
        }
      });
      $('form').on('keypress', '#propertydamagecost', function(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          return false;
        }
      });

      $("#memberpoint").change(function() {
        if(this.checked) {
          $('#div-memberpoint').show('400');

          // calculating member points
          let currentpoints = {{ $booking->guest->points }};
          let grandtotal = $('#grandtotal').val();
          let usedpoints = 0;
          if (currentpoints > grandtotal * 100) {
            pointsused = grandtotal * 100;
            $('#pointsused').val(pointsused);
            $('#savedamount').val(-grandtotal);
            $('#virtualtotal').val(0);
          } else {
            pointsused = currentpoints;
            savedamount = pointsused / 100;
            virtualtotal = grandtotal - savedamount;
            $('#pointsused').val(pointsused);
            $('#savedamount').val(-savedamount);
            $('#virtualtotal').val(virtualtotal);
          }

        } else {
          $('#div-memberpoint').hide();
        }
      });

    })
  </script>
@endsection