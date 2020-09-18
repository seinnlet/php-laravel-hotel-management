@extends('backendtemplate')

@section('title', 'New Booking')

@section('css')
  <style type="text/css">
    form, .form-control, select {
      font-size: .85rem;
    }
    #booking-info label, #guest-info label, #room-info label, #addition-info .col-form-label, #payment-info .col-form-label {
      color: #6c757d;
    }
    hr {
      margin: 1.2rem auto;
      background-color: #fff;
      border-top: 1px dashed #ccc !important;
    }
  </style>
@endsection

@section('content')
	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">New Booking</h5>
			<a href="{{ route('bookings.index') }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Create New Booking</h3>
      </div>
      <div class="card-body">

      	<form class="form-horizontal" method="post" action="{{ route('bookings.store') }}">
      		@csrf

      		<section id="booking-info">
      			<h6 class="font-weight-medium text-primary mb-4">- Booking Info -</h6>

      			<div class="row">
              <div class="form-group col-md-4 mb-4">
                <label for="bookingid">Booking ID:</label>
                <input type="text" class="form-control" id="bookingid" name="bookingid">
              </div>

              <div class="form-group col-6 col-md-3 mb-4">
                <label for="bookdate">From:</label>
                <input type="date" class="form-control" id="bookdate" name="bookdate">
              </div>

              <div class="form-group col-6 col-md-3 mb-4">
                <label for="todate">To:</label>
                <input type="date" class="form-control" id="todate" name="todate">
              </div>

              <div class="form-group col-md-2 mb-4">
                <label for="duration">Duration:</label>
                <input type="number" class="form-control" id="duration" name="duration">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-4 mb-4">
                <label for="guestname">Booked By (Guest):</label>
                <input type="text" class="form-control" id="guestname" name="guestname">
              </div>

              <div class="form-group col-md-4 mb-4">
                <label for="bookingtype">Booking Type:</label>
                <select class="form-control" id="bookingtype" name="bookingtype">
                  <option value="1">Select Booking Type</option>
                  <option value="By Phone" @if (old('bookingtype') == 'By Phone') selected @endif >By Phone</option>
                  <option value="By Email" @if (old('bookingtype') == 'By Email') selected @endif >By Email</option>
                  <option value="Hotel Front Desk" @if (old('bookingtype') == 'Hotel Front Desk') selected @endif >Hotel Front Desk</option>
                </select>
              </div>

              <div class="form-group col-md-4 mb-4">
                <label for="staffname">Recorded By (Staff):</label>
                <input type="text" class="form-control bg-white" name="staffname" id="staffname" readonly value="{{ Auth::user()->name }}">
              </div>
            </div>

            <hr>
      		</section>  {{-- end of section booking-info --}}

          <div class="row">
            <div class="col-md-6 mt-3">
              
              <section id="guest-info">

                <h6 class="font-weight-medium text-primary mb-4">- Guest Info -</h6>
                
                <div id="new-guest">
                  <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email">
                  </div>
                  <div class="form-group">
                    <label for="phone1">Phone 1:</label>
                    <input type="text" class="form-control" id="phone1" name="phone1">
                  </div>
                  <div class="form-group">
                    <label for="phone2">Phone 2:</label>
                    <input type="text" class="form-control" id="phone2" name="phone2">
                  </div>
                  <div class="form-row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" name="city" id="city">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="country">Country:</label>
                        <select class="form-control" name="country" id="country">
                          @foreach ($countries as $country)
                            <option value="{{ $country->name }}" @if(old('country') == $country->id) selected @endif >{{ $country->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      
                    </div>
                  </div>
                </div>  {{-- end of div new-guest --}}
                  
              </section>  {{-- end of section guest-info --}}

            </div>
            <div class="col-md-6 mt-3">
              
              <section id="room-info">

                <h6 class="font-weight-medium text-primary mb-4">- Room Info -</h6>

                <div class="form-row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="roomtype">Room Type:</label>
                      <select class="form-control" name="roomtype" id="roomtype">
                        @foreach ($roomtypes as $roomtype)
                          <option value="{{ $roomtype->id }}" @if(old('roomtype_id') == $roomtype->id) selected @endif >{{ $roomtype->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="noofroom">No of Rooms:</label>
                      <input type="number" class="form-control" id="noofroom" name="noofroom">
                    </div>
                  </div>
                  <div class="col-2 text-right">
                    <div class="form-group">
                      <label>Add</label>
                      <button class="btn btn-outline-secondary px-3 btn-block"><i class="fas fa-plus"></i></button>
                    </div>
                  </div>
                </div>
                    
                {{-- availabiliy table not finish --}}

              </section>  {{-- end of section room-info --}}

            </div>
          </div>    {{-- end of row - includes guest & room info --}}
          <hr>

          <section id="addition-info">
            
            <h6 class="font-weight-medium text-primary my-4">- Additonal Info -</h6>

            <div class="row">
              <label class="col-form-label col-5 col-md-3" for="estimatedarrivaltime">Estimated Arrival Time:</label>
              <div class="col-7 col-md-3 mb-4">
                <input type="time" name="estimatedarrivaltime" id="estimatedarrivaltime" class="form-control">
              </div>
              <div class="col-6 col-md-3 mb-4">
                <div class="custom-control custom-checkbox col-form-label">
                  <input id="earlycheckin" name="earlycheckin" type="checkbox" class="custom-control-input">
                  <label for="earlycheckin" class="custom-control-label">Early Check In</label>
                </div>
              </div>
              <div class="col-6 col-md-3 mb-4">
                <div class="custom-control custom-checkbox col-form-label">
                  <input id="latecheckout" name="latecheckout" type="checkbox" class="custom-control-input">
                  <label for="latecheckout" class="custom-control-label">Late Check Out</label>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-form-label col-md-3" for="note">Notes:</label>
              <div class="col-md-9 mb-4">
                <textarea class="form-control" rows="3" name="note" id="note"></textarea>
              </div>
            </div>
            <hr>
          </section>  {{-- end of section addtional info --}}

          <section id="payment-info">
            
            <h6 class="font-weight-medium text-primary my-4">- Payment Info -</h6>

            <div class="row mb-4">
              <label class="col-form-label col-md-3 font-weight-bold" for="totalcost">Total:</label>
              <div class="col-md-9">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input type="number" class="form-control bg-white" name="totalcost" id="totalcost"  value="{{ old('totalcost') }}" readonly>
                  <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mb-4">
              <label class="col-form-label col-md-3" for="paymenttype">Payment Method:</label>
              <div class="col-md-9">
                <select class="form-control" id="paymenttype" name="paymenttype">
                  <option value="1">Select Payment Type</option>
                  <option value="Cash" @if (old('paymenttype') == 'Cash') selected @endif >Cash</option>
                  <option value="Credit Card" @if (old('paymenttype') == 'Credit Card') selected @endif >Credit Card</option>
                </select>
              </div>
            </div>

            <div class="row mb-4">
              <label class="col-form-label col-md-3">Advance Payment (%):</label>
              <div class="col-form-label col-md-9">
                <div class="custom-control custom-radio custom-control-inline">
                  <input id="half" value="50" type="radio" name="advancepaymentpercentage" class="custom-control-input" checked>
                  <label for="half" class="custom-control-label">50%</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input id="full" value="100" type="radio" name="advancepaymentpercentage" class="custom-control-input">
                  <label for="full" class="custom-control-label">100%</label>
                </div>
              </div>
            </div>

            <div class="row mb-4">
              <label class="col-form-label col-md-3" for="advancepayment">Advance Payment:</label>
              <div class="col-md-9">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input type="number" class="form-control bg-white" name="advancepayment" id="advancepayment" value="{{ old('advancepayment') }}" readonly>
                  <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                  </div>
                </div>
              </div>
            </div>

          </section>  {{-- end of section payment info --}}

          <div class="form-group row mt-5">
            <div class="col-md-9 ml-auto">
              <button type="submit" class="btn btn-primary px-5">Save</button>
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

	<script type="text/javascript">
    
    $(function () {
      

    })	// end of document ready function 
  </script>
@endsection