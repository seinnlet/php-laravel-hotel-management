@extends('backendtemplate')

@section('title', 'Rooms')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/datatables/datatables.min.css') }}">
@endsection

@section('content')

	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Rooms</h5>
			<a href="{{ route('rooms.create') }}" class="btn btn-primary float-right rounded"><i class="fas fa-plus fa-sm mr-2 text-gray-100"></i> Add New</a>
			<div class="clearfix"></div>
		</div>

		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Room List</h3>
      </div>
      <div class="card-body">

      	{{-- data table --}}

      	<div class="table-responsive pb-5">
				  <table class="table" id="datatable" style="width: 100%">
				    <thead>
				    	<tr>
				    		<td>No.</td>
				    		<td>Room_No</td>
				    		<td>Room_Type</td>
				    		<td>Status</td>
				    		<td>Created_at</td>
				    		<td>Action</td>
				    	</tr>
				    </thead>

				    <tbody>
				    	@php $i = 1 @endphp
				    	@foreach ($rooms as $room)
				    		<tr>
				    			<td>{{ $i }}.</td>
				    			<td>R-{{ $room->roomno }}</td>
				    			<td>{{ $room->roomtype->name }}</td>
				    			<td>
				    				@if ($room->status == 1)
				    					<span class="badge badge-success badge-pill">Available</span>
				    				@elseif ($room->status == 2)
				    					<span class="badge badge-primary badge-pill">Booked</span>
				    				@else 
				    					<span class="badge badge-info badge-pill">Checkin</span>
				    				@endif
				    			</td>
				    			<td><em>{{ $room->created_at->format('Y-m-d') }}</em></td>
				    			<td class="td-action">
				    				<a href="{{ route('rooms.edit', $room->id) }}" class="a-edit" data-toggle="tooltip" title="Edit"><i class="fas fa-pen"></i></a>
				    				
				    				<form method="post" action="{{ route('rooms.destroy', $room->id) }}" class="d-inline" id="delete-room{{ $room->id }}" >
											@csrf
		          				@method('DELETE')
					    				<button type="button" class="a-delete" data-toggle="tooltip" title="Delete" onclick="confirmDelete('delete-room{{ $room->id }}')"><i class="fas fa-times-circle"></i></button>
					    			</form>
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

	 	// delete sweet alert
		function confirmDelete(room_id) {
  		swal({
  			title: "Are you sure to Delete?",
  			text: "The data will be permanently deleted.",
  			icon: "warning",
  			buttons: true,
  			dangerMode: true,
  		})
  		.then((willDelete) => {
  			if (willDelete) {
  				$('#'+room_id).submit();
  			}
  		});
  	}

	</script>
@endsection