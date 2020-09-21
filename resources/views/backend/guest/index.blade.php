@extends('backendtemplate')

@section('title', 'Guest')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/datatables/datatables.min.css') }}">
@endsection

@section('content')

	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Guest</h5>
			<a href="{{ route('guests.create') }}" class="btn btn-primary float-right rounded"><i class="fas fa-user-plus fa-sm mr-2 text-gray-100"></i> New Membership</a>
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
	
	<script type="text/javascript">
		$(document).ready( function () {
	    $('#datatable').DataTable();
			$('[data-toggle="tooltip"]').tooltip();

	 	});
	</script>
@endsection