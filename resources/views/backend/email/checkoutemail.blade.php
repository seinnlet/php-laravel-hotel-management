<!DOCTYPE html>
<html>
<head>
	<title>Testing</title>
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
	<p>Warm greetings from Hotel Riza! Thank you for choosing our hotel for your recent visit to Riza.</p>
	<p>Please kindly find in the attached your invoice and feel free to reach out should you need any further assistance.</p>
	<p>We look forward to welcoming back in the future.</p>
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