@extends('backendtemplate')

@section('title', 'RoomTypes')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/datatables/datatables.min.css') }}">
@endsection

@section('content')

	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Room Types</h5>
			<a href="{{ route('roomtypes.create') }}" class="btn btn-primary float-right rounded"><i class="fas fa-plus fa-sm mr-2 text-gray-100"></i> Add New</a>
			<div class="clearfix"></div>
		</div>

		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Room Type List</h3>
      </div>
      <div class="card-body">

      	{{-- data table --}}

      	<div class="table-responsive pb-5">
				  <table class="table" id="datatable" style="width: 100%">
				    <thead>
				    	<tr>
				    		<td>No.</td>
				    		<td>Room_Type</td>
				    		<td>Price_per_Night</td>
				    		<td>Current_Availability</td>
				    		<td>Action</td>
				    	</tr>
				    </thead>

				    <tbody>
				    	@php $i = 1 @endphp
				    	@foreach ($roomtypes as $roomtype)
				    		<tr>
				    			<td>{{ $i }}.</td>
				    			<td>{{ $roomtype->name }}</td>
				    			<td>$ {{ number_format($roomtype->pricepernight, 2) }}</td>
				    			<td>
				    				@if ($roomtype->rooms_count == 0)
				    					0
				    				@else
				    					<span class="text-success">{{ $roomtype->available_rooms }} <sup>room{{ ($roomtype->available_rooms > 1) ? 's' : '' }} available</sup></span> / {{ $roomtype->rooms_count }}
				    				@endif
				    			</td>
				    			<td class="td-action">
				    				<a href="{{ route('roomtypes.edit', $roomtype->id) }}" class="a-edit" data-toggle="tooltip" title="Edit"><i class="fas fa-pen"></i></a>
				    				
				    				<form method="post" action="{{ route('roomtypes.destroy', $roomtype->id) }}" class="d-inline" id="delete-roomtype{{ $roomtype->id }}" >
											@csrf
		          				@method('DELETE')
					    				<button type="button" class="a-delete" data-toggle="tooltip" title="Delete" onclick="confirmDelete('delete-roomtype{{ $roomtype->id }}')"><i class="fas fa-times-circle"></i></button>
					    			</form>

					    			<span data-toggle="tooltip" title="Detail">
					    				<a class="a-detail btn-detail" href="{{ route('roomtypes.show', $roomtype->id) }}" 
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
			$('[data-toggle="tooltip"]').tooltip();
	    $('#datatable').DataTable();

	 	});

	 	// delete sweet alert
		function confirmDelete(roomtype_id) {
  		swal({
  			title: "Are you sure to Delete?",
  			text: "The data will be permanently deleted.",
  			icon: "warning",
  			buttons: true,
  			dangerMode: true,
  		})
  		.then((willDelete) => {
  			if (willDelete) {
  				$('#'+roomtype_id).submit();
  			}
  		});
  	}

	</script>
@endsection