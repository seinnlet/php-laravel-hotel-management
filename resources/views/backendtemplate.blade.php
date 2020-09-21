<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hotel Riza - @yield('title')</title>
  <meta name="description" content="Sample Hotel Management">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="{{ asset('backend/vendor/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/fontawesome/css/all.min.css') }}">

  <!-- Google fonts - Popppins for copy-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,600,800">
  <!-- orion icons-->
  @yield('css')

  <!-- theme stylesheet-->
  <link rel="stylesheet" href="{{ asset('backend/css/style.sea.css') }}" id="theme-stylesheet">
  
  <!-- Favicon-->
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/img/favicon.png') }}">

</head>
<body>
  <!-- navbar-->
  <header class="header">
    <nav class="navbar navbar-expand-lg px-4 bg-white shadow">
      <a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a>
      <a href="{{ route('dashboard') }}" class="navbar-brand font-weight-bold text-uppercase text-base"><i class="fas fa-map-marker-alt"></i> Hotel Riza</a>
      <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
        <li class="nav-item">
          <form id="searchForm" class="ml-auto d-none d-lg-block">
            <div class="form-group position-relative mb-0">
              <button type="submit" style="top: -3px; left: 0;" class="position-absolute bg-white border-0 p-0">
                <i class="o-search-magnify-1 text-gray text-lg"></i>
              </button>
              <input type="search" placeholder="Search ..." class="form-control form-control-sm border-0 no-shadow pl-4">
            </div>
          </form>
        </li>

        <li class="nav-item dropdown mr-3">
          <a id="notifications" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-gray-400 px-1"><i class="fa fa-bell"></i><span class="notification-icon"></span></a>
          <div aria-labelledby="notifications" class="dropdown-menu">
            <a href="#" class="dropdown-item">
              <div class="d-flex align-items-center">
                <div class="icon icon-sm bg-violet text-white"><i class="fab fa-twitter"></i></div>
                <div class="text ml-2">
                  <p class="mb-0">You have 2 followers</p>
                </div>
              </div>
            </a>
            <a href="#" class="dropdown-item"> 
              <div class="d-flex align-items-center">
                <div class="icon icon-sm bg-green text-white"><i class="fas fa-envelope"></i></div>
                <div class="text ml-2">
                  <p class="mb-0">You have 6 new messages</p>
                </div>
              </div>
            </a>
            <a href="#" class="dropdown-item">
              <div class="d-flex align-items-center">
                <div class="icon icon-sm bg-blue text-white"><i class="fas fa-upload"></i></div>
                <div class="text ml-2">
                  <p class="mb-0">Server rebooted</p>
                </div>
              </div>
            </a>
            <a href="#" class="dropdown-item">
              <div class="d-flex align-items-center">
                <div class="icon icon-sm bg-violet text-white"><i class="fab fa-twitter"></i></div>
                <div class="text ml-2">
                  <p class="mb-0">You have 2 followers</p>
                </div>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item text-center">
              <small class="font-weight-bold headings-font-family text-uppercase">View all notifications</small>
            </a>
          </div>
        </li>

        <li class="nav-item dropdown ml-auto">
          <a id="userInfo" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><img src="{{ asset(Auth::user()->staff->profilepicture) }}" alt="Jason Doe" style="width: 2.2rem; height: 2.2rem; object-fit:cover;" class="img-fluid rounded-circle shadow"></a>
          <div aria-labelledby="userInfo" class="dropdown-menu">
            <a href="{{ route('staff.show', Auth::id()) }}" class="dropdown-item">
              <strong class="d-block text-uppercase headings-font-family">{{ Auth::user()->name }}</strong><small>{{ Auth::user()->getRoleNames()->first() }}</small>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">Settings</a>
            <a href="#" class="dropdown-item">Activity log</a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </div>
        </li>

      </ul>
    </nav>
  </header>

  <div class="d-flex align-items-stretch">
    <div id="sidebar" class="sidebar py-3">
      
      <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-3 font-weight-bold small headings-font-family">MAIN</div>

      <ul class="sidebar-menu list-unstyled">
        <li class="sidebar-list-item">
          <a href="{{ route('dashboard') }}" class="sidebar-link text-muted {{request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-home mr-3 text-gray"></i><span>Home</span>
          </a>
        </li>

        @role('Reservation Staff')
          <li class="sidebar-list-item">
            <a href="" class="sidebar-link text-muted">
              <i class="fas fa-sign-in-alt mr-3 text-gray"></i><span>Check in</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="" class="sidebar-link text-muted">
              <i class="fas fa-sign-out-alt mr-3 text-gray"></i><span>Check out</span>
            </a>
          </li>
        @endrole

        @hasanyrole('Admin|Reservation Staff')
          <li class="sidebar-list-item">
            <a href="{{ route('bookings.index') }}" class="sidebar-link text-muted {{request()->routeIs('bookings*') ? 'active' : '' }}">
              <i class="fas fa-phone-volume mr-3 text-gray"></i><span>Booking List</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="{{ route('guests.index') }}" class="sidebar-link text-muted {{request()->routeIs('guests*') ? 'active' : '' }}">
              <i class="far fa-address-book mr-3 text-gray"></i><span>Guests</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="{{ route('membertypes.index') }}" class="sidebar-link text-muted {{request()->routeIs('membertypes*') ? 'active' : '' }}">
              <i class="far fa-address-card mr-3 text-gray"></i><span>Member Types</span>
            </a>
          </li>
        @endhasanyrole

        @role('Admin')
          <li class="sidebar-list-item">
            <a href="{{ route('staff.index') }}" class="sidebar-link text-muted {{request()->routeIs('staff*') ? 'active' : '' }}">
              <i class="fas fa-user-friends mr-3 text-gray"></i><span>Staff</span>
            </a>
          </li>
        @endrole
      </ul>

      <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-3 font-weight-bold small headings-font-family">Room & Service</div>

      <ul class="sidebar-menu list-unstyled">
        @hasanyrole('Admin|Reservation Staff|Service Staff')
          <li class="sidebar-list-item">
            <a href="{{ route('roomtypes.index') }}" class="sidebar-link text-muted {{request()->routeIs('roomtypes*') ? 'active' : '' }}">
              <i class="fas fa-door-open mr-3 text-gray"></i><span>Room Types</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="{{ route('rooms.index') }}" class="sidebar-link text-muted {{request()->routeIs('rooms*') ? 'active' : '' }}">
              <i class="fas fa-key mr-3 text-gray"></i><span>Rooms</span>
            </a>
          </li>
        @endhasanyrole
        @hasanyrole('Admin|Service Staff')
          <li class="sidebar-list-item">
            <a href="#" data-toggle="collapse" data-target="#pages" aria-expanded="false" aria-controls="pages" class="sidebar-link text-muted">
              <i class="fas fa-concierge-bell mr-3 text-gray"></i><span>Services</span>
            </a>
            <div id="pages" class="collapse">
              <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted pl-lg-5">Service Types</a></li>
                <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted pl-lg-5">Used Services</a></li>
              </ul>
            </div>
          </li>
        @endhasanyrole

        @hasanyrole('Admin|Chef|Service Staff')
          <li class="sidebar-list-item">
            <a href="#" data-toggle="collapse" data-target="#pages2" aria-expanded="false" aria-controls="pages2" class="sidebar-link text-muted">
              <i class="fas fa-utensils mr-3 text-gray"></i><span>Food</span>
            </a>
            <div id="pages2" class="collapse">
              <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted pl-lg-5">Food Categories</a></li>
                <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted pl-lg-5">Menu</a></li>
                <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted pl-lg-5">Order List</a></li>
              </ul>
            </div>
          </li>
        @endhasanyrole
      </ul>

    </div>

    <div class="page-holder w-100 d-flex flex-wrap">
      <div class="container-fluid px-xl-5">

        @yield('content')

      </div>

      <footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 text-center text-md-left text-primary">
              <p class="mb-2 mb-md-0">Hotel Management Laravel Project &copy; 2020.</p>
            </div>
            <div class="col-md-6 text-center text-md-right text-gray-400">
              <p class="mb-0">Design by <a href="https://bootstrapious.com/admin-templates" class="external text-gray-400">Bootstrapious</a></p>

            </div>
          </div>
        </div>
      </footer>
    </div> {{-- end of page-holder --}}
  </div>
  
  <!-- JavaScript files-->
  <script src="{{ asset('backend/js/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/vendor/popper.js/umd/popper.min.js') }}"> </script>
  <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('backend/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
  
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
  
  <script src="{{ asset('backend/js/front.js') }}"></script>

  @include('sweetalert::alert')
  @yield('script')

</body>
</html>