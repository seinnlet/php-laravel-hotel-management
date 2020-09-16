@extends('backendtemplate')

@section('title', 'Detail Roomtype')

@section('content')
	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">{{ $roomtype->name }}</h5>
			<a href="{{ route('roomtypes.index') }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Detail Info</h3>
      </div>
      <div class="card-body">

      	<div class="row">
      		<div class="col-md-5">
      			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						  <ol class="carousel-indicators">
						    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						    @if ($roomtype->image2)
						    	<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
						    @endif
						    @if ($roomtype->image3)
							    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
							  @endif
						  </ol>
						  <div class="carousel-inner shadow">
					  		<div class="carousel-item active">
						      <img src="{{ asset($roomtype->image1) }}" class="d-block w-100 rounded" alt="Room Image">
						    </div>
							  @if ($roomtype->image2)
						  		<div class="carousel-item">
							      <img src="{{ asset($roomtype->image2) }}" class="d-block w-100 rounded" alt="Room Image">
							    </div>
						  	@endif
						  	@if ($roomtype->image3)
						  		<div class="carousel-item">
							      <img src="{{ asset($roomtype->image3) }}" class="d-block w-100 rounded" alt="Room Image">
							    </div>
						  	@endif
						  </div>
						  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
						    <span class="sr-only">Previous</span>
						  </a>
						  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						    <span class="carousel-control-next-icon" aria-hidden="true"></span>
						    <span class="sr-only">Next</span>
						  </a>
						</div>
      		</div>
      		<div class="col-md-7 p-4">
      			<h5 class="mb-4 text-primary">Room Type - {{ $roomtype->name }}</h5>
      			<p>Price per Night : {{ $roomtype->pricepernight }}</p>
      			<p>No of People : {{ $roomtype->noofpeople }} (Max)</p>
      			<p>No of Bed : {{ $roomtype->noofbed }} </p>
      		</div>
      	</div>

      	<h3 class="h6 mt-2 mt-md-5 mb-3">About {{ $roomtype->name }} Room Type</h3>
      	{!! $roomtype->description !!}
      </div>
    </div>

  </section>

@endsection