@extends('backendtemplate')

@section('title', 'Staff')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/datatables/datatables.min.css') }}">
@endsection

@section('content')

	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Staff</h5>
			<a href="{{ route('staff.create') }}" class="btn btn-primary float-right rounded"><i class="fas fa-plus fa-sm mr-2 text-gray-100"></i> Add New</a>
			<div class="clearfix"></div>
		</div>

		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Staff List</h3>
      </div>
      <div class="card-body">

      	{{-- data table --}}

      	<div class="table-responsive pb-5">
				  <table class="table" id="datatable" style="width: 100%">
				    <thead>
				    	<tr>
				    		<td>No.</td>
				    		<td>Name</td>
				    		<td>Email</td>
				    		<td>Role</td>
				    		<td>Registered_at</td>
				    		<td>Action</td>
				    	</tr>
				    </thead>

				    <tbody>
				    	@php $i = 1 @endphp
				    	@foreach ($users as $user)
				    		<tr>
				    			<td>{{ $i }}.</td>
				    			<td>{{ $user->name }}</td>
				    			<td>{{ $user->email }}</td>
				    			<td>{{ $user->getRoleNames()->first() }}</td>
				    			<td><em><small>{{ $user->created_at->format('Y-m-d') }}</small></em></td>
				    			<td class="td-action">
				    				<form method="post" action="{{ route('staff.destroy', $user->id) }}" class="d-inline" id="delete-staff{{ $user->id }}" >
											@csrf
		          				@method('DELETE')
					    				<button type="button" class="a-delete" data-toggle="tooltip" title="Remove" onclick="confirmDelete('delete-staff{{ $user->id }}')"><i class="fas fa-times-circle"></i></button>
					    			</form>

					    			<span data-toggle="tooltip" title="Detail">
					    				<button class="a-detail btn-detail" 
					    								data-email="{{ $user->email }}"
					    								data-name="{{ $user->name }}"
					    								data-role="{{ $user->getRoleNames()->first() }}"
					    								data-profilepicture="{{ $user->staff->profilepicture }}"
					    								data-phone="{{ $user->staff->phone }}"
					    								data-gender="{{ $user->staff->gender }}"
					    								data-address="{{ $user->staff->address }}"
					    								data-createdat="{{ $user->created_at->format('Y-m-d') }}"
					    				><i class="fas fa-external-link-alt"></i></button>
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

	<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Staff Detail</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      	<div class="row px-4">
      		<div class="col-lg-4">
      			<img id="detail-profilepicture" class="img-fluid shadow-sm rounded">
      		</div>
      		<div class="col-lg-8 p-3">
      			<table class="table table-borderless" style="font-size:.8rem">
      				<tr>
      					<td class="text-secondary font-weight-medium">Staff Name:</td>
      					<td><span class="detail-name"></span></td>
      				</tr>
      				<tr>
      					<td class="text-secondary font-weight-medium">Email:</td>
      					<td><span id="detail-email"></span></td>
      				</tr>
      				<tr>
      					<td class="text-secondary font-weight-medium">Role:</td>
      					<td><span id="detail-role"></span></td>
      				</tr>
      				<tr>
      					<td class="text-secondary font-weight-medium">Phone:</td>
      					<td><span id="detail-phone"></span></td>
      				</tr>
      				<tr>
      					<td class="text-secondary font-weight-medium">Gender:</td>
      					<td><span id="detail-gender"></span></td>
      				</tr>
      				<tr>
      					<td class="text-secondary font-weight-medium">Address:</td>
      					<td><span id="detail-address"></span></td>
      				</tr>
      				<tr>
      					<td class="text-secondary font-weight-medium">Registered Date:</td>
      					<td><span id="detail-createdat"></span></td>
      				</tr>
      			</table>
      		</div>
      	</div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection


@section('script')
	<script type="text/javascript" src="{{ asset('backend/vendor/datatables/datatables.min.js') }}"></script>

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready( function () {
	    $('#datatable').DataTable();
			$('[data-toggle="tooltip"]').tooltip();

			// detail Modal

  		$('tbody').on('click', '.btn-detail', function() {
  			name = $(this).data('name');
  			email = $(this).data('email');
  			role = $(this).data('role');
  			profilepicture = $(this).data('profilepicture');
  			phone = $(this).data('phone');
  			gender = $(this).data('gender');
  			address = $(this).data('address');
  			createdat = $(this).data('createdat');


  			$('#detail-email').text(email);
  			$('.detail-name').text(name);
  			$('#detail-role').text(role);
  			$('#detail-profilepicture').attr('src', profilepicture);
  			$('#detail-phone').text(phone);

  			$('#detail-gender').text(gender);
  			$('#detail-address').text(address);
  			$('#detail-createdat').text(createdat);

  			$('#detailModal').modal('show');
  		});

	 	});

	 	// delete sweet alert
		function confirmDelete(staff_id) {
  		swal({
  			title: "Are you sure to Delete?",
  			text: "The data will be permanently deleted.",
  			icon: "warning",
  			buttons: true,
  			dangerMode: true,
  		})
  		.then((willDelete) => {
  			if (willDelete) {
  				$('#'+staff_id).submit();
  			}
  		});
  	}

	</script>
@endsection