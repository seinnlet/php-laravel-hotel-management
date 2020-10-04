@extends('backendtemplate')

@section('title', 'Change Password')

@section('content')
	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Change Password</h5>
			<a href="{{ route('staff.show', Auth::id()) }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Create New Password</h3>
      </div>
      <div class="card-body">
      	<form class="form-horizontal" method="post" action="{{ route('updatepassword') }}">
      		@csrf

      		<div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="password">Password: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
              <input type="password" class="form-control" name="password" id="password" placeholder="Enter New Password" value="{{ old('password') }}">
	          	@error('password')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="confirmpassword">Confirm Password: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
              <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Enter Confirm Password">
	          	@error('confirmpassword')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

      		<div class="form-group row mt-5">
            <div class="col-md-9 ml-auto">
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>

      	</form>
      </div>
    </div>
  </section>
@endsection