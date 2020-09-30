@extends('backendtemplate')

@section('title', 'Guest Detail')

@section('content')
	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Guest Detail</h5>
			<a href="{{ route('guests.index') }}" class="btn btn-primary float-right rounded"><i class="fas fa-angle-left fa-sm mr-2 text-gray-100"></i> Back</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Customer Info</h3>
      </div>
      <div class="card-body">
      	

      </div>
    </div>
  </section>
@endsection