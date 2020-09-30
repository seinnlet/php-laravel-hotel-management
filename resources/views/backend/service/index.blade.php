@extends('backendtemplate')

@section('title', 'Services')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/datatables/datatables.min.css') }}">
@endsection

@section('content')

	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Services</h5>
			<a href="{{ route('services.create') }}" class="btn btn-primary float-right rounded"><i class="fas fa-plus fa-sm mr-2 text-gray-100"></i> Add New</a>
			<div class="clearfix"></div>
		</div>

		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Service List</h3>
      </div>
      <div class="card-body">

      	{{-- data table --}}

      	<div class="table-responsive pb-5">
				  <table class="table" id="datatable" style="width: 100%">
				    <thead>
				    	<tr>
				    		<td>No.</td>
				    		<td>Service</td>
				    		<td>Unit_Charge</td>
				    		<td>Created_at</td>
				    		<td>Action</td>
				    	</tr>
				    </thead>

				    <tbody>
				    	@php $i = 1 @endphp
				    	@foreach ($services as $service)
				    		<tr>
				    			<td>{{ $i }}.</td>
				    			<td>{{ $service->name }}</td>
				    			<td>$ {{ number_format($service->unitcharge, 2) }}</td>
				    			<td><small>{{ $service->created_at->format('Y-m-d') }}</small></td>
				    			<td class="td-action">
				    				<a href="{{ route('services.edit', $service->id) }}" class="a-edit" data-toggle="tooltip" title="Edit"><i class="fas fa-pen"></i></a>
				    				
				    				<form method="post" action="{{ route('services.destroy', $service->id) }}" class="d-inline" id="delete-service{{ $service->id }}" >
											@csrf
		          				@method('DELETE')
					    				<button type="button" class="a-delete" data-toggle="tooltip" title="Delete" onclick="confirmDelete('delete-service{{ $service->id }}')"><i class="fas fa-times-circle"></i></button>
					    			</form>

					    			<span data-toggle="tooltip" title="Add Service Usage">
					    				<a class="a-detail btn-detail" href="{{ route('services.show', $service->id) }}"
					    				><i class="fas fa-plus-square"></i></a>
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
		function confirmDelete(service_id) {
  		swal({
  			title: "Are you sure to Delete?",
  			text: "The data will be permanently deleted.",
  			icon: "warning",
  			buttons: true,
  			dangerMode: true,
  		})
  		.then((willDelete) => {
  			if (willDelete) {
  				$('#'+service_id).submit();
  			}
  		});
  	}

	</script>
@endsection