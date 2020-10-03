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
				  			<td>Status</td>
				  			<td>Action</td>
				  		</tr>
				  	</thead>
				  	<tbody>
				  		@php $i=1; @endphp
				  		@foreach ($usedservices as $service)
		  		
		  					<tr>
		  						<td>{{ $i }}</td>
		  						<td>{{ $service->roomno }}</td>
		  						<td>{{ $service->name }}</td>
		  						<td>{{ $service->totalqty }}</td>
		  						<td>$ {{ $service->totalcharges }}</td>
		  						<td>
		  							@if ($service->status == "Request")
		  								<span class="badge badge-primary badge-pill">{{ $service->status }}</span>
		  							@else
		  								<span class="badge badge-info badge-pill">{{ $service->status }}</span>
		  							@endif
		  						</td>
		  						<td class="td-action">
		  							<span data-toggle="tooltip" title="View Notes">
					    				<button class="a-detail btn-detail btn-view" 
					    								data-note="{{ $service->note }}"
					    								data-date="{{ date('Y-m-d H:i', strtotime($service->created_at)) }}"
					    				><i class="fas fa-external-link-alt"></i></button>
				    				</span>

				    				@if ($service->status == "Request")
				    					<span data-toggle="tooltip" title="Done">
						    				<a class="a-detail btn-detail" href="{{ route('services.done', [$service->service_id, $service->room_id]) }}" 
						    				><i class="fas fa-concierge-bell"></i></a>
					    				</span>
				    				@endif

		  						</td>
		  					</tr>
				  			@php $i++; @endphp

				  		@endforeach
				  	</tbody>
				  </table>
				</div>
			</div>
		</div>
	</section>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Notes: </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      	<p id="detail-note"></p>	
      	<small>At <span id="detail-date" class="font-italic"></span></small>
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

	<script type="text/javascript">
		$(document).ready( function () {
			$('[data-toggle="tooltip"]').tooltip();
	    $('#datatable').DataTable();

	    $('tbody').on('click', '.btn-view', function() {
  			note = $(this).data('note');
  			note = (note) ? note : 'Nothing to Show...'; 
  			date = $(this).data('date');
	    	$('#detail-note').text(note);
	    	$('#detail-date').text(date);
	    	$('#detailModal').modal('show');
  		});

	 	});

	 </script>
@endsection