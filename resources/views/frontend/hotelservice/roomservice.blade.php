@extends('frontendtemplate')

@section('title', 'Hotel Riza - Room Services')

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
            <li><a href="{{ route('hotelservices.index') }}">Hotel Services</a></li>
            <li>Room Services</li>
          </ol>
        </div>

      </div>
    </section>

    <section class="inner-page">
      <div class="container">
        <h5 class="text-theme font-weight-bold mb-4">New Feature Coming Soon</h5>

        <div class="row justify-content-md-center">
          <div class="col-md-7 text-center">
            <img src="{{ asset('frontend/img/coming_soon.png') }}" alt="new feature developing" class="img-fluid w-50 img-notfound">
            <p class="text-secondary mt-4 mb-5 font-italic">We are working hard on the new features which makes you easier to use. <br> Stay turned!</p>

          </div>
        </div>

      </div>
    </section>

  </main><!-- End #main -->

@endsection