@extends('backendtemplate')

@section('title', 'Add Member')

@section('content')
	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Membership</h5>
			<a href="{{ route('guests.index') }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Add Membership</h3>
      </div>
      <div class="card-body">

      	@if (!$guest->membertype_id)
	      	<form class="form-horizontal" method="post" action="{{ route('guests.storemember', $guest->id) }}">
	      		@csrf

	          <div class="form-group row mb-4">
	            <label class="col-md-3 col-form-label" for="name">Member Name: <sup class="text-danger">*</sup></label>
	            <div class="col-md-9">
	              <input type="text" class="form-control bg-white" name="name" id="name" value="{{ $guest->user->name }}" readonly>
	            </div>
	          </div>

	          <div class="form-group row mb-4">
	            <label class="col-md-3 col-form-label" for="member_id">Member ID: <sup class="text-danger">*</sup></label>
	            <div class="col-md-9">
	            	<input type="text" name="member_id" value="{{ $member_id }}" id="member_id" class="form-control bg-white" readonly>
	            </div>
	          </div>

	          <div class="form-group row mb-4">
	            <label class="col-md-3 col-form-label" for="membertype_id">Member Type: <sup class="text-danger">*</sup></label>
	            <div class="col-md-9">
	            	<select class="form-control" id="membertype_id" name="membertype_id">
	            		@foreach ($membertypes as $membertype)
	            			<option value="{{ $membertype->id }}" @if ($membertype->id != 1) disabled @endif>{{ $membertype->name }}</option>
	            		@endforeach
	            	</select>
	            </div>
	          </div>

	          <div class="form-group row mb-4">
	            <label class="col-md-3 col-form-label" for="memberstartdate">Member Start Date: <sup class="text-danger">*</sup></label>
	            <div class="col-md-9">
	            	@php $today = date('Y-m-d') @endphp
	              <input type="text" class="form-control bg-white" name="memberstartdate" id="memberstartdate" value="{{ $today }}" readonly>
	            </div>
	          </div>

	          <div class="form-group row mt-5">
	            <div class="col-md-9 ml-auto">
	              <button type="submit" class="btn btn-primary">Register</button>
	            </div>
	          </div>

	      	</form>
      	@else
      		<p>This Customer is already a Member.</p>
      	@endif

      </div>
    </div>
  </section>
@endsection