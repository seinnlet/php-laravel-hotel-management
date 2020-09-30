@extends('backendtemplate')

@section('title', 'New Booking')

@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/jquery-flexdatalist/jquery.flexdatalist.min.css') }}">
  <style type="text/css">
    form, .form-control, select {
      font-size: .85rem;
    }
    #booking-info label, #guest-info label, #room-info label, #addition-info .col-form-label, #payment-info .col-form-label, table tr td, .table-striped th {
      color: #6c757d;
    }
    .table-striped th {
      font-weight: 600;
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
              <div class="form-group col-md-3 mb-4">
                @php $bookingid = 'B-'.date('ymd-His') @endphp
                <label for="bookingid">Booking ID: <sup class="text-danger">*</sup></label>
                <input type="text" class="form-control bg-white" id="bookingid" name="bookingid"  readonly value="{{ old('bookingid', $bookingid) }}">
              </div>

              <div class="form-group col-6 col-md-3 mb-4">
                @php $today = date('Y-m-d') @endphp
                <label for="bookdate">From: <sup class="text-danger">*</sup></label>
                <input type="date" class="form-control" id="bookdate" name="bookdate" min="{{ $today }}" value="{{ old('bookdate') }}">
                @error('bookdate')
                  <div class="error-message text-danger pl-1 mt-1">
                    <small>{{ $message }}</small>
                  </div>
                @enderror
              </div>

              <div class="form-group col-6 col-md-3 mb-4">
                @php 
                  $nextday = date('Y-m-d', strtotime($today))." +1 day";
                  $nextday = date('Y-m-d', strtotime($nextday));
                @endphp
                <label for="todate">To: <sup class="text-danger">*</sup></label>
                <input type="date" class="form-control" id="todate" name="todate" min="{{ $nextday }}" value="{{ old('todate') }}">
                @error('todate')
                  <div class="error-message text-danger pl-1 mt-1">
                    <small>{{ $message }}</small>
                  </div>
                @enderror
              </div>

              <div class="form-group col-md-3 mb-4">
                <label for="duration">Duration: <sup class="text-danger">*</sup></label>
                <div class="input-group">
                  <input type="number" class="form-control bg-white" id="duration" name="duration" readonly placeholder="0" value="{{ old('duration') }}">
                  <div class="input-group-append">
                    <span class="input-group-text">Nights</span>
                  </div>
                </div>
                
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-3 mb-4">
                <label for="guesttype">Guest: <sup class="text-danger">*</sup></label>
                <div class="col-form-label">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input id="new" value="new" type="radio" name="guesttype" class="custom-control-input" {{ (old('guesttype') == 'new' ) ? 'checked' : '' }} @if (!old('gender')) checked @endif>
                    <label for="new" class="custom-control-label">New</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input id="returning" value="returning" type="radio" name="guesttype" class="custom-control-input" {{ (old('guesttype') == 'returning' ) ? 'checked' : '' }}>
                    <label for="returning" class="custom-control-label">Returning</label>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-6 mb-4">
                <label for="bookingtype">Booking Type: <sup class="text-danger">*</sup></label>
                <div class="col-form-label">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input id="byphone" value="By Phone" type="radio" name="bookingtype" class="custom-control-input" {{ (old('bookingtype') == 'By Phone' ) ? 'checked' : '' }} @if (!old('bookingtype')) checked @endif>
                    <label for="byphone" class="custom-control-label">By Phone</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input id="byemail" value="By Email" type="radio" name="bookingtype" class="custom-control-input" {{ (old('bookingtype') == 'By Email' ) ? 'checked' : '' }}>
                    <label for="byemail" class="custom-control-label">By Email</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input id="hotelfrontdesk" value="Hotel Front Desk" type="radio" name="bookingtype" class="custom-control-input" {{ (old('bookingtype') == 'Hotel Front Desk' ) ? 'checked' : '' }}>
                    <label for="hotelfrontdesk" class="custom-control-label">Hotel Front Desk</label>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-3 mb-4">
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
                
                <div id="div-new-guest">
                  <div class="form-group">
                    <label for="name">Guest Name: <sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                      <div class="error-message text-danger pl-1 mt-1">
                        <small>{{ $message }}</small>
                      </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="email">Email Address: <sup class="text-danger">*</sup></label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                      <div class="error-message text-danger pl-1 mt-1">
                        <small>{{ $message }}</small>
                      </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="phone1">Phone 1: <sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" id="phone1" name="phone1" value="{{ old('phone1') }}">
                    @error('phone1')
                      <div class="error-message text-danger pl-1 mt-1">
                        <small>{{ $message }}</small>
                      </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="phone2">Phone 2: (Optional)</label>
                    <input type="text" class="form-control" id="phone2" name="phone2" value="{{ old('phone2') }}">
                  </div>
                  <div class="form-row mb-3">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="city">City: <sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" name="city" id="city" value="{{ old('city') }}">
                        @error('city')
                          <div class="error-message text-danger pl-1 mt-1">
                            <small>{{ $message }}</small>
                          </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="country">Country: <sup class="text-danger">*</sup></label>
                        <select class="form-control" name="country" id="country">
                          @foreach ($countries as $country)
                            <option value="{{ $country->name }}" @if(old('country') == $country->name) selected @endif >{{ $country->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      
                    </div>
                  </div>
                </div>  {{-- end of div new-guest --}}

                <div id="div-returning-guest" style="display: none;">
                  <div class="form-group">
                    <label for="returningguestname">Guest Name: <sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control flexdatalist" data-min-length='1' list='guests' id="returningguestname" name="returningguestname">
                    <datalist id="guests">
                      @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if(old('returningguestname') == $user->id) selected @endif >{{ $user->name }}</option>
                      @endforeach
                    </datalist>
                    <input type="hidden" name="guest_id" id="guest_id">
                  </div>

                  <table class="table table-borderless table-guest-info" style="width: 100%; display: none;">
                    <tr>
                      <td>Email :</td>
                      <td><span id="g-email"></span></td>
                    </tr>
                    <tr>
                      <td>Phone :</td>
                      <td><span id="g-phone"></span></td>
                    </tr>
                    <tr>
                      <td>From :</td>
                      <td><span id="g-from"></span></td>
                    </tr>
                    <tr>
                      <td>Member Type :</td>
                      <td><span id="g-membertype" class="text-primary font-weight-medium"></span></td>
                    </tr>
                    <tr>
                      <td>Points :</td>
                      <td><span id="g-points"></span></td>
                    </tr>
                  </table>
                </div>
                  
              </section>  {{-- end of section guest-info --}}

            </div>
            <div class="col-md-6 mt-3">
              
              <section id="room-info">

                <h6 class="font-weight-medium text-primary mb-4">- Room Info -</h6>

                <div class="form-row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="noofadult">No of Adults: <sup class="text-danger">*</sup></label>
                      <input type="number" name="noofadult" id="noofadult" class="form-control" min="1"  value="{{ old('noofadult', 1) }}">
                      @error('noofadult')
                      <div class="error-message text-danger pl-1 mt-1">
                        <small>{{ $message }}</small>
                      </div>
                    @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="noofchildren">No of Children:</label>
                      <input type="number" name="noofchildren" id="noofchildren" class="form-control" min="0"  value="{{ old('noofchildren', 0) }}">
                    </div>
                  </div>
                </div>
                <div id="div-dynamic-input">
                  <div class="form-row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="roomtype">Room Type:</label>
                        <select class="form-control roomtype" name="roomtype[]">
                          @foreach ($roomtypes as $roomtype)
                            <option value="{{ $roomtype->id }}">{{ $roomtype->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label>No of Rooms:</label>
                        <input type="number" class="form-control noofroom" name="noofroom[]" value="1" min="1">
                      </div>
                    </div>
                    <div class="col-2 text-center">
                      <div class="form-group">
                        <label>Add</label>
                        <button type="button" class="btn btn-outline-secondary btn-add btn-sm px-2 d-block mx-auto"><i class="fas fa-plus"></i></button>
                      </div>
                    </div>
                    
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-6 mt-4">
                    <button class="btn btn-sm py-2 btn-outline-primary btn-block btn-check" type="button" data-toggle="tooltip" title="Date haven't been Chosen">Check Availability</button>
                  </div>
                  <div class="col-6 mt-4">
                    <button class="btn btn-sm py-2 btn-primary btn-block btn-confirm" type="button" data-toggle="tooltip" title="Date haven't been Chosen">Confirm Room</button>
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
                <input type="time" name="estimatedarrivaltime" id="estimatedarrivaltime" class="form-control" value="{{ old('estimatedarrivaltime') }}">
              </div>
              <div class="col-6 col-md-3 mb-4">
                <div class="custom-control custom-checkbox col-form-label">
                  <input id="earlycheckin" name="earlycheckin" type="checkbox" class="custom-control-input" @if (old('earlycheckin')) checked @endif>
                  <label for="earlycheckin" class="custom-control-label">Early Check In</label>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-form-label col-md-3" for="note">Notes:</label>
              <div class="col-md-9 mb-4">
                <textarea class="form-control" rows="3" name="note" id="note">{{ old('note') }}</textarea>
              </div>
            </div>
            <hr>
          </section>  {{-- end of section addtional info --}}

          <section id="payment-info">
            
            <h6 class="font-weight-medium text-primary my-4">- Payment Info -</h6>

            <div class="row mb-4">
              <label class="col-form-label col-md-3 font-weight-bold" for="totalcost">Total: <sup class="text-danger">*</sup></label>
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
                @error('totalcost')
                  <div class="error-message text-danger pl-1 mt-1">
                    <small>{{ $message }}</small>
                  </div>
                @enderror
              </div>
            </div>

            <div class="row mb-4">
              <label class="col-form-label col-md-3" for="paymenttype">Payment Method: <sup class="text-danger">*</sup></label>
              <div class="col-md-9">
                <select class="form-control" id="paymenttype" name="paymenttype">
                  <option value="1">Select Payment Type</option>
                  <option value="Cash" @if (old('paymenttype') == 'Cash') selected @endif >Cash</option>
                  <option value="Credit Card" @if (old('paymenttype') == 'Credit Card') selected @endif >Credit Card</option>
                </select>
                @error('paymenttype')
                  <div class="error-message text-danger pl-1 mt-1">
                    <small>{{ $message }}</small>
                  </div>
                @enderror
              </div>
            </div>

            <div class="row mb-4">
              <label class="col-form-label col-md-3" for="depositamount">Deposit Amount: <sup class="text-danger">*</sup></label>
              <div class="col-md-9">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input type="number" class="form-control bg-white" name="depositamount" id="depositamount" value="{{ old('depositamount') }}" readonly>
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


  {{-- Available Room Table --}}
  <div class="modal fade" id="roomModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-secondary font-weight-medium" id="exampleModalLabel">Hotel Riza</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h6 class="font-weight-medium text-primary">- Available Rooms -</h6>
          <div class="table-responsive my-3">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Room Type</th>
                  <th style="text-align: center;">Max People</th>
                  <th style="text-align: center;">No of Available Rooms</th>
                  <th>Room No.</th>
                </tr>
              </thead>
              <tbody id="tbody-room">
                
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  
  <script type="text/javascript" src="{{ asset('backend/vendor/jquery-flexdatalist/jquery.flexdatalist.min.js') }}"></script>
	<script type="text/javascript">
    
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
      $('.btn-check').tooltip('disable')
      $('.btn-confirm').tooltip('disable')
      $('.flexdatalist').flexdatalist({
        minLength: 1,
        noResultsText: 'No Guest Names found for "{keyword}"'
      });


      // ---- date validation ----
      $('#bookdate').on('change', function() {
        startdate = new Date($(this).val());
        startdate.setDate(startdate.getDate() + 1);
        var mindate = startdate.toISOString().substr(0,10);
        $('#todate').attr('min', mindate);
      });
      $('#todate').on('change', function() {
        startdate = new Date($('#bookdate').val());
        todate = new Date($(this).val());
        diff = new Date(todate - startdate);
        days  = diff/1000/60/60/24;
        if (days > 0) {
          $('#duration').val(days);
        }
        $('.btn-check').tooltip('disable')
        $('.btn-confirm').tooltip('disable')
      });
      // ---- end of date validation ----



      // ---- show hide for new guest & returning guest ----
      $('input[type=radio][name=guesttype]').change(function() {
        if (this.value == 'returning') {
          $('#div-new-guest').hide();
          $('#div-returning-guest').show('400');
        } else {
          $('#div-returning-guest').hide();
          $('#div-new-guest').show('400');
        }
      });
      // ---- end of show hide for new guest & returning guest ----



      // ---- add remove input field ----
      let i = 1;
      $('form').on('click', '.btn-add', function() {
        i++;
        let html = ` 
                  <div class="form-row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="roomtype">Room Type:</label>
                        <select class="form-control roomtype" name="roomtype[]">
                          @foreach ($roomtypes as $roomtype)
                            <option value="{{ $roomtype->id }}" @if(old('roomtype_id') == $roomtype->id) selected @endif >{{ $roomtype->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label>No of Rooms:</label>
                        <input type="number" class="form-control noofroom" name="noofroom[]" value="1" min="1">
                      </div>
                    </div>
                    <div class="col-2 text-center">
                      <div class="form-group">
                        <label>Add</label>
                        <button type="button" class="btn btn-outline-secondary btn-add btn-sm px-2 d-block mx-auto"><i class="fas fa-plus"></i></button>
                      </div>
                    </div>
                  </div>
                  `;
        $('#div-dynamic-input').append(html);
        $(this).prev('label').text('Remove');
        $(this).addClass('btn-outline-danger btn-remove').removeClass('btn-outline-secondary btn-add');
        $(this).html(`<i class="fas fa-minus"></i>`);
      });
      $('form').on('click', '.btn-remove', function() {
        $(this).closest('.form-row').remove();
      });
      $('form').on('keypress', '.noofroom', function(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 49 || e.which > 57)) {
          return false;
        }
      });
      // ---- end of add remove input field ----



      // ---- ajax functions ----
        // -- returning guest info
        $('input.flexdatalist').on('select:flexdatalist', function(event, set, options) {
          let userid = set.value;
          let url = '{{ route('bookings.getguestdata', ":userid") }}'
          url = url.replace(':userid', userid)

          $.ajax({
            type:'GET',
            url: url,
            success:function(data){
              $('#g-email').text(data.email)
              phone = data.phone1 + ((data.phone2) ? ', '+data.phone2 : '');
              $('#g-phone').text(phone)
              $('#g-from').text(data.city + ', ' + data.country)
              $('#g-membertype').text(data.membertype)
              $('#g-points').text(data.points)
              $('#guest_id').val(data.guest_id);
            },
            error:function(e) {
              console.log(e)
            }
          });
          $('.table-guest-info').show('500');
        });


        // -- available room info
        $('form').on('click', '.btn-check', function() {
          let startdate = $('#bookdate').val();
          let enddate = $('#todate').val();
          if (startdate && enddate) {

            let url = '{{ route('bookings.getavailablerooms', [":startdate", ":enddate"]) }}'
            url = url.replace(':startdate', startdate)
            url = url.replace(':enddate', enddate)
            // console.log(url)
            $('#tbody-room').html(''); 
            $.ajax({
              type:'GET',
              url: url,
              success:function(data){
                rooms = data.rooms
                roomtypes = data.roomtypes
                let html = "";
                $.each(roomtypes, function(i, v) {

                  let roomnofilter = rooms.filter(function(obj) {
                    return obj.roomtype_id == v.id;
                  });
                  let roomno = [];
                  $.each(roomnofilter, function(i2, v2) {
                    roomno.push(v2.roomno)
                  });
                  let count = roomnofilter.length;
                  let roomnostring = roomno.join(", ");
                  html += ` 
                      <tr>
                        <td>${i+1}.</td>
                        <td>${v.name}</td>
                        <td align='center'>${v.noofpeople}</td>
                        <td align='center'>${count}</td>
                        <td>${roomnostring}</td>
                      </tr>
                  `;
                });
                $('#tbody-room').append(html);
              },
              error:function(e) {
                console.log(e)
              }
            });
            
            $('#roomModal').modal('show')
          } else {
            $('.btn-check').tooltip('enable')
          }
        });


        // -- calculate total cost 
        $('form').on('click', '.btn-confirm', function() {
          let duration = $('#duration').val();
          if (duration) {
            let roomtype = [];
            $("select[name='roomtype[]']  option:selected").each(function() {
              roomtype.push($(this).val());
            });
            let noofroom = $("input[name='noofroom[]']").map(function(){return $(this).val();}).get();
            
            if (roomtype.length && noofroom.length) {

              $.ajax({
                type:'GET',
                url: "{{ route('bookings.gettotalcost') }}",
                data: {roomtype: roomtype, noofroom: noofroom, duration: duration },
                success:function(response){
                  $('#totalcost').val(response.totalcost);
                  $('#depositamount').val(response.depositamount);
                }
              })

            }
          } else {
            $('.btn-confirm').tooltip('enable')
          }
            
        });
      // ---- end of ajax functions ----


    })	// end of document ready function 
  </script>
@endsection
