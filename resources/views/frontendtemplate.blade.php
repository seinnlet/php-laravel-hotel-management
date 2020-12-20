<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/venobox/venobox.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/aos/aos.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
  @yield('css')
  <!-- =======================================================
  * Template Name: Restaurantly - v1.1.0
  * Template URL: https://bootstrapmade.com/restaurantly-restaurant-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        <i class="icofont-phone"></i> +95 9129 1299 198
        <span class="d-none d-lg-inline-block ml-4"><i class="icofont-location-pin"></i> Pyay Road, Yangon, Myanmar</span>
      </div>
      <div class="languages">
        <ul>
          <li class="active"><a href="#">EN</a></li>
          <li><a href="#">JP</a></li>
        </ul>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="{{ route('home') }}">{{ __('lang.title') }}</a></h1>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li {{ request()->routeIs('home') ? 'class=active' : '' }}>
            <a href="{{ route('home') }}">Home</a>
          </li>
          <li>
            <a href="{{ request()->is('/') ? '#about' : route('home').'#about' }}">About</a>
          </li>
          <li {{ request()->routeIs('roomtypes.list') ? 'class=active' : '' }}>
            <a href="{{ request()->is('/') ? '#roomtypes' : route('roomtypes.list') }}">Rooms</a>
          </li>
          <li>
            <a href="{{ request()->is('/') ? '#testimonials' : route('home').'#testimonials' }}">Reviews</a>
          </li>
          <li>
            <a href="{{ request()->is('/') ? '#contact' : route('home').'#contact' }}">Contact</a>
          </li>
          @guest
            <li class="book-a-table text-center">
                <a href="{{ route('login') }}">Log in</a>
            </li>
          @else
            @role('Guest')
              <li {{ request()->routeIs('hotelservices*') ? 'class=active' : '' }}>
                <a href="{{ route('hotelservices.index') }}">Hotel Services</a>
              </li>
            @endrole
            <li class="drop-down"><a href="" onclick="return false;">{{ Auth::user()->name }}</a>
              <ul>
                @hasanyrole('Admin|Reservation Staff|Service Staff|Kitchen Staff')
                  <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                @endhasanyrole
                @role('Guest')
                  <li><a href="{{ route('profile') }}">My Profile</a></li>
                  <li><a href="{{ route('mybookings') }}">My Bookings</a></li>
                @endrole
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementsByName('logout-form')[0].submit();">Log out</a></li>
              </ul>

              <form name="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>

            </li>
          @endguest
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  @yield('content')

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>Hotel Riza</h3>
              <p>
                Pyay Road, <br>
                Yangon, Myanmar<br><br>
                <strong>Phone:</strong> +95 9129 1299 198<br>
                <strong>Email:</strong> hotelriza.info@gmail.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="https://twitter.com" target="_blank" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="https://facebook.com" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="https://instagram.com" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="https://web.skype.com" target="_blank" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="https://linkedin.com" target="_blank" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li>
                <i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}">Home</a>
              </li>
              <li>
                <i class="bx bx-chevron-right"></i> <a href="{{ request()->is('/') ? '#about' : route('home').'#about' }}">About us</a>
              </li>
              <li {{ request()->segment(2) == 'list' ? 'class=active' : '' }}>
                <i class="bx bx-chevron-right"></i> <a href="{{ route('roomtypes.list') }}">Rooms</a>
              </li>
              <li>
                <i class="bx bx-chevron-right"></i> <a href="{{ request()->is('/') ? '#testimonials' : route('home').'#testimonials' }}">Reviews</a>
              </li>
              <li>
                <i class="bx bx-chevron-right"></i> <a href="{{ request()->is('/') ? '#contact' : route('home').'#contact' }}">Contact us</a>
              </li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Popular Room Types</h4>
            <ul>
              @foreach ($footerroomtypes as $froomtype)
                <li {{ $froomtype->id == request()->segment(2) ? 'class=active' : '' }}>
                  <i class="bx bx-chevron-right"></i> <a href="{{ route('roomtypes.detail', $froomtype->slug) }}">{{ $froomtype->name }}</a>
                </li>
              @endforeach
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>It's a good time to subscribe and get the latest promotions.</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Hotel Riza</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/restaurantly-restaurant-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/venobox/venobox.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/jquery.nicescroll/jquery.nicescroll.js') }}"></script>
  <script src="{{ asset('frontend/vendor/aos/aos.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('frontend/js/main.js') }}"></script>
  @include('sweetalert::alert')
  @yield('script')
</body>

</html>