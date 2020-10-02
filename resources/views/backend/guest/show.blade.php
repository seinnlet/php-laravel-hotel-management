@extends('backendtemplate')

@section('title', 'Guest Detail')

@section('css')
	<style type="text/css">
		hr {
      margin: 1.2rem auto 2.2rem;
      background-color: #fff;
      border-top: 1px dashed #ccc !important;
    }
	</style>
@endsection

@section('content')
	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Guest Detail</h5>
			<a href="{{ route('guests.index') }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Customer Info</h3>
      </div>
      <div class="card-body">
      	
      	<div class="row">
      		<div class="col-md-4 mb-5 text-center mt-2">
	      		<img src="{{ asset($guest->profilepicture) }}" alt="GuestProfile" class="shadow rounded-circle" style="width: 160px; height: 160px; object-fit:cover;">
      		</div>

      		<div class="col-md-8">
      			<table class="table table-borderless" style="font-size: .85rem;">
      				<tr>
      					<td class="font-weight-medium">Name : </td>
      					<td>{{ $guest->user->name }}</td>
      				</tr>
      				<tr>
      					<td class="font-weight-medium">Email : </td>
      					<td>{{ $guest->user->email }}</td>
      				</tr>
      				<tr>
      					<td class="font-weight-medium">Phone No. : </td>
      					<td>{{ $guest->phone1 }} @if ($guest->phone2), {{ $guest->phone2 }} @endif</td>
      				</tr>
      				<tr>
      					<td class="font-weight-medium">Address : </td>
      					<td>{{ $guest->city }}, {{ $guest->country }}</td>
      				</tr>
      			</table>
      		</div>
      	</div>

      	@if ($guest->membertype_id)
      		<hr>
      		<h6 class="h6 mb-5">Member Info</h6>

      		<div class="row">
      			<div class="col-md-5 col-lg-4 mb-5 px-4">
      				<div class="card rounded credit-card bg-hover-gradient-primary">
				        <div class="content d-flex flex-column justify-content-between py-3 px-4">
				          <h1 class="mb-5"><i class="far fa-address-card fa-sm"></i></h1>
				          <div class="d-flex justify-content-between align-items-end pt-1">
				            <div class="text-uppercase">
				              <div class="font-weight-bold d-block">{{ $guest->membertype->name }}</div><small class="text-gray">M-{{ $guest->member_id }}</small>
				            </div>
				          </div>
				        </div>
				      </div>
      			</div>

      			<div class="col-md-7 col-lg-8">
	      			<table class="table table-borderless" style="font-size: .85rem;">
	      				<tr>
	      					<td class="font-weight-medium">Member ID :</td>
	      					<td>M-{{ $guest->member_id }} ({{ $guest->membertype->name }})</td>
	      				</tr>
	      				<tr>
	      					<td class="font-weight-medium">Points : </td>
	      					<td>{{ $guest->points }}</td>
	      				</tr>
	      				<tr>
	      					<td class="font-weight-medium">From : </td>
	      					<td>{{ $guest->memberstartdate }}</td>
	      				</tr>
	      				<tr>
	      					<td class="font-weight-medium">To : </td>
	      					@php $todate = date('Y-m-d', strtotime('+1 year', strtotime($guest->memberstartdate)) ); @endphp
	      					<td>{{ $todate }}</td>
	      				</tr>
	      			</table>
	      		</div>

      		</div>
      	@endif

      </div>
    </div>
  </section>
@endsection