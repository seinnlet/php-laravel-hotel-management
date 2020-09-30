@extends('backendtemplate')

@section('title', 'Service Usage')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/datatables/datatables.min.css') }}">
@endsection

@section('content')

	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Service Usage</h5>
			<a href="{{ route('services.index') }}" class="btn btn-primary float-right rounded"><i class="fas fa-plus fa-sm mr-2 text-gray-100"></i> Add New</a>
			<div class="clearfix"></div>
		</div>

		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Used Service List</h3>
      </div>
      <div class="card-body">

      	{{-- data table --}}

      	<div class="table-responsive pb-5">
				  <table class="table" id="datatable" style="width: 100%">
				  	<thead>
				  		<tr>
				  			<td>No.</td>
				  			<td>Room_No</td>
				  			<td>Service</td>
				  			<td>Qty</td>
				  			<td>Total_Charges</td>
				  			<td>Created_at</td>
				  		</tr>
				  	</thead>
				  	<tbody>
				  		@php $i=1; @endphp
				  		@foreach ($rooms as $room)
				  			@if (count($room->services))
				  				@foreach ($room->services as $service)
				  					<tr>
				  						<td>{{ $i }}</td>
				  						<td>{{ $room->roomno }}</td>
				  						<td>{{ $service->name }}</td>
				  						<td>{{ $service->pivot->totalqty }}</td>
				  						<td>$ {{ $service->pivot->totalcharges }}</td>
				  						<td><small>{{ $service->pivot->created_at->format('Y-m-d H:i') }}</small></td>
				  					</tr>
				  					@php $i++; @endphp
				  				@endforeach
				  			@endif
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
			$('[data-toggle="tooltip"]').tooltip();
	    $('#datatable').DataTable();

	 	});

	 </script>
@endsection