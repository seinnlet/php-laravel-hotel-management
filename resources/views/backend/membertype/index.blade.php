@extends('backendtemplate')

@section('title', 'MemberTypes')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/datatables/datatables.min.css') }}">
@endsection

@section('content')

	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Member Types</h5>
			<a href="{{ route('membertypes.create') }}" class="btn btn-primary float-right rounded"><i class="fas fa-plus fa-sm mr-2 text-gray-100"></i> Add New</a>
			<div class="clearfix"></div>
		</div>

		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Member Type List</h3>
      </div>
      <div class="card-body">
        
      	{{-- data table --}}

      	<div class="table-responsive">
				  <table class="table" id="datatable">
				    <thead>
				    	<tr>
				    		<td>No.</td>
				    		<td>Name</td>
				    		<td>Earn_Points</td>
				    		<td>Action</td>
				    	</tr>
				    </thead>

				    <tbody>
				    	@php $i = 1 @endphp
				    	@foreach ($membertypes as $membertype)
				    		<tr>
				    			<td>{{ $i }}.</td>
				    			<td>{{ $membertype->name }}</td>
				    			<td>{{ $membertype->earnpoints }}%</td>
				    			<td class="td-action">
				    				<a href="" class="a-edit" data-toggle="tooltip" title="Edit"><i class="fas fa-pen"></i></a>
				    				<form method="post" action="{{ route('membertypes.destroy', $membertype->id) }}" class="d-inline" id="delete-membertype{{ $membertype->id }}" >
											@csrf
		          				@method('DELETE')
					    				<button type="button" class="a-delete" data-toggle="tooltip" title="Delete" onclick="confirmDelete('delete-membertype{{ $membertype->id }}')"><i class="fas fa-times-circle"></i></button>
					    			</form>
				    				<a href="" class="a-detail" data-toggle="tooltip" title="Detail"><i class="fas fa-external-link-alt"></i></a>
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
		function confirmDelete(membertype_id) {
  		swal({
  			title: "Are you sure to Delete?",
  			text: "The data will be permanently deleted.",
  			icon: "warning",
  			buttons: true,
  			dangerMode: true,
  		})
  		.then((willDelete) => {
  			if (willDelete) {
  				$('#'+membertype_id).submit();
  			}
  		});
  	}

	</script>
@endsection