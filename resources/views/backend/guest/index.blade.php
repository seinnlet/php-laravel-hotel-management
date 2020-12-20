@extends('backendtemplate')

@section('title', 'Guest')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/datatables/datatables.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/sumoselect/sumoselect.min.css') }}">

	<style type="text/css">
		#report-form label {
			font-size: .8rem;
		}
		.custom-control-label {
			font-size: .9rem !important;
		}
		.SumoSelect {
		  width: 100%;
		}
		.SumoSelect>.CaptionCont {
			border: 1px solid #ced4da;
			height: calc(1.5em + .75rem + 2px);
			border-radius: 4px;
		}
		.SumoSelect.open>.CaptionCont, .SumoSelect:focus>.CaptionCont {
	    box-shadow: 0 0 0 0.2rem rgba(205, 164, 94, 0.25);
	    border-color: #f2cd8f;
		}
		.SumoSelect:hover>.CaptionCont {
			box-shadow: none;
			border-color: #ced4da;
		}
	</style>
@endsection

@section('content')

	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Guest</h5>
			<button class="btn btn-primary float-right rounded" data-toggle="modal" data-target="#reportModal"><i class="fas fa-upload fa-sm mr-2 text-gray-100"></i> Generate Report</button>
			<div class="clearfix"></div>
		</div>

		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Guest List</h3>
      </div>
      <div class="card-body">
      	<div class="table-responsive pb-5">
				  <table class="table" id="datatable" style="width: 100%">
				    <thead>
				    	<tr>
				    		<td>No.</td>
				    		<td>Name</td>
				    		<td>Email</td>
				    		<td>Member_Type</td>
				    		<td>Registered_at</td>
				    		<td>Action</td>
				    	</tr>
				    </thead>

				    <tbody>
				    	@php $i = 1 @endphp
				    	@foreach ($guests as $guest)
				    		<tr>
				    			<td>{{ $i }}.</td>
				    			<td>{{ $guest->user->name }}</td>
				    			<td>{{ $guest->user->email }}</td>
				    			<td>
				    				@if ($guest->membertype_id)
				    					<span class="badge badge-primary badge-pill">{{ $guest->membertype->name }}</span>
				    				@else
				    					<span class="badge badge-light badge-pill">Not Yet</span>
				    				@endif
				    			</td>
				    			<td><em><small>{{ $guest->created_at->format('Y-m-d') }}</small></em></td>
				    			<td class="td-action">
					    			<span data-toggle="tooltip" title="Detail">
					    				<a class="a-detail btn-detail" href="{{ route('guests.show', $guest->id) }}"><i class="fas fa-external-link-alt"></i></a>
				    				</span>

				    				@if (!$guest->membertype_id)
					    				<span data-toggle="tooltip" title="Add to Member">
						    				<a class="a-detail btn-detail" href="{{ route('guests.createmember', $guest->id) }}"><i class="fas fa-user-plus"></i></a>
					    				</span>
					    			@endif
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

	<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
      <div class="modal-content">
        <form id="report-form">
	        <div class="modal-header">
	          <h5 class="modal-title text-secondary font-weight-medium" id="exampleModalLabel">Customer Report </h5>
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	          </button>
	        </div>
        	<div class="modal-body">
        		<div class="row">
	        		<div class="col-md-6">
        				<h6 class="font-weight-medium text-primary mb-3">- Report Detail -</h6>

	        			<div class="form-group">
	        				<label for="reportname">Report Name:</label>
	        				<input type="text" name="reportname" class="form-control" placeholder="Report Name">
	        			</div>

	        			<div class="form-group form-row">
	        				<div class="col-6">
	        					<label for="fromdate">From:</label>
	        					<input type="date" name="fromdate" class="form-control">
	        				</div>
	        				<div class="col-6">
	        					<label for="todate">To:</label>
	        					<input type="date" name="todate" class="form-control">
	        				</div>
	        			</div>

	        			<div class="form-group mt-5">
	        				<label>Saved as: </label>
	        				<div class="custom-control custom-radio custom-control-inline ml-4">
									  <input type="radio" id="pdf" name="savedas" class="custom-control-input" value="pdf">
									  <label class="custom-control-label" for="pdf">PDF</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
									  <input type="radio" id="csv" name="savedas" class="custom-control-input" value="csv">
									  <label class="custom-control-label" for="csv">CSV</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
									  <input type="radio" id="excel" name="savedas" class="custom-control-input" value="excel">
									  <label class="custom-control-label" for="excel">Excel</label>
									</div>

	        			</div>

	        		</div>

	        		<div class="col-md-6">
				        <h6 class="font-weight-medium text-primary mb-3">- Filter -</h6>
	        			<div class="form-group">
	        				<label for="fieldname">Field Names:</label>
	        				<div>
	        					<select class="form-control SlectBox" id="fieldname" name="fieldname" multiple="multiple">
		        					<option>Hello</option>
		        					<option>Hi</option>
		        				</select>
	        				</div>
	        			</div>

	        		</div>
	        	</div>
	        	
	        </div>
	        <div class="modal-footer">
		        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
	        	<button type="submit" class="btn btn-primary">Generate Report</button>
		      </div>	
       	</form>
      </div>
    </div>
  </div>

@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('backend/vendor/datatables/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/vendor/sumoselect/jquery.sumoselect.min.js') }}"></script>
	
	<script type="text/javascript">
		$(document).ready( function () {
	    $('#datatable').DataTable();
			$('[data-toggle="tooltip"]').tooltip();
			$('#fieldname').SumoSelect();
	 	});
	</script>
@endsection