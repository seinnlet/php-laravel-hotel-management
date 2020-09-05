@extends('backendtemplate')

@section('title', 'Member Types')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/datatables/datatables.min.css') }}">

	<style type="text/css">
		.dataTables_wrapper .dataTables_filter {
			margin-bottom: 20px;
		}
		.dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_paginate {
			margin-top: 20px;
		}
		.dataTables_wrapper .dataTables_filter input {
			border: 1px solid #aaa;
		}
		.dataTables_wrapper .dataTables_filter input:focus {
			outline: none;
		}
		table.dataTable tbody th, table.dataTable tbody td {
		  padding: 12px 20px;
		  vertical-align: middle;
		}
	</style>
@endsection

@section('content')

	<section class="py-5">
		<h5 class="title-heading">Member Type</h5>

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
				    			<td>{{ $membertype->earnpoints }}</td>
				    			<td class="td-action">
				    				<a href="" class="a-edit" data-toggle="tooltip" title="Edit"><i class="fas fa-pen"></i></a>
				    				<a href="" class="a-delete" data-toggle="tooltip" title="Delete"><i class="fas fa-times-circle"></i></a>
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

	<script type="text/javascript">
		$(document).ready( function () {
			$('[data-toggle="tooltip"]').tooltip();
	    $('#datatable').DataTable();
		});
	</script>
@endsection