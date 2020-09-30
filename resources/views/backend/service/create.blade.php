@extends('backendtemplate')

@section('title', 'New Service')

@section('content')
	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">New Service</h5>
			<a href="{{ route('services.index') }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Add New Service</h3>
      </div>
      <div class="card-body">
      	<form class="form-horizontal" method="post" action="{{ route('services.store') }}">
      		@csrf

      		<div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="name">Service Name: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
              <input type="text" class="form-control" name="name" id="name" placeholder="Enter Service Name" value="{{ old('name') }}">
	          	@error('name')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="unitcharge">Unit Charge: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
              <div class="input-group">
							  <div class="input-group-prepend">
							    <span class="input-group-text">$</span>
							  </div>
							  <input type="number" class="form-control" name="unitcharge" id="unitcharge" min="0" placeholder="Enter Unit Charge" value="{{ old('unitcharge') }}" step=".01">
							</div>
							@error('unitcharge')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mt-5">
            <div class="col-md-9 ml-auto">
              <button type="submit" class="btn btn-primary">Save</button>
              <button type="reset" class="btn btn-outline-secondary btn-reset">Reset</button>
            </div>
          </div>

      	</form>
      </div>
    </div>
  </section>

@endsection