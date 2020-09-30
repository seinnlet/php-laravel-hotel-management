@extends('backendtemplate')

@section('title', 'New Service')

@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/jquery-nice-select/nice-select.css') }}">
@endsection

@section('content')
	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Service Usage</h5>
			<a href="{{ route('services.index') }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Service Requirement</h3>
      </div>
      <div class="card-body">
      	<form class="form-horizontal" method="post" action="{{ route('services.use', $service->id) }}">
      		@csrf

      		<div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="name">Service Name: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
              <input type="text" class="form-control bg-white" name="name" id="name" placeholder="Enter Service Name" value="{{ $service->name }}" readonly>
            </div>
          </div>

          <div class="form-group row mb-4">
          	<label class="col-md-3 col-form-label" for="room_id">Room No: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
            	
            	<select class="form-control nice-select wide" id="room_id" name="room_id" >
				     		<option value="default">Select Room No.</option>
				     			@foreach ($rooms as $room)
				     				<option value="{{ $room->id }}" @if(old('room_id') == $room->id) selected @endif >R-{{ $room->roomno }}</option>
				     			@endforeach
				     	</select>
				     	@error('room_id')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-4">
          	<label class="col-md-3 col-form-label" for="totalqty">Qty: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
            	<input type="number" name="totalqty" id="totalqty" placeholder="Enter Qty" min="1" value="{{ old('totalqty', 1) }}" class="form-control">
            	@error('totalqty')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="totalcharges">Total Charges: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">
            	<div class="input-group">
							  <div class="input-group-prepend">
							    <span class="input-group-text">$</span>
							  </div>
              	<input type="text" class="form-control bg-white" name="totalcharges" id="totalcharges" placeholder="Total Charges" readonly value="{{ old('totalcharges', $service->unitcharge) }}">
              </div>
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="note">Notes: </label>
            <div class="col-md-9">
            	<textarea name="note" id="note" class="form-control" placeholder="Add Notes..." rows="4"></textarea>
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

@section('script')
	<script type="text/javascript" src="{{ asset('backend/vendor/jquery-nice-select/jquery.nice-select.min.js') }}"></script>

	<script type="text/javascript">
    $(function () {
    	$('select').niceSelect();

    	$('form').on('change keyup', '#totalqty', function() {
    		let qty = $(this).val();
    		let charge = {{ $service->unitcharge }}
    		if (qty) {
    			totalcharges = qty * charge;
    			$('#totalcharges').val(totalcharges.toFixed(2));
    		} else {
    			$('#totalcharges').val(0);
    		}
    	});
    	$('#totalqty').keypress(function(e) {
				if (e.which != 8 && e.which != 0 && (e.which < 49 || e.which > 57)) {
					return false;
				}
			});
    })	
  </script>
@endsection