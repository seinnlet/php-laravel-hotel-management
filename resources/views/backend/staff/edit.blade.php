@extends('backendtemplate')

@section('title', 'Edit Profile')

@section('css')
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
			<h5 class="title-heading d-inline-block float-left">Edit Profile</h5>
			<a href="{{ route('staff.show', $user->id) }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Personal Info</h3>
      </div>
      <div class="card-body">
      	@if (Auth::id() == request()->segment(2))
      		<form class="form-horizontal" method="post" action="{{ route('staff.update', $user->id) }}" enctype="multipart/form-data">
	      		@csrf
	          @method('PUT')
		      	<div class="row">
		      		<div class="col-md-3 div-profilepicture mb-5">
		      			<input type="hidden" name="profilestatus" value="old" id="profilestatus">
		      			<input type="hidden" name="oldprofile" value="{{ $user->staff->profilepicture }}">
		      		
		      			<div class="image-editor text-center">
						      <div class="cropit-preview"></div>
						      <button class="btn btn-outline-secondary btn-sm btn-change" type="button">Change New</button>
						      <div id="div-new" style="display: none;">
						      	<input type="file" class="cropit-image-input form-control-sm" name="newprofile">
							      <button class="btn btn-outline-secondary btn-sm btn-cancel" type="button">Cancel</button>
						      </div>
							      
						    </div>

		      		</div>
		      		<div class="col-md-9">

			          <div class="form-row mb-4">
			          	<label class="col-3 col-form-label" for="name">Name : </label>
			          	<div class="col-9">
			          		<input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
			          		@error('name')
								     	<div class="error-message text-danger pl-1 mt-1">
							     			<small>{{ $message }}</small>
							     		</div>
							     	@enderror
			          	</div>
			          </div>

			          <div class="form-row mb-4">
			          	<label class="col-3 col-form-label" for="email">Email : </label>
			          	<div class="col-9">
			          		<input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
			          		@error('email')
								     	<div class="error-message text-danger pl-1 mt-1">
							     			<small>{{ $message }}</small>
							     		</div>
							     	@enderror
			          	</div>
			          </div>

			          <div class="form-row mb-4">
			          	<label class="col-3 col-form-label" for="phone">Phone : </label>
			          	<div class="col-9">
			          		<input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $user->staff->phone) }}">
			          		@error('phone')
								     	<div class="error-message text-danger pl-1 mt-1">
							     			<small>{{ $message }}</small>
							     		</div>
							     	@enderror
			          	</div>
			          </div>

			          <div class="form-row mb-4">
			          	<label class="col-3 col-form-label" for="address">Address : </label>
			          	<div class="col-9">
			          		<textarea class="form-control" id="address" name="address" rows="4">{{ old('address', $user->staff->address) }}</textarea>
			          		@error('address')
								     	<div class="error-message text-danger pl-1 mt-1">
							     			<small>{{ $message }}</small>
							     		</div>
							     	@enderror
			          	</div>
			          </div>

			          <div class="form-row mb-4">
			          	<div class="col-md-9 ml-auto">
				          	<button type="submit" class="btn btn-primary">Update</button>
			          	</div>
			          </div>

	      			</div>
	      		</div>
			    
			    </form>
			  @else 
			  	<p>You can't Edit other people's profile.</p>
      	@endif
	  			
      </div>

    </div>
  </section>

@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('backend/vendor/cropit/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('backend/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
	<script type="text/javascript" src="{{ asset('backend/vendor/cropit/dist/jquery.cropit.js') }}"></script>
	<script type="text/javascript">
		$(function () {

			$('.image-editor').cropit({
			 	imageState: {
          src: '{{ asset($user->staff->profilepicture) }}',
        },
			 });

      $('.btn-change').click(function() {
      	$(this).hide();
      	$('#div-new').show();
      	$('#profilestatus').val('new');
      	$('.btn-cancel').show();
      });

      $('.btn-cancel').click(function() {
      	$(this).hide();
      	$('#div-new').hide();
      	$('.btn-change').show();
      	$('.image-editor').cropit('imageSrc', '{{ asset($user->staff->profilepicture) }}');
      	// $('.cropit-preview-image').attr('src', '');
      	// $('.cropit-preview-image').attr('style', 'transform-origin: left top; will-change: transform; transform: translate(0px, 0px) scale(0.308594) rotate(0deg);');
      	$('#profilestatus').val('old');
      });
		})
	</script>
@endsection