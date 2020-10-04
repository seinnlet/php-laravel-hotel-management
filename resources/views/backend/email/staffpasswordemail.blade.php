<!DOCTYPE html>
<html>
<head>
	<title>Password Mail</title>
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

	<p>Dear {{ $data['gender'] }}. {{ $data['name'] }},</p>
	<p>Your registration is successful. Welcome from Hotel Riza Family!</p>
	<p>You can now log in and access your dashboard from this link <a href="{{ route('admin.login') }}" target="_blank">hotelriza.seinnletlethninn.me/admin/login</a>.</p>
	<p>Your Password is : <strong>{{ $data['password'] }}</strong></p>
	<p>If you have any questions or any technical issues, feel free to contact our technical team at technicalteam.hotelriza@gmail.com or +95 9123 121 1212.</p>
	<br>
	<p>Yours sincerely,</p>
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