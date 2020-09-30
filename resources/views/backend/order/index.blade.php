@extends('backendtemplate')

@section('title', 'Orders')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/datatables/datatables.min.css') }}">
@endsection

@section('content')

	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Orders</h5>
			<a href="{{ route('menus.index') }}" class="btn btn-primary float-right rounded"><i class="fas fa-plus fa-sm mr-2 text-gray-100"></i> New Order</a>
			<div class="clearfix"></div>

		</div>

		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Order List</h3>
      </div>
      <div class="card-body">

				<div class="table-responsive pb-5">
				  <table class="table" id="datatable" style="width: 100%;">
				    <thead>
				    	<tr>
				    		<td>No.</td>
				    		<td>Order_ID</td>
				    		<td>Room_No.</td>
				    		<td>Menu_Count</td>
				    		<td>Order_Time</td>
				    		<td>Status</td>
				    		<td>Action</td>
				    	</tr>
				    </thead>

				    <tbody>
				    	@php $i = 1 @endphp
				    	@foreach ($orders as $order)
				    		<tr>
				    			<td>{{ $i }}.</td>
				    			<td>O-{{ $order->id }}</td>
				    			<td>R-{{ $order->room->roomno }}</td>
				    			<td>{{ count($order->food) }}</td>
				    			<td><small>{{ $order->created_at->format('Y-m-d H:i') }}</small></td>
				    			<td>
				    				@if ($order->status == "ordered")
				    					<span class="badge badge-primary badge-pill text-capitalize">{{ $order->status }}</span>
				    				@else
				    					<span class="badge badge-info badge-pill text-capitalize">{{ $order->status }}</span>
				    				@endif
				    			</td>
				    			<td class="td-action">
				    				<span data-toggle="tooltip" title="Detail">
					    				<a class="a-detail btn-detail" href="{{ route('orders.show', $order->id) }}" 
					    				><i class="fas fa-external-link-alt"></i></a>
				    				</span>

				    				@if ($order->status == "ordered")
				    					<span data-toggle="tooltip" title="Finished">
						    				<a class="a-detail btn-detail" href="{{ route('orders.edit', $order->id) }}" 
						    				><i class="fas fa-concierge-bell"></i></a>
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

@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('backend/vendor/datatables/datatables.min.js') }}"></script>

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready( function () {
	    $('#datatable').DataTable();
			$('[data-toggle="tooltip"]').tooltip();

	 	});

	</script>
@endsection