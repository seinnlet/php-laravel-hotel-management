@extends('backendtemplate')

@section('title', 'New Room')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/jquery-nice-select/nice-select.css') }}">
@endsection

@section('content')
	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">New Room</h5>
			<a href="{{ route('rooms.index') }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Generate Room No</h3>
      </div>
      <div class="card-body">
      	<form class="form-horizontal" method="post" action="{{ route('rooms.store') }}">
      		@csrf

      		<div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="roomtype_id">Room Type: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">

              <select class="form-control nice-select wide" id="roomtype_id" name="roomtype_id" >
				     		<option value="default">Select Room Type</option>
				     			@foreach ($roomtypes as $roomtype)
				     				<option value="{{ $roomtype->id }}" @if(old('roomtype_id') == $roomtype->id) selected @endif >{{ $roomtype->name }}</option>
				     			@endforeach
				     	</select>

	          	@error('roomtype_id')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

      		<div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="floor">Floor: <sup class="text-danger">*</sup></label>
            <div class="col-md-9">

              <select class="form-control nice-select wide" id="floor" name="floor" >
				     		<option value="default">Select Floor</option>
			     			<option value="1" @if (old('floor') == 1) selected @endif >1st Floor</option>
			     			<option value="2" @if (old('floor') == 2) selected @endif >2nd Floor</option>
			     			<option value="3" @if (old('floor') == 3) selected @endif >3rd Floor</option>
			     			<option value="5" @if (old('floor') == 5) selected @endif >5th Floor</option>
			     			<option value="6" @if (old('floor') == 6) selected @endif >6th Floor</option>
			     			<option value="7" @if (old('floor') == 7) selected @endif >7th Floor</option>
			     			<option value="8" @if (old('floor') == 8) selected @endif >8th Floor</option>
			     			<option value="9" @if (old('floor') == 9) selected @endif >9th Floor</option>
				     	</select>

	          	@error('floor')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-md-3 col-form-label" for="roomno">Room No (From): <sup class="text-danger">*</sup></label>
            <div class="col-md-4">
              <input type="text" class="form-control bg-white" name="roomno" id="roomno" placeholder="Room No" readonly value="{{ old('roomno') }}">
            </div>
            <label class="col-md-1 col-form-label" for="to">To: <sup class="text-danger">*</sup></label>
            <div class="col-md-3">

            	<div class="input-group">
							  <input type="number" class="form-control" name="to" id="to" value="{{ old('to', 1) }}" min="1" max="10">
                <div class="input-group-append">
                  <span class="input-group-text">Rooms</span>
                </div>
							</div>

							@error('to')
					     	<div class="error-message text-danger pl-1 mt-1">
				     			<small>{{ $message }}</small>
				     		</div>
				     	@enderror

            </div>
            <div class="col-md-1 text-right">
            	<button class="btn btn-outline-primary px-3" type="button" data-toggle="tooltip" title="Add Skip Room No." id="btn-add-skip"><i class="fas fa-plus"></i></button>
            </div>
          </div>

          <div class="form-group row mb-4 div-skip-select" style="display: none;">
            <label class="col-md-3 col-form-label" for="skipno">Skip Room No:</label>
            <div class="col-md-9">

              <select class="form-control nice-select wide" id="skipno" name="skipno" >
			     			<option value="default">None</option>
				     	</select>

            </div>
          </div>

          <div class="form-group row mt-5">
            <div class="col-md-9 ml-auto">
              <button type="submit" class="btn btn-primary">Create</button>
              <button type="reset" class="btn btn-outline-secondary">Reset</button>
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
			$('[data-toggle="tooltip"]').tooltip();
    	$('select').niceSelect();

    	$('#btn-add-skip').click(function() {
    		$('.div-skip-select').show('200');
    	});


    	// generate room no
    	$('#floor').change(function() {
    		if (this.value != 'default') {
	    		let floor = this.value;
	    		let url = '{{ route('rooms.getroomno', ":floor") }}'
	    		url = url.replace(':floor', floor)
	    		// console.log(url)
    			$.ajax({
				    type:'GET',
           	url: url,
           	success:function(data){
           		newroomno = (data.latestroomno) ? (+data.latestroomno + 1) : (floor+'01');
           		$('#roomno').val(newroomno);
           	}
					});
    		}
    	});	// end of generate room no


			// set value for skip room no
			$('#to').on('change keyup', function() {
				if (this.value > 1) {
					let to = this.value;
					let roomno = $('#roomno').val();

					$('.div-skip-select .list').html('');
					$('.div-skip-select .nice-select span').text('None');
					$('.div-skip-select .list').append(`<li data-value="default" class="option focus selected">None</li>`);

					$('#skipno').html('');
					$('#skipno').append('<option value="default">None</option>');
					for (var i = 0; i < to; i++) {
						$('.div-skip-select .list').append(`<li data-value="${roomno}" class="option">${roomno}</li>`);
						$('#skipno').append(`<option value="${roomno}">${roomno}</option>`);
						roomno++;
					}
				}
			});		// end of set value for skip room no


			// restrict 'to' input
			$('#to').keypress(function(e) {
				if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
					return false;
				}
			});

    })	// end of document ready function 
  </script>
@endsection