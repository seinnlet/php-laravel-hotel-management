@extends('backendtemplate')

@section('title', 'Checkout List')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/datatables/datatables.min.css') }}">
@endsection

@section('content')

	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block">Current Check in List</h5>
		</div>

		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Booking List</h3>
      </div>
      <div class="card-body">
      	<div class="table-responsive pb-5">
				  <table class="table" id="datatable" style="width: 100%; font-size: .85rem;">
				    <thead>
				    	<tr>
				    		<td>No.</td>
				    		<td>Booking_ID</td>
				    		<td>Book_Date</td>
				    		<td>Duration</td>
				    		<td>Booked_By</td>
				    		<td>Status</td>
				    		<td>Action</td>
				    	</tr>
				    </thead>

				    <tbody>
				    	@php $i = 1 @endphp
				    	@foreach ($bookings as $booking)
				    		<tr>
				    			<td>{{ $i }}.</td>
				    			<td><span @if ($booking->bookenddate == date('Y-m-d')) class="text-success" @endif>{{ $booking->bookingid }}</span></td>
				    			<td><small>{{ date('Y-m-d', strtotime($booking->checkindatetime)) }} to <span @if ($booking->bookenddate == date('Y-m-d')) class="text-success" @endif>{{ $booking->bookenddate }}</span></small></td>
				    			<td>{{ $booking->duration }}</td>
				    			<td>{{ $booking->guest->user->name }}</td>
				    			<td>
				    				@if ($booking->status == "check in")
				    					<span class="badge badge-success badge-pill text-capitalize">{{ $booking->status }}</span>
				    				@endif
				    			</td>
				    			<td class="td-action">
				    				<span data-toggle="tooltip" title="Detail">
					    				<a class="a-detail btn-detail" href="{{ route('bookings.checkoutdetail', $booking->id) }}" 
					    				><i class="fas fa-external-link-alt"></i></a>
				    				</span>
				    			</td>
				    		</tr>
				    		@php $i++ @endphp
				    	@endforeach
				    </tbody>

				  </table>
				</div>
      </div>
    </div>

	</section>

@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('backend/vendor/datatables/datatables.min.js') }}"></script>

	<script type="text/javascript">
		$(document).ready( function () {
	    $('#datatable').DataTable();
			$('[data-toggle="tooltip"]').tooltip();

	 	});

	</script>
@endsection