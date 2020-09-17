@extends('backendtemplate')

@section('title', 'New Staff')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/jquery-nice-select/nice-select.css') }}">
@endsection

@section('content')
	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">New Staff</h5>
			<a href="{{ route('staff.index') }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Add New Staff</h3>
      </div>
      <div class="card-body">
      	<form class="form-horizontal" method="post" action="{{ route('staff.store') }}">
      		@csrf
          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="name">Staff Name: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
              <input type="text" class="form-control" name="name" id="name" placeholder="Enter Staff Name" value="{{ old('name') }}">
	          	@error('name')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="email">Email: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
              <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address" value="{{ old('email') }}">
	          	@error('email')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="phone">Phone: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
              <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number" value="{{ old('phone') }}">
	          	@error('phone')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="role">Role: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">

              <select class="form-control nice-select wide" id="role" name="role" >
				     		<option value=1>Select Role</option>
				     			@foreach ($roles as $role)
				     				<option value="{{ $role->name }}" @if(old('role') == $role->name) selected @endif >{{ $role->name }}</option>
				     			@endforeach
				     	</select>

	          	@error('role')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label">Gender: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
            	<div class="custom-control custom-radio custom-control-inline">
                <input id="male" type="radio" name="gender" class="custom-control-input" {{ (old('gender') == 'Male' ) ? 'checked' : '' }} value="Male" @if (!old('gender')) checked @endif>
                <label for="male" class="custom-control-label">Male</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input id="female" type="radio" name="gender" class="custom-control-input" {{ (old('gender') == 'Female' ) ? 'checked' : '' }} value="Female">
                <label for="female" class="custom-control-label">Female</label>
              </div>
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="address">Address: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
            	<textarea class="form-control" rows="4" id="address" name="address" placeholder="Enter Address">{{ old('address') }}</textarea>
            	@error('address')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mt-5">
            <div class="col-md-9 ml-auto">
              <button type="submit" class="btn btn-primary">Register</button>
              <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
          </div>
        </form>
      </div>
    </div>
		{{-- form end --}}
	</section>
@endsection

@section('script')
	
	<script type="text/javascript" src="{{ asset('backend/vendor/jquery-nice-select/jquery.nice-select.min.js') }}"></script>

	<script type="text/javascript">
    
    $(function () {
    	$('select').niceSelect();

    })	// end of document ready function 
  </script>
@endsection