@extends('frontendtemplate')

@section('title', 'Hotel Riza - Menu')

@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/jquery-nice-select/nice-select.css') }}">
	<style type="text/css">
		body {
	    background: #201D18;
		}
    hr {
      margin: .5rem auto 2rem !important;
    }
    .nice-select .list, .nice-select {
      border-radius: 0 !important;
    }
    .nice-select .list {
      box-shadow: 0 0 0 1px rgba(68, 68, 68, 0.1);
    }
    .nice-select:active, .nice-select.open, .nice-select:focus {
      border-color: #cda45e !important;
    }
	</style>
@endsection

@section('content')

	<main id="main">
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
        	<h2></h2>
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('hotelservices.index') }}">Hotel Services</a></li>
            <li><a href="{{ route('hotelservices.menu') }}">Menu</a></li>
            <li>Order</li>
          </ol>
        </div>

      </div>
    </section>

    <section class="inner-page">
      <div class="container">

        <h5 class="text-theme font-weight-bold mb-4">Order List</h5>

        <form>
        
          <div class="row" id="table-order">
            <div class="col-lg-8">
              
              <div class="table-responsive mb-4">
                <table class="table" width="100%">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Menu</th>
                      <th>Qty</th>
                      <th>Sub-Total</th>
                    </tr>
                  </thead>
                  <tbody id="tbody-cart">

                  </tbody>
                </table>
              </div>

              <div class="form-group mb-5">
                <textarea placeholder="Add Notes..." id="note" name="note" rows="4"></textarea>
              </div>

            </div>
            <div class="col-lg-4">
              
              <div class="p-4 receipt">
                <span class="receipt-left">Total Qty: </span>
                <span class="receipt-right totalqty">1</span>
                <div class="clearfix"></div>

                <span class="receipt-left">Total Amount: </span>
                <span class="receipt-right" id="totalamount">$ 0.00</span>
                <input type="hidden" id="totalprice">
                <div class="clearfix"></div>

                <hr>

                <select id="room_id" class="nice-select wide">
                  <option value="default">Select Room No.</option>
                  @foreach ($bookings as $booking)
                    @foreach ($booking->rooms as $room)
                      <option value="{{$room->id}}">R - {{ $room->roomno }}</option>
                    @endforeach
                  @endforeach
                </select>
                <div class="clearfix"></div>
                <div class="roomid-error-message text-danger pl-1 mt-1" style="display: none;">
                  <small>* Please Select Room No.</small>
                </div>

                <button type="button" class="ripple" id="btn-order">Order Now</button>

                <div class="text-center mt-4 mb-3">
                  <a href="{{ route('hotelservices.menu') }}">Return to Menu</a>
                </div>
              </div>

            </div>
          </div>
        </form>

      </div>
    </section>

  </main><!-- End #main -->
@endsection

@section('script')
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript" src="{{ asset('backend/vendor/jquery-nice-select/jquery.nice-select.min.js') }}"></script>
  <script src="{{ asset('frontend/js/localstorage.js') }}"></script>

  <script type="text/javascript">
    
    $(function () {
      $('select').niceSelect();

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#btn-order').click(function() {
        
        let room_id = $('#room_id').val();

        if (room_id == "default") {

          $('.roomid-error-message').show();
  
        } else {
          let cart = localStorage.getItem('cart');
          let cartobj = JSON.parse(cart);

          let note = $('#note').val();
          let totalprice = $('#totalprice').val();
          
          $.post("{{route('orders.store')}}" ,{cartobj: cart, room_id:room_id, totalprice:totalprice, note:note}, function(response){
            // console.log(response);

            if (response) {
              localStorage.removeItem('cart');
              // need to change
              swal("Order Success!", "We will deliver to you in few minutes.", "success");
            }
          }).fail(function(response) {
              alert('Error: ' + response.responseText);
          });

        }
          
      });

      $('#room_id').change(function() {
        if ($('#room_id').val() != "default") $('.roomid-error-message').hide();
      });


    })  // end of document ready function 
  </script>
@endsection