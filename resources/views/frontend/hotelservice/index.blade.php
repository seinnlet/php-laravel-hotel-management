@extends('frontendtemplate')

@section('title', 'Hotel Riza - Hotel Services')

@section('css')
	<style type="text/css">
		body {
	    background: #201D18;
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
            <li>Hotel Services</li>
          </ol>
        </div>

      </div>
    </section>

    <section class="inner-page">
      <div class="container">
        
        <div class="row roomtypes">

          <div class="col-md-6 col-lg-4 mb-5">
            <div class="shadow-sm mb-4">
              <a href="{{ route('hotelservices.menu') }}">
                <div class="img-wrap">
                  <img src="{{ asset('backend/img/hotelservice-1.jpg') }}" class="img-fluid" alt="hotel service img">
                  <span class="img-text"><i class="icofont-juice icofont-2x"></i> Restaurant Menu</span>
                </div>

                <div class="hotelservice-text">
                  <p class="hotelservice-title">Order Food</p>  
                  <div class="clearfix"></div>
                  <p class="text-muted font-italic"><small>Steak, Sushi and more...</small></p>
                </div>

              </a>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-5">
            <div class="shadow-sm mb-4">
              <a href="{{ route('hotelservices.roomservice') }}">
                <div class="img-wrap">
                  <img src="{{ asset('backend/img/hotelservice-2.jpg') }}" class="img-fluid" alt="hotel service img">
                  <span class="img-text"><i class="icofont-bathtub icofont-2x"></i> Room Services</span>
                </div>

                <div class="hotelservice-text">
                  <p class="hotelservice-title">Request Service</p>  
                  <div class="clearfix"></div>
                  <p class="text-muted font-italic"><small>Laundry, dry cleaning and more...</small></p>
                </div>

              </a>
            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

@endsection