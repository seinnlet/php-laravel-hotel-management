@extends('frontendtemplate')

@section('title', 'Hotel Riza - Menu')

@section('css')
	<style type="text/css">
		body {
	    background: #201D18;
		}
    @media screen and (max-width: 768px) {
      .back-to-top {
        display: none !important;
      }
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
            <li>Menu</li>
          </ol>
        </div>

      </div>
    </section>

    <section class="inner-page">

        <!-- ======= Menu Section ======= -->
      <section id="menu" class="menu">
        <div class="container" data-aos="fade-up">

          <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-12 d-flex justify-content-center">
              <ul id="menu-flters">
                <li data-filter="*" class="filter-active">All Categories</li>
                @foreach ($foodcategories as $foodcategory)
                  @php $filtername = strtolower(preg_replace('/\s*/', '', $foodcategory->name)); @endphp
                   <li data-filter=".filter-{{ $filtername }}">{{ $foodcategory->name }}</li>
                @endforeach
              </ul>
            </div>
          </div>

          <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">

            @foreach ($food as $menu)
              
              @php $filtername = strtolower(preg_replace('/\s*/', '', $menu->foodcategory->name)); @endphp

              <div class="col-lg-6 menu-item filter-{{ $filtername }}">
                <a href="{{ asset($menu->image) }}" class="venobox" data-gall="menuimg-item" data-title="{{ $menu->name }}: $ {{ $menu->unitprice }}">
                  <img src="{{ asset($menu->image) }}" class="menu-img" alt="">
                </a>
                <div class="menu-content">
                  <a href="{{ asset($menu->image) }}" class="venobox" data-gall="menu-item" data-title="{{ $menu->name }}: $ {{ $menu->unitprice }}">{{ $menu->name }}</a><span>$ {{ $menu->unitprice }}</span>
                </div>

                <div class="menu-ingredients">
                  {{ $menu->foodcategory->name }}
                </div>

                <div class="text-right">
                  <button class="btn btn-sm btn-outline-secondary btn-add"
                      data-id="{{ $menu->id }}" 
                      data-price="{{ $menu->unitprice }}" 
                      data-name="{{ $menu->name }}"
                  ><small><i class="icofont-plus"></i></small> Order</button>
                </div>
              </div>

            @endforeach

          </div>

        </div>
      </section><!-- End Menu Section -->

    </section>

  </main><!-- End #main -->

  <a id="cart-amount" href="{{ route('hotelservices.orderfood') }}">
    <span class="cart">
      <i class="icofont-shopping-cart"></i>
      <span class="custom-badge totalqty">0</span>
    </span>
    <span class="view-text">View My Order</span>
    <span class="amount d-md-none">$ 0.00</span>
  </a>

@endsection
@section('script')
  <script src="{{ asset('frontend/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('frontend/js/localstorage.js') }}"></script>

  <script type="text/javascript">
    
    $(function () {
      $('.venobox').venobox({
        titleattr: 'data-title',
        numeratio  : true, 
      }); 

      // Menu list isotope and filter
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
    })

  </script>
@endsection