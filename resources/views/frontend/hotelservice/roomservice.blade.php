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

      </div>
    </section>

  </main><!-- End #main -->

@endsection