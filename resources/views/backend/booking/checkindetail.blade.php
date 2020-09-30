@extends('backendtemplate')

@section('title', 'Checkin Detail')

@section('css')
	<style type="text/css">
		table td, table th {
			font-size: .8rem;
			color: #464C51;
		}
		table th {
			font-weight: 600;
		}
		hr {
      margin: 1.2rem auto 2.2rem;
      background-color: #fff;
      border-top: 1px dashed #ccc !important;
    }
    .room-edit table th, .room-edit table td {
    	vertical-align: middle;
    }
    .extrabed {
      border: 1px solid #ced4da;
    }
	</style>
@endsection

@section('content')
	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Booking Detail</h5>
			<a href="{{ route('bookings.checkinindex') }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
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

      	{{-- Booking Detail --}}
      	<h6 class="h6 mb-4 float-left">Room Detail </h6>
      	<button class="btn btn-outline-primary btn-sm px-3 ml-4 float-right btn-edit"><i class="fas fa-edit"></i> Edit</button>
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
				    	@php $i = 1; $totalextrabed = 0; @endphp
      				@foreach ($roomtypes as $roomtype)
      					@php $noofrooms = 0; $roomnos = ""; $extrabed = 0; @endphp
      					@foreach ($booking->rooms as $room)
	      						
      						@if ($room->roomtype->name == $roomtype->name)
      							@php 
      								$noofrooms++; 
      								$roomnos .= $room->roomno . ", ";
      								$extrabed += $room->pivot->extrabed;
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

      			</tbody>
      		</table>
      	</div>

      	<div class="table-responsive my-3 room-edit" style="display: none;">
      		<form action="{{ route('bookings.updatebookingroom', $booking->id) }}" method="post">
      			@csrf
	      		<table class="table table-bordered">
	      			<thead>
	      				<tr>
	      					<th>No.</th>
	      					<th>Room Type</th>
	      					<th>Room No.</th>
	      					<th>Extra Bed</th>
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
		      									<input type="number" name="extrabed[]" value="{{ $room->pivot->extrabed }}" min="0" max="2" class="form-control-sm extrabed" required>
		      								</td>
		      								<td>
		      									<div class="custom-control custom-checkbox">
			      									<input type="hidden" name="cancel[]" value="0" class="cancelvalue">
	                        		<input id="cancel{{ $x }}" type="checkbox" class="custom-control-input cancel">
	                        		<label for="cancel{{ $x }}" class="custom-control-label">Cancel this room</label>
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
        {{-- Payment --}}
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
                  @endif
                </td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Room Total Cost : </th>
                <td>$ {{ number_format($booking->totalcost, 2) }}</td>
              </tr>
              <tr>
                <th>Extra Bed : <span class="font-weight-light">({{ $totalextrabed }} X $10.00)</span> </th>
                <td>
                  @if ($totalextrabed)
                    $ {{ number_format($totalextrabed * 10, 2) }} 
                  @else
                    $ 0.00
                  @endif
                </td>
              </tr>
              <tr>
                <th>Notes: <span class="font-weight-normal">{{ $booking->note }}</span></th>
                <td>
                  @php $today = date('Y-m-d') @endphp
                  <a href="{{ route('bookings.checkin', $booking->id) }}" class="btn btn-success btn-sm btn-block py-2  @if ($today != $booking->bookstartdate || $booking->status !='booked') disabled @endif">Check In Now</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

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

			$('form').on('keypress', '.extrabed', function(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 50)) {
          return false;
        }
      });

      $('form').on('click', '.cancel', function() {
        if ($(this).prev('.cancelvalue').val() == 0) {
          $(this).prev('.cancelvalue').val(1)
        } else {
          $(this).prev('.cancelvalue').val(0)
        }
      });

		})
	</script>
@endsection