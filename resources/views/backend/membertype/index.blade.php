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

      	<div class="table-responsive pb-5">
				  <table class="table" id="datatable" style="width: 100%">
				    <thead>
				    	<tr>
				    		<td>No.</td>
				    		<td>Member_Type</td>
				    		<td>Earn_Points</td>
                <td>Level</td>
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
                  <td>{{ $membertype->level }}</td>
				    			<td class="td-action">
				    				<a href="{{ route('membertypes.edit', $membertype->id) }}" class="a-edit" data-toggle="tooltip" title="Edit"><i class="fas fa-pen"></i></a>
				    				
				    				<form method="post" action="{{ route('membertypes.destroy', $membertype->id) }}" class="d-inline" id="delete-membertype{{ $membertype->id }}" >
											@csrf
		          				@method('DELETE')
					    				<button type="button" class="a-delete" data-toggle="tooltip" title="Delete" onclick="confirmDelete('delete-membertype{{ $membertype->id }}')"><i class="fas fa-times-circle"></i></button>
					    			</form>

					    			<span data-toggle="tooltip" title="Detail">
					    				<button class="a-detail btn-detail" 
					    								data-name="{{ $membertype->name }}"
					    								data-earnpoints="{{ $membertype->earnpoints }}"
					    								data-laundrydiscount="{{ $membertype->laundrydiscount }}"
					    								data-fooddiscount="{{ $membertype->fooddiscount }}"
					    								data-additionalbenefits="{{ $membertype->additionalbenefits }}"
					    								data-numberofstays="{{ $membertype->numberofstays }}"
					    								data-numberofnights="{{ $membertype->numberofnights }}"
					    								data-paidamount="{{ $membertype->paidamount }}"
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
        <h6 class="modal-title" id="exampleModalLabel">Member Type Detail</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      	<div class="row">
      		<div class="col-lg-6 p-3">
      			<p class="text-primary"><strong><span id="detail-name"></span></strong></p>

      			<table class="table table-borderless" style="font-size:.8rem">
      				<tr>
      					<td class="text-secondary font-weight-medium">Earn Points:</td>
      					<td><span id="detail-earnpoints"></span>%</td>
      				</tr>
      				<tr>
      					<td class="text-secondary font-weight-medium">Laundry Discount:</td>
      					<td><span id="detail-laundrydiscount"></span>%</td>
      				</tr>
      				<tr>
      					<td class="text-secondary font-weight-medium">Food Discount:</td>
      					<td><span id="detail-fooddiscount"></span>%</td>
      				</tr>
      				<tr>
      					<td colspan="2">
      						<span class="text-secondary font-weight-medium">Additional Benefits:</span> <br>
      						<span id="detail-additionalbenefits"></span>
      					</td>
      				</tr>
      			</table>
      		</div>
      		<div class="col-lg-6 p-3">
      			<p class="text-gray-500"><strong>Restrictions</strong></p>

      			<table class="table table-borderless table-striped" style="font-size:.8rem">
      				<tr>
      					<td>Number of Stays:</td>
      					<td><span id="detail-numberofstays"></span></td>
      				</tr>
      				<tr>
      					<td>Number of Nights:</td>
      					<td><span id="detail-numberofnights"></span></td>
      				</tr>
      				<tr>
      					<td>Paid Amount:</td>
      					<td><span id="detail-paidamount"></span></td>
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
			$('[data-toggle="tooltip"]').tooltip();
	    $('#datatable').DataTable();

	    // detail Modal
  		
  		$('tbody').on('click', '.btn-detail', function() {
  			name = $(this).data('name');
  			earnpoints = $(this).data('earnpoints');
  			laundrydiscount = $(this).data('laundrydiscount');
  			fooddiscount = $(this).data('fooddiscount');
  			additionalbenefits = $(this).data('additionalbenefits');

  			numberofstays = $(this).data('numberofstays');
  			numberofnights = $(this).data('numberofnights');
  			paidamount = $(this).data('paidamount');


  			$('#detail-name').text(name);
  			$('#detail-earnpoints').text(earnpoints);
  			$('#detail-laundrydiscount').text(laundrydiscount);
  			$('#detail-fooddiscount').text(fooddiscount);
  			$('#detail-additionalbenefits').text(additionalbenefits);

  			$('#detail-numberofstays').text(numberofstays);
  			$('#detail-numberofnights').text(numberofnights);
  			$('#detail-paidamount').text(paidamount);

  			$('#detailModal').modal('show');
  		});
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