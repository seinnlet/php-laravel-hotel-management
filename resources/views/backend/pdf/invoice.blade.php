<!DOCTYPE html>
<html>
<head>
	<title>Invoice PDF</title>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style type="text/css">
		h2 {
			background-color: #cda45e;
			color: #fff;
			text-align: center;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		footer {
			position: fixed;
			left: 0;
		  bottom: 0;
		  width: 100%;
		  background-color: #f7f7f7;
		  color: #6B747D;
		  text-align: center;
			padding-top: 5px;
			padding-bottom: 5px;
			font-style: italic;
		}
		table td, table th, .p-contact, .p-contact a {
			color: #212121;
		}
		.div-border {
			margin-top: 40px;
			padding: 20px;
			border: .5px solid #eee;
		}
		.tr-total td {
			padding-top: 15px;
			padding-bottom: 15px;
			border-top: .5px solid #eee;
		}
		.p-contact {
			padding: 10px auto;
		}
		h3 {
			color: #cda45e;
			margin-top: 30px;
			text-transform: uppercase;
		}
	</style>
</head>
<body>
	<h2>Hotel Riza</h2>

	<table width="100%">
		<tr>
			<td rowspan="4">
				<strong>{{ $booking->bookingid }}</strong> <br><br>
				Customer {{ $booking->guest->user->name }} <br>
				{{ $booking->guest->user->email }} <br>
				{{ $booking->guest->city }}, {{ $booking->guest->country }}
			</td>
			<td>Date: </td>
			<td>{{ date('Y-m-d') }}</td>
		</tr>
		<tr>
			<td>Room: </td>
			<td>
				@php $i=0; @endphp
				@foreach ($booking->rooms as $room){{ $i ? ',' : '' }} 
					{{ $room->roomno }}@php $i++; @endphp@endforeach
			</td>
		</tr>
		<tr>
			<td>Arrival: </td>
			<td>
				{{ date('Y-m-d', strtotime($booking->checkindatetime)) }}
				<small>(Check in: {{ date('H:i', strtotime($booking->checkindatetime)) }})</small>
			</td>
		</tr>
		<tr>
			<td>Departure: </td>
			<td>
				{{ date('Y-m-d', strtotime($booking->checkoutdatetime)) }}
				<small>(Check out: {{ date('H:i', strtotime($booking->checkoutdatetime)) }})</small>
			</td>
		</tr>
	</table>

	<div class="div-border">
		<table width="100%" cellpadding="10">
			<thead>
				<tr>
					<th style="text-align: left;">Description</th>
					<th style="text-align: right;">Amount (USD)</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Room Charges : </td>
					<td align="right">{{ number_format($booking->totalcost, 2) }}</td>
				</tr>
				
				@php
					$extrabed = 0; $latecheckout = 0; $latecheckoutcost = 0; $servicecharges = 0;
					foreach ($booking->rooms as $room) {
						$extrabed += $room->pivot->extrabed;
						$latecheckout += $room->pivot->latecheckout;
						$latecheckoutcost += ($room->pivot->latecheckout) ? $room->roomtype->pricepernight/2 : 0;
					}
					$servicecharges = $booking->grandtotal - ($booking->totalcost + ($extrabed*10) + $latecheckoutcost + $booking->taxamount + $booking->propertydamagecost);
				@endphp

				@if ($servicecharges)
					<tr>
						<td>Extra Service Charges : </td>
						<td align="right">{{ number_format($servicecharges, 2) }}</td>
					</tr>	
				@endif

				@if ($extrabed)
					<tr>
						<td>Extra Bed ($10.00 x {{ $extrabed }}) : </td>
						<td align="right">{{ number_format($extrabed * 10, 2) }}</td>
					</tr>	
				@endif

				@if ($latecheckout)
					<tr>
						<td>Late Checkout ({{ $latecheckout }} {{ $latecheckout == 1 ? 'room' : 'rooms' }}) : </td>
						<td align="right">{{ number_format($latecheckoutcost, 2) }}</td>
					</tr>	
				@endif

				<tr>
					<td>Tax Amount (5%) : </td>
					<td align="right">{{ number_format($booking->taxamount, 2) }}</td>
				</tr>

				@if ($booking->propertydamagecost)
					<tr>
						<td>Property Damage Charges : </td>
						<td align="right">+ {{ number_format($booking->propertydamagecost, 2) }}</td>
					</tr>	
				@endif
				<tr class="tr-total">
					<td><strong>Grand Total : </strong></td>
					<td align="right"><big>$ {{ number_format($booking->grandtotal, 2) }}</big></td>
				</tr>

				@if ($booking->pointsused)
					<tr>
						@php $savedamount = $booking->pointsused * 0.01; @endphp
						<td>Points Used: {{ $booking->pointsused }}</td>
						<td align="right">- {{ number_format($savedamount, 2) }}</td>
					</tr>
					<tr>
						<td>Paid :</td>
						<td align="right">$ {{ number_format($booking->grandtotal - $savedamount,2) }}</td>
					</tr>
				@endif

			</tbody>
		</table>
	</div>

	<h3>Hotel Riza</h3>

	<p class="p-contact">
		tel: +95 9129 1299 198 <br>
		mail: hotelriza.info@gmail.com <br>
		Pyay Road, Yangon, Myanmar <br>
		<a href="https://hotelriza.seinnletlethninn.me">hotelriza.seinnletlethninn.me</a>
	</p>
	<footer>Laravel Project 2020.</footer>
</body>
</html>