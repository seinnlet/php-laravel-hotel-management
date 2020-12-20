@extends('backendtemplate')

@section('title', 'Rooms')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/datatables/datatables.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/jquery-nice-select/nice-select.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/bootstrap/css/bootstrap-table.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/bootstrap/css/bootstrap-table-fixed-columns.min.css') }}">

	<style type="text/css">	
		.table-checkinlist th, .table-checkinlist td {
			color: #6c757d;
			font-size: .8rem;
		}
		.table-checkinlist th {
			font-weight: 600;
		}
		.nice-select {
			height: 38px;
		}
		.bg-today {
			background-color: #FBF9F4;
		}
		.bg-weekend {
			background-color: #fbfbfb;
		}
	</style>
@endsection

@section('content')

	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">Rooms</h5>
			<a href="{{ route('rooms.create') }}" class="btn btn-primary float-right rounded"><i class="fas fa-plus fa-sm mr-2 text-gray-100"></i> Add New</a>
			<div class="clearfix"></div>
		</div>

		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">Room List</h3>
      </div>
      <div class="card-body">

      	<div class="mb-4">
					<button class="btn btn-primary btn-sm px-3 mr-3" id="btn-roomlist"><i class="fas fa-clipboard-list fa-sm mr-2"></i>Room List</a>
					<button class="btn btn-outline-primary btn-sm px-3" id="btn-checkinlist"><i class="fas fa-table fa-sm mr-2"></i>Check in List</button>
				</div>

      	{{-- data table --}}
      	<div class="table-responsive pb-5 div-roomlist">
				  <table class="table" id="datatable" style="width: 100%">
				    <thead>
				    	<tr>
				    		<td>No.</td>
				    		<td>Room_No</td>
				    		<td>Room_Type</td>
				    		<td>Status</td>
				    		<td>Created_at</td>
				    		<td>Action</td>
				    	</tr>
				    </thead>

				    <tbody>
				    	@php $i = 1 @endphp
				    	@foreach ($rooms as $room)
				    		<tr>
				    			<td>{{ $i }}.</td>
				    			<td>R-{{ $room->roomno }}</td>
				    			<td>{{ $room->roomtype->name }}</td>
				    			<td>
				    				@if ($room->status == 1)
				    					<span class="badge badge-primary badge-pill">Available</span>
				    				@elseif ($room->status == 2)
				    					<span class="badge badge-success badge-pill">Check in</span>
				    				@elseif ($room->status == 3)
				    					<span class="badge badge-info badge-pill">Cleaning</span>
				    				@endif
				    			</td>
				    			<td><small><em>{{ $room->created_at->format('Y-m-d') }}</em></small></td>
				    			<td class="td-action">
				    				<a href="{{ route('rooms.edit', $room->id) }}" class="a-edit" data-toggle="tooltip" title="Edit"><i class="fas fa-pen"></i></a>
				    				
				    				<form method="post" action="{{ route('rooms.destroy', $room->id) }}" class="d-inline" id="delete-room{{ $room->id }}" >
											@csrf
		          				@method('DELETE')
					    				<button type="button" class="a-delete" data-toggle="tooltip" title="Delete" onclick="confirmDelete('delete-room{{ $room->id }}')"><i class="fas fa-times-circle"></i></button>
					    			</form>
					    			@role('Service Staff')
					    				@if ($room->status != 3)
					    					<a href="{{ route('rooms.clean', $room->id) }}" class="a-detail" data-toggle="tooltip" title="Clean Room"><i class="fas fa-hand-sparkles"></i></a>
					    				@else
					    					<a href="{{ route('rooms.clean', $room->id) }}" class="a-detail" data-toggle="tooltip" title="Finished"><i class="fas fa-door-closed"></i></a>
					    				@endif
						    			
						    		@endrole 
				    			</td>
				    		</tr>
				    		@php $i++ @endphp
				    	@endforeach
				    </tbody>

				  </table>
				</div>

				<div class="div-checkinlist pb-3" style="display: none;">
					<div class="row">
						<label class="col-form-label col-3 col-md-2">Month: </label>
						
						<div class="col-5 col-md-3">
							@php $thismonth = date('m'); @endphp
							<select class="form-control nice-select wide" id="month" name="month" >
				     		<option value="default" disabled>Select Month</option>
			     			<option value="1" @if($thismonth == '01') selected @endif>January</option>
			     			<option value="2" @if($thismonth == '02') selected @endif>February</option>
			     			<option value="3" @if($thismonth == '03') selected @endif>March</option>
			     			<option value="4" @if($thismonth == '04') selected @endif>April</option>
			     			<option value="5" @if($thismonth == '05') selected @endif>May</option>
			     			<option value="6" @if($thismonth == '06') selected @endif>June</option>
			     			<option value="7" @if($thismonth == '07') selected @endif>July</option>
			     			<option value="8" @if($thismonth == '08') selected @endif>August</option>
			     			<option value="9" @if($thismonth == '09') selected @endif>September</option>
			     			<option value="10" @if($thismonth == '10') selected @endif>October</option>
			     			<option value="11" @if($thismonth == '11') selected @endif>November</option>
			     			<option value="12" @if($thismonth == '12') selected @endif>December</option>
				     	</select>
						</div>

						<div class="col-4 col-md-3">
							<select class="form-control nice-select wide" id="year" name="year" >
				     		<option value="default" disabled>Select Year</option>
				     		@php $thisyear = date('Y'); @endphp
			     			@for ($startyear = 2020; $startyear <= $thisyear ; $startyear++)
			     				<option value="{{ $startyear }}">{{ $startyear }}</option>
			     			@endfor
				     	</select>
						</div>
					</div>

					<div class="table-responsive my-4 div-table-responsive">
						<table class="table table-checkinlist">
							<thead>
								<th class="border-right" data-fixed-columns="true">RoomNo./Day</th>
								@php 
									$today = (int)date('d'); 
									$saturday = $firstsatday; 
									if($saturday == 7) 
										$sunday = 1;
									else 
										$sunday = $saturday+1; 
								@endphp
								@for ($i = 1; $i <= $lastday; $i++)
									<th @if($i == $today) class='bg-today' @endif @if($i == $saturday || $i == $sunday) class='bg-weekend' @endif>{{ $i }}</th>
									@php 
										if($i%7 == 0) $saturday += 7;
										if($i%7 == 0) $sunday += 7;
									@endphp
								@endfor
							</thead>
							<tbody>
								
								@foreach ($rooms as $room)
									<tr>
										<td class="border-right" data-fixed-columns="true">R-{{ $room->roomno }}</td>

										@php 
											$x = 1;
											$saturday = $firstsatday; 
											if($saturday == 7) 
												$sunday = 1;
											else 
												$sunday = $saturday+1; 
										@endphp
										@foreach ($checkinrooms as $croom)

											@php $check = false; @endphp

											@if (count($croom))
												@foreach ($croom as $cr)
													@if ($cr->roomno == $room->roomno)
														<td class="text-primary 
															@if($x == $today)
																bg-today
															@elseif($x == $saturday || $x == $sunday)
																bg-weekend
															@endif
														"><i class="far fa-check-circle"></i></td>
														@php $check = true; @endphp
													@endif
												@endforeach
											@endif

											@if (!$check)
												<td @if($x == $today) class='bg-today' @endif @if($x == $saturday || $x == $sunday) class='bg-weekend' @endif></td>
											@endif
											@php 
												$x++; 
												if($x%7 == 0) $saturday += 7;
												if($x%7 == 0) $sunday += 7;
											@endphp
										@endforeach

									</tr>
								@endforeach
							</tbody>
						</table>
					</div>

				</div>

      </div>
    </div>

	</section>
