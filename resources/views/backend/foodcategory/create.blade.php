@extends('backendtemplate')

@section('title', 'New Category')

@section('content')
	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">New Food Category</h5>
			<a href="{{ route('foodcategories.index') }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Add New Cateogory</h3>
      </div>
      <div class="card-body">
      	<form class="form-horizontal" method="post" action="{{ route('foodcategories.store') }}">
      		@csrf

      		<div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="name">Category Name: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
              <input type="text" class="form-control" name="name" id="name" placeholder="Enter Category Name" value="{{ old('name') }}">
	          	@error('name')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mt-5">
            <div class="col-md-9 ml-auto">
              <button type="submit" class="btn btn-primary">Save</button>
              <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
          </div>

      	</form>
      </div>
    </div>
		{{-- form end --}}
	</section>
@endsection