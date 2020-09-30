@extends('backendtemplate')

@section('title', 'New Order')

@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/jquery-nice-select/nice-select.css') }}">
	<style type="text/css">
		table th {
			color: #6c757d;
			font-weight: 600;
		}
		.btn-remove:hover {
			background-color: #f8f9fa !important;
			color: #dc3545 !important;
		}
		.td-quantity {
      min-width: 120px;
    }
    .btn-plus, .btn-minus {
    	background-color: #f8f9fa !important;
    }
    .btn-plus:hover, .btn-minus:hover {
    	background-color: #6c757d !important;
    }
	</style>
@endsection

@section('content')
	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">New Order</h5>
			<a href="{{ route('menus.index') }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Go to Menu</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Create New Order</h3>
      </div>
      <div class="card-body">
      	{{-- <form class="form-horizontal" method="post" action="{{ route('orders.store') }}">
      		@csrf --}}

      		<div class="table-responsive div-cart">
      			<table class="table table-bordered">
      				<thead>
      					<tr>
      						<th>No.</th>
      						<th>Name</th>
      						<th>Unit_Price</th>
      						<th>Qty</th>
      						<th>Sub_Total</th>
      						<th>Remove</th>
      					</tr>
      				</thead>
      				<tbody id="tbody-cart">
      					
      				</tbody>
      			</table>
      		</div>

      		<div class="form-group row my-4">
            <label class="col-md-3 col-form-label" for="totalprice">Total Price: </label>
            <div class="col-md-9">
            	<div class="input-group">
							  <div class="input-group-prepend">
							    <span class="input-group-text">$</span>
							  </div>
	            	<input type="number" name="totalprice" id="totalprice" class="form-control bg-white" readonly>
	            </div>
            </div>
          </div>

          <div class="form-group row mb-4">
          	<label class="col-md-3 col-form-label" for="room_id">Ordered by (Room no.): </label>
            <div class="col-md-9">
            	
            	<select class="form-control nice-select wide" id="room_id" name="room_id" >
				     		<option value="default">Select Room No.</option>
				     			@foreach ($rooms as $room)
				     				<option value="{{ $room->id }}" @if(old('room_id') == $room->id) selected @endif >R-{{ $room->roomno }}</option>
				     			@endforeach
				     	</select>
				     	{{-- @error('room_id') --}}
				     	<div class="roomid-error-message text-danger pl-1 mt-1" style="display: none;">
			     			<small>* Please select Room Type.</small>
			     		</div>
				     	{{-- @enderror --}}
            </div>
          </div>

          <div class="form-group row mb-4">
          	<label class="col-md-3 col-form-label" for="note">Notes: </label>
            <div class="col-md-9">
            	<textarea placeholder="Add Notes..." name="note" id="note" class="form-control" rows="4">{{ old('note') }}</textarea>
            </div>
          </div>

          <div class="form-group row mt-4">
            <div class="col-md-9 ml-auto">
              <button type="button" class="btn btn-primary btn-save">Save</button>
            </div>
          </div>

      	{{-- </form> --}}
      </div>
    </div>

  </section>

@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('backend/js/localstorage.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/vendor/jquery-nice-select/jquery.nice-select.min.js') }}"></script>

	<script type="text/javascript">
    $(function () {
    	$('select').niceSelect();
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('.btn-save').click(function() {
        let room_id = $('#room_id').val();

        if (room_id == "default") {
          $('.roomid-error-message').show();
        } else {

          let cart = localStorage.getItem('cart');
          let cartobj = JSON.parse(cart);
          
          let totalprice = $('#totalprice').val();
          let note = $('#note').val();

          $.post("{{route('orders.store')}}" ,{cartobj: cart, room_id:room_id, totalprice:totalprice, note:note}, function(response){
            // console.log(response);

            if (response) {
              localStorage.removeItem('cart');
              window.location = "{{route('orders.index')}}";
            }
          }).fail(function(response) {
              alert('Error: ' + response.responseText);
          });

        }
      });

    })	
  </script>
@endsection