@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('backend/vendor/datatables/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/vendor/jquery-nice-select/jquery.nice-select.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/vendor/bootstrap/js/bootstrap-table.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/vendor/bootstrap/js/bootstrap-table-fixed-columns.min.js') }}"></script>

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready( function () {
			$('select').niceSelect();
	    $('#datatable').DataTable();
	    $('.table-checkinlist').bootstrapTable({
				fixedColumns: true,
				fixedNumber: 1,
			})
			$('[data-toggle="tooltip"]').tooltip();
			$(".div-table-responsive .fixed-table-body").niceScroll({
				cursorcolor: "#bbb",
			});

			// monthly check in list
			$('#btn-roomlist').click(function() {
				$(this).toggleClass('btn-primary btn-outline-primary');
				$('#btn-checkinlist').toggleClass('btn-primary btn-outline-primary');
				$('.div-roomlist').show('slow');
				$('.div-checkinlist').hide();
			});

			$('#btn-checkinlist').click(function() {
				$('.table-checkinlist').removeClass('table-hover table-bordered');
				$(this).toggleClass('btn-primary btn-outline-primary');
				$('#btn-roomlist').toggleClass('btn-primary btn-outline-primary');
				$('.div-checkinlist').show('slow');
				$('.div-roomlist').hide();
			});

			// ajax 
			$('#month').on('change', function() {
			  let month = this.value;
			  let year = $('#year').val();

			  let url = '{{ route('rooms.getcheckinrooms', [":month", ":year"]) }}';
			  url = url.replace(':month', month);
			  url = url.replace(':year', year);

			  let thead = '', tbody = '';
			  let date = new Date();
			  let today = date.getDate(); 
			  let thismonth = date.getMonth() + 1;
			  let thisyear = date.getFullYear();

			  $.ajax({
			    type:'GET',
         	url: url,
         	success:function(data){
         		
         		if (data) {
         			$('.table-checkinlist').html('');

         			// thead
         			thead += ` 
         				<thead>
									<th class="border-right" style="" data-field="0">
										<div class="th-inner ">RoomNo./Day</div>
										<div class="fht-cell"></div>
									</th>
								`;
							
							saturday = data.firstsatday; 
							if (saturday == 7) {
       					sunday = 1;
       				} else {
								sunday = saturday+1; 
       				}

							for(var i = 1; i <= data.lastday; i++){
								if (i == today && month == thismonth && year == thisyear) {
									thead += `<th class='bg-today' data-field=${i}><div class="th-inner ">${i}</div><div class="fht-cell"></div></th>`;
								} else if (i == saturday || i == sunday) {
									thead += `<th class='bg-weekend' data-field=${i}><div class="th-inner ">${i}</div><div class="fht-cell"></div></th>`;
								} else {
									thead += `<th data-field=${i}><div class="th-inner ">${i}</div><div class="fht-cell"></div></th>`;
								}
								
								if(i%7 == 0) {
									saturday += 7;
									sunday += 7;
								} 
							}
							thead += `</thead>`;
         			
         			// tbody 

         			tbody += `<tbody>`;
         			$.each(data.rooms, function(i, v) {
         				tbody += `<tr><td class="border-right" data-fixed-columns="true">R-${v.roomno}</td>`;
         				saturday = data.firstsatday; 
         				if (saturday == 7) {
         					sunday = 1;
         				} else {
									sunday = saturday+1; 
         				}

         				$.each(data.checkinrooms, function(ci, cv) {
         					let check = false;
         					if (cv.length) {
         						$.each(cv, function(cvi, cvv) {
         							if (cvv.roomno == v.roomno) {
         								if ((ci+1) == today && month == thismonth && year == thisyear) {
													tbody += `<td class="text-primary bg-today"><i class="far fa-check-circle"></i></td>`;
												} else if ((ci+1) == saturday || (ci+1) == sunday) {
													tbody += `<td class="text-primary bg-weekend"><i class="far fa-check-circle"></i></td>`;
												} else {
													tbody += `<td class="text-primary"><i class="far fa-check-circle"></i></td>`;
												}
         								
         								check = true;
         							}
         						});
         					}
         					if (!check) { 
         						if ((ci+1) == today && month == thismonth && year == thisyear) {
											tbody += `<td class='bg-today'></td>`;
										} else if ((ci+1) == saturday || (ci+1) == sunday) {
											tbody += `<td class='bg-weekend'></td>`;
										} else {
											tbody += `<td></td>`;
										}
         					}

         					if((ci+1)%7 == 0) {
										saturday += 7;
										sunday += 7;
									} 
         				});

         				tbody += `</tr>`;
         			});	
         			tbody += `</tbody>`;

         			$('.table-checkinlist').html(thead + tbody);
         		}

         	}
				});


			});	// end of ajax 

			

	 	});

	 	// delete sweet alert
		function confirmDelete(room_id) {
  		swal({
  			title: "Are you sure to Delete?",
  			text: "The data will be permanently deleted.",
  			icon: "warning",
  			buttons: true,
  			dangerMode: true,
  		})
  		.then((willDelete) => {
  			if (willDelete) {
  				$('#'+room_id).submit();
  			}
  		});
  	}

	</script>
@endsection