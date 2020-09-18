@extends('backendtemplate')

@section('title', 'New RoomType')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/image-uploader/image-uploader.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/summernote/summernote-lite.min.css') }}">
@endsection

@section('content')
	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">New Room Type</h5>
			<a href="{{ route('roomtypes.index') }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Add New Room Type</h3>
      </div>
      <div class="card-body">
      	<form class="form-horizontal" method="post" action="{{ route('roomtypes.store') }}" enctype="multipart/form-data">
      		@csrf

      		<div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="name">Room Type Name: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
              <input type="text" class="form-control" name="name" id="name" placeholder="Enter Room Type Name" value="{{ old('name') }}">
	          	@error('name')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="pricepernight">Price per Night: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
              <div class="input-group">
							  <div class="input-group-prepend">
							    <span class="input-group-text">$</span>
							  </div>
							  <input type="number" class="form-control" name="pricepernight" id="pricepernight" min="0" placeholder="Price per Night" value="{{ old('pricepernight') }}">
                <div class="input-group-append">
                  <span class="input-group-text">.00</span>
                </div>
							</div>
							@error('pricepernight')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="noofpeople">No of People: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
              <input type="number" class="form-control" name="noofpeople" id="noofpeople" placeholder="Enter No of People" value="{{ old('noofpeople') }}" min="1">
							@error('noofpeople')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="noofbed">No of Bed: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
              <input type="number" class="form-control" name="noofbed" id="noofbed" placeholder="Enter No of Bed" value="{{ old('noofbed') }}" min="1">
							@error('noofbed')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="summernote">Description: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
							<textarea id="summernote" name="description">{{ old('description') }}</textarea>
							@error('description')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="image">Room Images (1-3): <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
							<div class="input-images" id="image"></div>
							@error('images')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror

				     	@if ($errors->any() && !($errors->first('images')))
              	<div class="error-message text-success pl-1 mt-1">
				     			<small>* Sorry, Please Upload your Images again.</small>
				     		</div>
              @endif
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

@section('script')
	<script type="text/javascript" src="{{ asset('backend/vendor/image-uploader/image-uploader.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/vendor/summernote/summernote-lite.min.js') }}"></script>

	<script type="text/javascript">
		$(document).ready(function() {
		  $('#summernote').summernote({
		  	height: 200,
			  placeholder: 'About this room type...',
		  	toolbar: [
			    // [groupName, [list of button]]
			    ['style', ['bold', 'italic', 'underline', 'clear']],
			    ['font', ['strikethrough', 'superscript', 'subscript']],
			    ['fontsize', ['fontsize']],
			    ['para', ['ul', 'ol', 'paragraph']],
			    ['height', ['height']]
			  ]
		  });

			$('.input-images').imageUploader();
		});

	</script>
@endsection