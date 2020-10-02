@extends('frontendtemplate')

@section('title', 'Hotel Riza - Room Detail')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/pgwslider/pgwslider.min.css') }}">
	<style type="text/css">
		body {
	    background: #201D18;
		}
		.pgwSlider .ps-current .ps-prev {
			padding: 10px 10px 10px 7px;
		}
		.pgwSlider .ps-prevIcon {
			border-width: 7px 7px 7px 0;
		}
		.pgwSlider .ps-current .ps-next {
			padding: 10px 7px 10px 10px;
		}
		.pgwSlider .ps-nextIcon {
	    border-width: 7px 0 7px 7px;
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
            <li><a href="{{ route('roomtypes.list') }}">Rooms</a></li>
            <li>{{ $roomtype->name }}</li>
          </ol>
        </div>

      </div>
    </section>

    <section class="inner-page">
      <div class="container">
      	
      	<div class="row">
      		<div class="col-xl-8 mb-4">
      			<div class="px-lg-1">
      				
      				<ul class="pgwSlider">
      					<li>
      						<img src="{{ asset($roomtype->image1) }}" data-description="$ {{ number_format($roomtype->pricepernight, 2) }} / night">
      					</li>
      					<li>
      						<img src="{{ asset($roomtype->image2) }}" data-description="$ {{ number_format($roomtype->pricepernight, 2) }} / night">
      					</li>
      					<li>
      						<img src="{{ asset($roomtype->image3) }}" data-description="$ {{ number_format($roomtype->pricepernight, 2) }} / night">
      					</li>
      				</ul>

      			</div>
      		</div>
      		<div class="col-xl-4 mb-4">
      			<div class="side-text">
	      			<h5 class="font-weight-bold">{{ $roomtype->name }}</h5>
      				<div class="float-left text-muted">
      					<small>
      						<i class="icofont-ui-user-group"></i> {{ $roomtype->noofpeople }} {{ $roomtype->noofpeople == 1 ? 'Guest' : 'Guests' }} | 
                  <i class="icofont-bed"></i> {{ $roomtype->noofbed }} {{ $roomtype->noofbed == 1 ? 'Bed' : 'Beds' }}
      					</small>
      				</div>
      				<div class="float-right">
      					<span class="text-price">$ {{ number_format($roomtype->pricepernight, 2) }}</span>
      				</div>
      				<div class="clearfix"></div>

      				<hr>

      				<div class="form-row">
      					<div class="col-6">
      						<label for="startdate"><small>Check in : </small></label>
      						<input type="date" name="startdate" id="startdate" class="form-control">
      					</div>
      					<div class="col-6">
      						<label for="enddate"><small>Check out : </small></label>
      						<input type="date" name="enddate" id="enddate" class="form-control">
      					</div>
      					<div class="col-12">
      						<button type="button" id="btn-check" class="ripple">Check Availability</button>
      					</div>
      				</div>

      				<hr>

      			</div>
      		</div>
      	</div>

      	<div class="row description">
      		<div class="col-12">
      			<h5 class="font-weight-bold text-theme mb-4">Room Details</h5>
      			{!! $roomtype->description !!}
      		</div>
      	</div>

      	<hr>

      	<div class="row description">
      		<div class="col-12 my-4">
      			<h5 class="font-weight-bold text-theme mb-4">Others</h5>
      			<ul>
      				<li>Extra bed is available for $ 10.00 (including VAT and service charge).</li>
	      			<li>All rates are subject to a 5% tax.</li>
      			</ul>
      		</div>
      	</div>

      	<div class="text-center my-4">
          <a href="{{ route('roomtypes.list') }}" class="btn-view">View Other Rooms</a>
        </div>

      </div>
    </section>

  </main><!-- End #main -->

@endsection

@section('script')
	<script src="{{ asset('frontend/vendor/pgwslider/pgwslider.min.js') }}"></script>

	<script type="text/javascript">
		 	
		 $(function () {
		 	 
		 	$('.pgwSlider').pgwSlider({
		 		displayControls: true,
		 		intervalDuration : 6000
		 	});

		 })

	</script>
@endsection