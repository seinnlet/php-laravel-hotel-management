@extends('frontendtemplate')

@section('title', 'Hotel Riza - My Bookings')

@section('css')
  <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@600&display=swap" rel="stylesheet">
	<style type="text/css">
		body {
	    background: #201D18;
		}
    .img-notfound {
      opacity: 0.6;
    }
    .inner-page .booking-card .booking-card-top h6 {
      font-family: 'Sansita Swashed', cursive;
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
            <li>My Bookings</li>
          </ol>
        </div>

      </div>
    </section>

    <section class="inner-page">
      <div class="container">

        @if (!(count($recentbookings) + count($pastbookings)))
          <h5 class="text-theme font-weight-bold mb-4">Recent Bookings</h5>

          <div class="row justify-content-md-center" style="display: none;">
            <div class="col-md-6 text-center">
              <img src="{{ asset('frontend/img/no_booking_found.png') }}" alt="no booking found" class="img-fluid w-25 img-notfound">
              <p class="text-secondary mt-4 mb-5">Oops, there is no booking yet.</p>

              <a href="" class="btn-view">Book A Stay</a>
            </div>
          </div>

        @else
          
          @if (count($recentbookings))
            <h5 class="text-theme font-weight-bold mb-4">Recent Bookings</h5>
            <div class="row">

              @foreach ($recentbookings as $recentbooking)
                @php 
                  $virslug = strtolower($recentbooking->bookingid); 
                @endphp
                <div class="col-md-6 col-xl-4 mb-5">
                  <div class="booking-card">
                    <div class="booking-card-top">
                      <p>{{ $recentbooking->checkindatetime ? date('d M', strtotime($recentbooking->checkindatetime)) : date('d M', strtotime($recentbooking->bookstartdate)) }} - {{ $recentbooking->checkoutdatetime ? date('d M, Y', strtotime($recentbooking->checkoutdatetime)) : date('d M, Y', strtotime($recentbooking->bookenddate)) }}</p>
                      <h6 {{ $recentbooking->status != 'check out' ? 'class=text-theme' : '' }}>{{ $recentbooking->bookingid }}</h6>
                    </div>
                    <div class="booking-card-bottom">
                      @if ($recentbooking->status == 'check out')
                        <a href="{{ asset('backend/pdf/'.$recentbooking->bookingid.'.pdf') }}" class="btn-receipt" target="_blank"><i class="icofont-paper"></i> Receipt</a>
                        <a href="{{ route('mybookingdetail', $virslug) }}" class="btn-detail"><i class="icofont-clip"></i> Detail</a>
                      @else
                        <a href="{{ route('mybookingdetail', $virslug) }}" class="recent-detail">View Detail</a>
                      @endif
                    </div>
                  </div>
                </div>
              @endforeach

            </div>
          @endif

          @if (count($pastbookings))
            @if (count($recentbookings))
              <hr>
            @endif
            <h5 class="text-secondary font-weight-bold {{ count($recentbookings) ? 'mt-5' : '' }} mb-4">Past Bookings</h5>
            <div class="row">

              @foreach ($pastbookings as $pastbooking)
                @php 
                  $virslug = strtolower($pastbooking->bookingid); 
                @endphp
                <div class="col-md-6 col-xl-4 mb-5">
                  <div class="booking-card">
                    <div class="booking-card-top">
                      <p>{{ date('d M', strtotime($pastbooking->checkindatetime)) }} - {{ date('d M Y', strtotime($pastbooking->checkoutdatetime)) }}</p>
                      <h6>{{ $pastbooking->bookingid }}</h6>
                    </div>
                    <div class="booking-card-bottom">
                      @if ($pastbooking->status == 'check out')
                        <a href="{{ asset('backend/pdf/'.$pastbooking->bookingid.'.pdf') }}" class="btn-receipt" target="_blank"><i class="icofont-paper"></i> Receipt</a>
                        <a href="{{ route('mybookingdetail', $virslug) }}" class="btn-detail"><i class="icofont-clip"></i> Detail</a>
                      @else
                        <a href="{{ route('mybookingdetail', $virslug) }}" class="recent-detail">View Detail</a>
                      @endif
                    </div>
                  </div>
                </div>
              @endforeach

            </div>
          @endif

          <div class="row">
            <div class="col-12 text-center my-5">
              <a href="" class="btn-view">Book A New Stay</a>
            </div>
          </div>

        @endif
          
      </div>
    </section>

  </main><!-- End #main -->

@endsection