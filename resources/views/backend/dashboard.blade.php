@extends('backendtemplate')

@section('title', 'Dashboard')

@section('content')

<section class="py-5">
  <div class="row">
    <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
      <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-violet"></div>
          <div class="text">
            <h6 class="mb-0">Total Bookings</h6><span class="text-gray">{{ $bookingcount }}</span>
          </div>
        </div>
        <div class="icon text-white bg-violet"><i class="fas fa-phone-volume"></i></div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
      <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-green"></div>
          <div class="text">
            <h6 class="mb-0">Total Rooms</h6><span class="text-gray">{{ $roomcount }}</span>
          </div>
        </div>
        <div class="icon text-white bg-green"><i class="fas fa-key"></i></div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
      <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-blue"></div>
          <div class="text">
            <h6 class="mb-0">Members</h6><span class="text-gray">{{ $membercount }} / {{ $guestcount }}</span>
          </div>
        </div>
        <div class="icon text-white bg-blue"><i class="far fa-address-book"></i></div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
      <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-red"></div>
          <div class="text">
            <h6 class="mb-0">Staff</h6><span class="text-gray">{{ $staffcount }}</span>
          </div>
        </div>
        <div class="icon text-white bg-red"><i class="fas fa-user-friends"></i></div>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="row mb-4">
    <div class="col-lg-7 mb-4 mb-lg-0">
      <div class="card">
        <div class="card-header">
          <h2 class="h6 text-uppercase mb-0">Bookings Line Chart</h2>
        </div>
        <div class="card-body">
          <p class="text-gray">Booking Count by Months</p>
          <div class="chart-holder mt-5 mb-5">
            <canvas id="lineChartExample"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-5 mb-4 mb-lg-0">
      <div class="card mb-5">
        <div class="card-body">
          <div class="row align-items-center flex-row">
            <div class="col-lg-5">
              @php $pie1percentage = $successbookingcount / $allbookingcount * 100; @endphp
              <h2 class="mb-0 d-flex align-items-center"><span>{{ number_format($pie1percentage, 1) }}</span><span class="dot bg-green d-inline-block ml-3"></span></h2><span class="text-muted text-uppercase small">% Success!</span>
              <hr><small class="text-muted">Successful Bookings Pie Chart</small>
            </div>
            <div class="col-lg-7">
              <canvas id="pieChartHome1"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="row align-items-center flex-row">
            <div class="col-lg-5">
              @php $pie2percentage = $membercount / $guestcount * 100; @endphp
              <h2 class="mb-0 d-flex align-items-center"><span>{{ number_format($pie2percentage, 1) }}</span><span class="dot bg-violet d-inline-block ml-3"></span></h2><span class="text-muted text-uppercase small">% Member Now!</span>
              <hr><small class="text-muted">Current Members Pie Chart</small>
            </div>
            <div class="col-lg-7">
              <canvas id="pieChartHome2"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-5 mb-4 mb-lg-0">
      <div class="bg-white shadow roundy p-4 d-flex align-items-center justify-content-between mb-4">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-green"></div>
          <div class="text">
            <h6 class="mb-0">Best Room Types of the Month</h6>
          </div>
        </div>
        <div class="icon bg-green text-white"><i class="fas fa-star"></i></div>
      </div>

      @php $i=1; @endphp
      @foreach ($bestroomtypes as $roomtype)
        <div class="bg-white shadow roundy p-4 d-flex align-items-center justify-content-between mb-4">
          <div class="flex-grow-1 d-flex align-items-center">
            <div class="dot mr-3 bg-violet"></div>
            <div class="text">
              <h6 class="mb-2">{{ $i }}. {{ $roomtype->name }}</h6>
              <span class="text-gray font-italic"><small>{{ $roomtype->count }} {{ $roomtype->count == 1 ? 'time ' : 'times ' }}this month. </small></span>
            </div>
          </div>
          <div class="icon bg-violet text-white"><i class="fas fa-phone-volume"></i></div>
        </div>
        @php $i++; @endphp
      @endforeach
        
    </div>

    <div class="col-lg-7">
      <div class="card">
        <div class="card-header">
          <h2 class="h6 text-uppercase mb-0">Check in Rooms</h2>
        </div>
        <div class="card-body">
          <p class="text-gray">Coming up Ten days Check in Rooms Bar Chart</p>
          <div class="chart-holder mt-5 mb-3">
            <canvas id="barChartExample1"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="row">
    @foreach ($comingupbookings as $cbooking)
      <div class="col-lg-12"><a href="{{ route('bookings.checkindetail', $cbooking->id) }}" class="message card px-5 py-3 mb-4 bg-hover-gradient-primary no-anchor-style">
        <div class="row">
          <div class="col-lg-3 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
            <strong class="h5 mb-0">{{ date('d', strtotime($cbooking->bookstartdate)) }}<sup class="smaller text-gray font-weight-normal">{{ date('M', strtotime($cbooking->bookstartdate)) }}</sup></strong>
            <img src="{{ asset($cbooking->guest->profilepicture) }}" style="max-width: 3rem" class="rounded-circle mx-3 my-2 my-lg-0 bg-white">
            <h6 class="mb-0">{{ $cbooking->guest->user->name }}</h6>
          </div>
          <div class="col-lg-9 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
            <div class="bg-gray-100 roundy px-4 py-1 mr-0 mr-lg-3 mt-2 mt-lg-0 text-dark exclode text-capitalize">
              {{ $cbooking->status }}
            </div>
            <p class="mb-0 mt-3 mt-lg-0">

              {{ $cbooking->duration }} {{ $cbooking->duration == 1 ? 'Night' : 'Nights' }} &#183; 
              {{ count($cbooking->rooms) }} {{ count($cbooking->rooms) == 1 ? 'Room' : 'Rooms' }}
              @if ($cbooking->earlycheckin)
                (Early Checkin)
              @endif
            </p>
          </div>
        </div></a>
      </div>
    @endforeach
  </div>
