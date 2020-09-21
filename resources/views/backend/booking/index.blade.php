@extends('backendtemplate')

@section('title', 'Bookings')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/datatables/datatables.min.css') }}">
@endsection

@section('content')

	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Bookings</h5>
			<a href="{{ route('bookings.create') }}" class="btn btn-primary float-right rounded"><i class="fas fa-plus fa-sm mr-2 text-gray-100"></i> New Booking</a>
			<div class="clearfix"></div>

		</div>

		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Booking List</h3>
      </div>
      <div class="card-body">

				<div class="mb-4">
					<button class="btn btn-outline-primary btn-sm px-3"><i class="fas fa-filter fa-sm mr-2"></i>Current Checkin List</button>
					<button class="btn btn-outline-primary btn-sm px-3"><i class="fas fa-upload fa-sm mr-2"></i>Generate Report</button>
				</div>

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
				    			<td>{{ $booking->bookingid }}</td>
				    			<td><small>{{ $booking->bookstartdate }} to {{ $booking->bookenddate }}</small></td>
				    			<td>{{ $booking->duration }}</td>
				    			<td>{{ $booking->guest->user->name }}</td>
				    			<td>
				    				@if ($booking->status == "booked")
				    					<span class="badge badge-primary badge-pill">Booked</span>
				    				@endif
				    			</td>
				    			<td class="td-action">
				    				<span data-toggle="tooltip" title="Detail">
					    				<a class="a-detail btn-detail" href="{{ route('bookings.show', $booking->id) }}" 
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

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready( function () {
	    $('#datatable').DataTable();
			$('[data-toggle="tooltip"]').tooltip();

	 	});

	</script>
@endsection