@extends('backendtemplate')

@section('title', 'Edit Room')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/jquery-nice-select/nice-select.css') }}">
@endsection

@section('content')
	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Edit Room</h5>
			<a href="{{ route('rooms.index') }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Edit R-{{ $room->roomno }}</h3>
      </div>
      <div class="card-body">
      	<form class="form-horizontal" method="post" action="{{ route('rooms.update', $room->id) }}">
      		@csrf
          @method('PUT')
          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="roomno">Room No: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
              <input type="text" class="form-control" name="roomno" id="roomno" placeholder="Room No" value="{{ old('roomno', $room->roomno) }}">
	          	@error('roomno')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-lg-4">
				    <label for="roomtype_id" class="col-md-3 col-form-label">Room Type: <sup class="text-danger">*</sup></label>
				    <div class="col-md-9">
				     	<select class="form-control nice-select wide" id="roomtype_id" name="roomtype_id">
				     		<option value="default">Select Room Type</option>

				     			@foreach ($roomtypes as $roomtype)
				     				
			     					<option value="{{ $roomtype->id }}"
			     						@if ($roomtype->id == $room->roomtype_id || old('roomtype_id') == $roomtype->id)
				     					 selected
			     						@endif
				     				>{{ $roomtype->name }}</option>
				     		
				     			@endforeach

				     	</select>

				     	@error('roomtype_id')
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

    })	// end of document ready function 
  </script>
@endsection