</section>

@endsection

@section('script')

  <script src="{{ asset('backend/vendor/chart.js/Chart.min.js') }}"></script>
  {{-- <script src="{{ asset('backend/js/charts-home.js') }}"></script> --}}

<script type="text/javascript">
    
    $(function () {

      var violet = '#DF99CA',
        red    = '#F0404C',
        green  = '#7CF29C';

      // ------------------------------------------------------- //
      // Charts Gradients
      // ------------------------------------------------------ //
      var ctx1 = $("canvas").get(0).getContext("2d");
      var gradient1 = ctx1.createLinearGradient(150, 0, 150, 300);
      gradient1.addColorStop(0, 'rgba(210, 114, 181, 0.91)');
      gradient1.addColorStop(1, 'rgba(177, 62, 162, 0)');

      var gradient2 = ctx1.createLinearGradient(10, 0, 150, 300);
      gradient2.addColorStop(0, 'rgba(252, 117, 176, 0.84)');
      gradient2.addColorStop(1, 'rgba(250, 199, 106, 0.92)');

      // line chart 
      bookingarray = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

      @foreach ($linearchartbookings as $lbooking)
        bookingarray[{{$lbooking->months-1}}] = {{ $lbooking->bookingcount }}
      @endforeach

      max = Math.max(...bookingarray);
      max = Math.ceil(max / 10) * 10;


      var LINECHARTEXMPLE   = $('#lineChartExample');
      var lineChartExample = new Chart(LINECHARTEXMPLE, {
        type: 'line',
        options: {
            legend: {labels:{fontColor:"#777", fontSize: 12}},
            scales: {
                xAxes: [{
                    display: true,
                    gridLines: {
                        color: '#fff'
                    }
                }],
                yAxes: [{
                    display: true,
                    ticks: {
                        max: max,
                        min: 0
                    },
                    gridLines: {
                        color: '#fff'
                    }
                }]
            },
        },
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [
                {
                    label: "Booking Count",
                    fill: true,
                    lineTension: 0.3,
                    backgroundColor: gradient1,
                    borderColor: 'rgba(210, 114, 181, 0.91)',
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    borderWidth: 2,
                    pointBorderColor: gradient1,
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 2,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: gradient1,
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: bookingarray,
                    spanGaps: false
                }
            ]
        }
      });


      let up = {{ $successbookingcount }};
      let all = {{ $allbookingcount }};
      
      // pie chart
      var PIECHART = $('#pieChartHome1');
      var myPieChart = new Chart(PIECHART, {
          type: 'doughnut',
          options: {
              cutoutPercentage: 80,
              legend: {
                  display: false
              }
          },
          data: {
              labels: [
                  "Success Bookings",
                  "Cancel Bookings",
              ],
              datasets: [{
                  data: [up, all-up],
                  borderWidth: [0, 0],
                  backgroundColor: [
                      green,
                      "#eee",
                  ],
                  hoverBackgroundColor: [
                      green,
                      "#eee",
                  ]
              }]
          }
      });

      let member = {{ $membercount }};
      let guest = {{ $guestcount }};
      var PIECHART = $('#pieChartHome2');
      var myPieChart = new Chart(PIECHART, {
          type: 'doughnut',
          options: {
              cutoutPercentage: 80,
              legend: {
                  display: false
              }
          },
          data: {
              labels: [
                  "Members",
                  "Not Yet"
              ],
              datasets: [{
                  data: [member, guest-member],
                  borderWidth: [0, 0],
                  backgroundColor: [
                      violet,
                      "#eee"
                  ],
                  hoverBackgroundColor: [
                      violet,
                      "#eee"
                  ]
              }]
          }
      });

      // bar chart
      roomarray = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

      @php $i=0; @endphp
      @foreach ($checkinrooms as $croom)
        roomarray[{{$i}}] = {{ count($croom) }};
        @php $i++; @endphp
      @endforeach

      var today = new Date();
      today.setDate(today.getDate() + 9);
      var tenday = today.toISOString().substr(0,10);
      today = new Date().toJSON().slice(0,10).replace(/-/g,'-');

      var getDateArray = function(start, end) {
        var
          arr = new Array(),
          dt = new Date(start);

        while (dt <= end) {
          arr.push(new Date(dt).getMonth() + '-' + new Date(dt).getDate());
          dt.setDate(dt.getDate() + 1);
        }
        return arr;
      }

      var dateArr = getDateArray(new Date(today), new Date(tenday));

      var BARCHARTEXMPLE    = $('#barChartExample1');
      var barChartExample = new Chart(BARCHARTEXMPLE, {
        type: 'bar',
        options: {
          scales: {
              xAxes: [{
                  display: true,
                  gridLines: {
                      color: '#fff'
                  }
              }],
              yAxes: [{
                  display: true,
                  ticks: {
                      max: {{ $roomcount }},
                      min: 0
                  },
                  gridLines: {
                      color: '#fff'
                  }
              }]
          },
          legend: false
        },
        data: {
            labels: dateArr,
            datasets: [
                {
                    label: "Check in Rooms",
                    backgroundColor: [
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                    ],
                    hoverBackgroundColor: [
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                    ],
                    borderColor: [
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                        gradient2,
                    ],
                    borderWidth: 1,
                    data: roomarray,
                }
            ]
        }
      });
    }); // end of documentation ready function

  </script>

@endsection