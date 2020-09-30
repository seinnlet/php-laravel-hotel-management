@extends('backendtemplate')

@section('title', 'Order Detail')

@section('css')
	<style type="text/css">
		table th {
			color: #6c757d;
			font-weight: 600;
		}
		.card-body {
			font-size: .85rem;
		}
	</style>
@endsection

@section('content')
	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Order Detail</h5>
			<a href="{{ route('orders.index') }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">O-{{ $order->id }}</h3>
      </div>
      <div class="card-body">

      	<div class="row">
      		<div class="col-md-6 mb-3">
      			<table class="table table-borderless table-sm">
      				<tr>
      					<th>Order No. :</th>
      					<td>O-{{ $order->id }}</td>
      				</tr>
      				<tr>
      					<th>Order Time :</th>
      					<td>{{ $order->created_at->format('Y-m-d, H:i') }}</td>
      				</tr>
      			</table>
      		</div>
      		<div class="col-md-6 mb-3">
      			<table class="table table-borderless table-sm">
      				<tr>
      					<th>Room No. :</th>
      					<td>R-{{ $order->room->roomno }}</td>
      				</tr>
      				<tr>
      					<th>Status :</th>
      					<th>
      						@if ($order->status == "ordered")
      							<span class="text-primary text-capitalize">{{ $order->status }}</span>
      						@else
      							<span class="text-info text-capitalize">{{ $order->status }}</span>
      						@endif
      					</th>
      				</tr>
      			</table>
      		</div>
      	</div>

      	<div class="table-responsive">
      		<table class="table table-bordered">
      			<thead>
      				<tr>
      					<th>No.</th>
      					<th>Menu</th>
      					<th>Unit_Price</th>
      					<th>Qty</th>
      					<th>Sub_Total</th>
      				</tr>
      			</thead>
      			<tbody>
      				@php $i=1; @endphp
      				@foreach ($order->food as $menu)
      					<tr>
      						<td>{{ $i }}.</td>
      						<td>{{ $menu->name }}</td>
      						<td>$ {{ $menu->unitprice }}</td>
      						<td>{{ $menu->pivot->qty }}</td>
      						<td>$ {{ number_format($menu->unitprice * $menu->pivot->qty, 2) }}</td>
      					</tr>
	      				@php $i++; @endphp      					
      				@endforeach
      				<tr>
      					<td colspan="3"><span class="font-weight-medium">Notes: </span>{{ $order->note }}</td>
      					<th>Total:</th>
      					<td><big>$ {{ $order->totalprice }}</big></td>
      				</tr>
      			</tbody>
      		</table>
      	</div>
      </div>
    </div>
  </section>

@endsection