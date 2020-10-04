<!DOCTYPE html>
<html>
<head>
	<title>Booking Mail</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<style type="text/css">
		.title {
			color: #cda45e;
			font-weight: bold;
		}
		.contact, .contact a {
			color: #6c757d;
			font-weight: 600;
		}
		hr {
      background-color: #fff;
      border-top: 1px dashed #ccc !important;
      border-bottom: none;
    }
    small	{
    	font-style: italic;
    	color: #6c757d;
    }
	</style>
</head>
<body>

	<p>Dear Customer {{ $data['name'] }},</p>
	<p>Thank you for booking your stay at Hotel Riza. We have confirmed your booking with the following details as requested.</p>
	<p>
		Check in Date: {{ $data['checkindate'] }} <br>
		Check out Date: {{ $data['checkoutdate'] }} <br>
		No of Rooms: {{ $data['noofrooms'] }}
	</p>
	<p>You can also view your booking details by logging in on our website at <a href="{{ route('login') }}" target="_blank">hotelriza.seinnletlethninn.me/login</a>. </p>
	<p>
		Log in details are as follows. <br>
		User Name: <strong>{{ $data['email'] }}</strong> <br>
		Password : <strong>{{ $data['password'] }}</strong>
	</p>
	<p>
		Free cancellation is eligible 5 days before the check in date.   
	</p>

	<br>
	<p>With best regards,</p>
	<br>

	<span class="title">HOTEL RIZA</span>
	<p class="contact">
		tel: +95 9129 1299 198 <br>
		mail: hotelriza.info@gmail.com <br>
		Pyay Road, Yangon, Myanmar <br>
		<a href="https://hotelriza.seinnletlethninn.me">hotelriza.seinnletlethninn.me</a>
	</p>
	<hr>
	<small>Laravel Project 2020.</small>
</body>
</html>