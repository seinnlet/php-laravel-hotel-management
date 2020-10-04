<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Hotel Riza - @yield('title')</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('frontend/vendor/jquery.nicescroll/jquery.nicescroll.js') }}"></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <!-- Google fonts - Popppins for copy-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,600,800">
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/fontawesome/css/all.min.css') }}">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  @yield('css')

</head>
<body>
	<div id="app">
		<main>
			@yield('content')
		</main>
	</div>

	@yield('script')
</body>
</html>
