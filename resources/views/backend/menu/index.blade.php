@extends('backendtemplate')

@section('title', 'Menu')

@section('css')
  <link href="{{ asset('frontend/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/venobox/venobox.css') }}" rel="stylesheet">
@endsection

@section('content')

	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Menu</h5>
			<a href="{{ route('menus.create') }}" class="btn btn-primary float-right rounded"><i class="fas fa-plus fa-sm mr-2 text-gray-100"></i> Add New</a>
			<div class="clearfix"></div>
		</div>

		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0 d-inline-block float-left">Menu List</h3>
      	<a href="{{ route('orders.create') }}"><span class="text-primary font-weight-normal pl-3 d-inline-block float-right" id="order-count"></span></a>
      	<div class="clearfix"></div>
      </div>
      <div class="card-body">

      	<section id="menu" class="menu">
      		<div class="row" data-aos="fade-up">
	          <div class="col-lg-12 d-flex justify-content-center">
	            <ul id="menu-flters">
	              <li data-filter="*" class="filter-active">All</li>
	              @foreach ($foodcategories as $foodcategory)
	              	@php $filtername = strtolower(preg_replace('/\s*/', '', $foodcategory->name)); @endphp
	              	 <li data-filter=".filter-{{ $filtername }}">{{ $foodcategory->name }}</li>
	              @endforeach
	            </ul>
	          </div>
	        </div>

	        <div class="row menu-container" data-aos="fade-up">

	        	@foreach ($food as $menu)
	        		
	        		@php $filtername = strtolower(preg_replace('/\s*/', '', $menu->foodcategory->name)); @endphp

	        		<div class="col-lg-6 menu-item filter-{{ $filtername }}">
		            <img src="{{ asset($menu->image) }}" class="menu-img" alt="">
		            <div class="menu-content">
		              <a href="{{ asset($menu->image) }}" class="venobox" data-gall="menu-item" data-title="{{ $menu->name }}">{{ $menu->name }}</a><span>$ {{ $menu->unitprice }}</span>
		            </div>
		            <div class="menu-ingredients">
		              {{ $menu->foodcategory->name }}
		            </div>
		            <div class="text-right pr-2">
		            	<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
									  <button type="button" class="btn btn-outline-secondary btn-sm px-3 btn-add" data-id="{{ $menu->id }}" data-price="{{ $menu->unitprice }}" data-name="{{ $menu->name }}"><i class="fas fa-plus mr-2 fa-sm"></i> Order</button>

									  <div class="btn-group" role="group">
									    <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle px-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
									    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
									      <a class="dropdown-item py-2" href="{{ route('menus.edit', $menu->id) }}">Edit</a>
									      <form method="post" action="{{ route('menus.destroy', $menu->id) }}" class="d-inline" id="delete-menu{{ $menu->id }}" >
												@csrf
			          				@method('DELETE')
									     	 <button type="button" class="dropdown-item py-2" onclick="confirmDelete('delete-menu{{ $menu->id }}')">Delete</button>
									     	</form>
									    </div>
									  </div>
									</div>
		            </div>
		          </div>

	        	@endforeach
		          
	        
	        </div>
      	</section>
      	

      </div>
    </div>

	</section>
@endsection

@section('script')

  <script src="{{ asset('backend/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/venobox/venobox.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/aos/aos.js') }}"></script>
	<script src="{{ asset('backend/js/localstorage.js') }}"></script>

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script type="text/javascript">
  	AOS.init();
  	$(document).ready(function(){
	    $('.venobox').venobox({
		    titleattr: 'data-title',
		    numeratio  : true, 
			}); 
		});
  	$(window).on('load', function() {
	    var menuIsotope = $('.menu-container').isotope({
	      itemSelector: '.menu-item',
	      layoutMode: 'fitRows'
	    });

	    $('#menu-flters li').on('click', function() {
	      $("#menu-flters li").removeClass('filter-active');
	      $(this).addClass('filter-active');

	      menuIsotope.isotope({
	        filter: $(this).data('filter')
	      });
	    });
	  });

	  // delete sweet alert
		function confirmDelete(menu_id) {
  		swal({
  			title: "Are you sure to Delete?",
  			text: "The data will be permanently deleted.",
  			icon: "warning",
  			buttons: true,
  			dangerMode: true,
  		})
  		.then((willDelete) => {
  			if (willDelete) {
  				$('#'+menu_id).submit();
  			}
  		});
  	}
  </script>
@endsection