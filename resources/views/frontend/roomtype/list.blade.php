@extends('frontendtemplate')

@section('title', 'Hotel Riza - Rooms')

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
            <li>Rooms</li>
          </ol>
        </div>

      </div>
    </section>

    <section class="inner-page">
      <div class="container">

        <div class="row roomtypes">
          
          @foreach ($roomtypes as $roomtype)
            <div class="col-md-6 mb-5">
              <div class="border mb-4">
                <a href="{{ route('roomtypes.detail', $roomtype->id) }}">
                  <div class="img-wrap">
                    <img src="{{ asset($roomtype->image1) }}" class="img-fluid">
                    <span class="img-text"><i class="icofont-label"></i> {{ $roomtype->name }}</span>
                  </div>
                </a>

                <div class="room-text">
                  <a href="{{ route('roomtypes.detail', $roomtype->id) }}" class="room-title">{{ $roomtype->name }}</a>
                  <div class="clearfix"></div>
                  
                  <div class="float-left p-subtitle">
                    <small>
                    <i class="icofont-ui-user-group"></i> {{ $roomtype->noofpeople }} {{ $roomtype->noofpeople == 1 ? 'Guest' : 'Guests' }} | 
                    <i class="icofont-bed"></i> {{ $roomtype->noofbed }} {{ $roomtype->noofbed == 1 ? 'Bed' : 'Beds' }}
                    </small>
                  </div>
                  <div class="float-right text-right">
                    <span class="text-price">$ {{ number_format($roomtype->pricepernight, 2) }} <small>/ NIGHT</small></span>
                  </div>
                  <div class="clearfix"></div>
                </div>

                  
              </div>
            </div>
          @endforeach

        </div>


      </div>
    </section>

  </main><!-- End #main -->

@endsection