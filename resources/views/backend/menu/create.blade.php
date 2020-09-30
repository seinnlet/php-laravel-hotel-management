@extends('backendtemplate')

@section('title', 'New Menu')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/jquery-nice-select/nice-select.css') }}">
@endsection

@section('content')
	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">New Menu</h5>
			<a href="{{ route('menus.index') }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Add New Menu</h3>
      </div>
      <div class="card-body">
      	<form class="form-horizontal" method="post" action="{{ route('menus.store') }}" enctype="multipart/form-data">
      		@csrf

      		<div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="name">Menu Name: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
              <input type="text" class="form-control" name="name" id="name" placeholder="Enter Menu Name" value="{{ old('name') }}">
	          	@error('name')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="foodcategory_id">Category: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">

              <select class="form-control nice-select wide" id="foodcategory_id" name="foodcategory_id" >
				     		<option value="default">Select Category</option>
				     			@foreach ($foodcategories as $foodcategory)
				     				<option value="{{ $foodcategory->id }}" @if(old('foodcategory_id') == $foodcategory->id) selected @endif >{{ $foodcategory->name }}</option>
				     			@endforeach
				     	</select>

	          	@error('foodcategory_id')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="unitprice">Unit Price: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
              <div class="input-group">
							  <div class="input-group-prepend">
							    <span class="input-group-text">$</span>
							  </div>
							  <input type="number" class="form-control" name="unitprice" id="unitprice" min="0" placeholder="Enter Unit Price" value="{{ old('unitprice') }}" step=".01">
							</div>
							@error('unitprice')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="customFile">Image: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
            	<div class="custom-file">
							  <input type="file" class="custom-file-input" id="customFile" name="image" accept="image/*">
							  <label class="custom-file-label" for="customFile">Choose Image</label>
							</div>
							@if ($errors->any() && !($errors->first('image')))
              	<div class="error-message text-success pl-1 mt-1">
				     			<small>* Please upload your image again.</small>
				     		</div>
              @endif

              @error('image')
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

@section('script')
	
	<script type="text/javascript" src="{{ asset('backend/vendor/jquery-nice-select/jquery.nice-select.min.js') }}"></script>

	<script type="text/javascript">
    
    $(function () {
    	$('select').niceSelect();
    	$('#customFile').on('change',function(e){
        var fileName = e.target.files[0].name;
        $(this).next('.custom-file-label').html(fileName);
    	})

    	$('.btn-reset').click(function() {
    		$('.custom-file-label').html('Choose Image');
    	});
    })	// end of document ready function 
  </script>

@endsection