@extends('backendtemplate')

@section('title', 'Edit Menu')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/jquery-nice-select/nice-select.css') }}">
	<style type="text/css">
		.cropit-preview {
        background-color: #fff;
        background-size: cover;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-top: 7px;
        width: 160px;
        height: 160px;
        margin: 0 auto 1rem;
      }

      .cropit-preview-image-container {
        cursor: move;
      }

      .cropit-image-input {
      	display: block;
      	width: 160px;
        margin: 1rem auto 1rem;
      }
	</style>
@endsection

@section('content')
	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Edit Menu</h5>
			<a href="{{ route('menus.index') }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Edit {{ $food->name }}</h3>
      </div>
      <div class="card-body">
      	<form class="form-horizontal" method="post" action="{{ route('menus.update', $food->id) }}" enctype="multipart/form-data">
      		@csrf
          @method('PUT')

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="name">Menu Name: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
              <input type="text" class="form-control" name="name" id="name" placeholder="Enter Menu Name" value="{{ old('name', $food->name) }}">
	          	@error('name')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-lg-4">
				    <label for="foodcategory_id" class="col-md-3 col-form-label">Category: <sup class="text-danger">*</sup></label>
				    <div class="col-md-9">
				     	<select class="form-control nice-select wide" id="foodcategory_id" name="foodcategory_id">
				     		<option value="default">Select Category</option>

				     			@foreach ($foodcategories as $foodcategory)
				     				
			     					<option value="{{ $foodcategory->id }}"
			     						@if ($foodcategory->id == $food->foodcategory_id || old('foodcategory_id') == $foodcategory->id)
				     					 selected
			     						@endif
				     				>{{ $foodcategory->name }}</option>
				     		
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
							  <input type="number" class="form-control" name="unitprice" id="unitprice" min="0" placeholder="Enter Unit Price" value="{{ old('unitprice', $food->unitprice) }}" step=".1">
							</div>
							@error('unitprice')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label">Image: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
            	<input type="hidden" name="old_image" value="{{ $food->image }}">
				    	
				    	<div class="row" id="div-old-photo">
				    		<div class="col-5 col-lg-2">
					     		<img src="{{ asset($food->image) }}" class="shadow d-block mb-3 img-fluid">
				    		</div>
				    		<div class="col-7 col-lg-10 pt-5">
				    			<button type="button" class="btn btn-outline-primary btn-sm px-3" id="btn-change-photo"><i class="fas fa-pen fa-sm pr-2"></i>Change Image</button>
				    		</div> 
				    	</div>

				    	<div class="row" id="div-new-photo" style="display: none;">
				    		<div class="col-sm-8 col-md-9 pr-md-0">
				    			<div class="custom-file">
		                <input type="file" class="custom-file-input" name="image" accept="image/*" id="image">
		                <label class="custom-file-label" for="image">Choose Menu Image</label>
		              </div>
				    		</div>
				    		<div class="col-sm-4 col-md-3 mt-sm-0 mt-3">
				    			<button class="btn btn-outline-primary btn-block" id="btn-undo" type="button"><i class="fas fa-undo fa-sm pr-2"></i>Undo</button>
				    		</div>
				    	</div>

              @if ($errors->any() && !($errors->first('image')))
              	<div class="error-message text-success pl-1 mt-1">
				     			<small>* If you have changed new image, please upload it again.</small>
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
              <button type="submit" class="btn btn-primary">Update</button>
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
    	
    	$('#image').on('change',function(e){
        var fileName = e.target.files[0].name;
        $(this).next('.custom-file-label').html(fileName);
    	})

    	$('#btn-change-photo').click(function() {
    		$('#div-old-photo').hide();
    		$('#div-new-photo').show(500);
    	});

    	$('#btn-undo').click(function() {
    		$('#image').val('');
    		$('.custom-file-label').html('Choose Menu Image');
    		$('#div-new-photo').hide();
    		$('#div-old-photo').show(500);
    	});
    })	// end of document ready function 
  </script>
@endsection