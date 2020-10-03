@extends('backendtemplate')

@section('title', 'Service Staff Dashboard')

@section('content')

<section class="py-5">
  <div class="row">
    <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
      <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-violet"></div>
          <div class="text">
            <h6 class="mb-0">Today Used Services</h6><span class="text-gray">{{ $todayusedservicecount }}</span>
          </div>
        </div>
        <div class="icon text-white bg-violet"><i class="far fa-clipboard"></i></div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
      <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-green"></div>
          <div class="text">
            <h6 class="mb-0">All Service Types</h6><span class="text-gray">{{ $servicecount }}</span>
          </div>
        </div>
        <div class="icon text-white bg-green"><i class="fas fa-concierge-bell"></i></div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
      <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-blue"></div>
          <div class="text">
            <h6 class="mb-0">Check in Rooms</h6><span class="text-gray">{{ $checkinroomcount }} / {{ $roomcount }}</span>
          </div>
        </div>
        <div class="icon text-white bg-blue"><i class="fas fa-key"></i></div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
      <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-red"></div>
          <div class="text">
            <h6 class="mb-0">Service Staff</h6><span class="text-gray">{{ $servicestaffcount }}</span>
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
          <h2 class="h6 text-uppercase mb-0">Services Line Chart</h2>
        </div>
        <div class="card-body">
          <p class="text-gray">Used Service Count by Months</p>
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
              <h2 class="mb-0 d-flex align-items-center"><span>3</span><span class="dot bg-green d-inline-block ml-3"></span></h2><span class="text-muted text-uppercase small">Types of Service</span>
              <hr><small class="text-muted">Max Used Services in this Month</small>
            </div>
            <div class="col-lg-7">
              <canvas id="pieChartHome1"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white shadow roundy p-4 d-flex align-items-center justify-content-between mb-4">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-violet"></div>
          <div class="text">
            <h6 class="mb-2">Today New Services</h6>
            <span class="text-gray font-italic"><small>{{ count($todaynewservices) }} More {{ (!count($todaynewservices) || count($todaynewservices) == 1) ? 'Request' : 'Requests' }}</small></span>
          </div>
        </div>
        <div class="icon bg-violet text-white"><i class="fas fa-clipboard-list"></i></div>
      </div>

      <div class="bg-white shadow roundy p-4 d-flex align-items-center justify-content-between mb-4">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-blue"></div>
          <div class="text">
            <h6 class="mb-2">Today Completed Services</h6>
            <span class="text-gray font-italic"><small>{{ $todaydoneservicecount }} {{ (!$todaydoneservicecount || $todaydoneservicecount == 1) ? 'Request' : 'Requests' }} Done</small></span>
          </div>
        </div>
        <div class="icon bg-blue text-white"><i class="fas fa-clipboard-check"></i></div>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="row">
    @foreach ($todaynewservices as $tservice)
      <div class="col-lg-12"><a href="{{ route('services.list') }}" class="message card px-5 py-3 mb-4 bg-hover-gradient-primary no-anchor-style">
        <div class="row">
          <div class="col-lg-3 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
            <strong class="h6 mb-0">{{ date('h:i', strtotime($tservice->created_at)) }}<sup class="smaller text-gray font-weight-normal">{{ date('A', strtotime($tservice->created_at)) }}</sup></strong>
            
            <h6 class="mb-0 ml-3"> R -{{ $tservice->roomno }}</h6>
          </div>
          <div class="col-lg-9 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
            <div class="bg-gray-100 roundy px-4 py-1 mr-0 mr-lg-3 mt-2 mt-lg-0 text-dark exclode text-capitalize">
              {{ $tservice->status }}
            </div>
            <p class="mb-0 mt-3 mt-lg-0">

              {{ $tservice->name }} 
              <small>({{ $tservice->totalqty }} {{ ($tservice->totalqty == 1 ) ? 'item'  : 'items'}})</small>
              
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
      servicearray = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

      @foreach ($linechartservices as $lservice)
        servicearray[{{$lservice->months-1}}] = {{ $lservice->servicecount }}
      @endforeach

      max = Math.max(...servicearray);
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
                    label: "Used Service Count",
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
                    data: servicearray,
                    spanGaps: false
                }
            ]
        }
      });

      pieservicearray = [];
      @foreach ($pieservices as $pservice)
        pieservicearray.push({{ $pservice->count }});
      @endforeach
      
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
                @foreach ($pieservices as $pservice)
                  "{{ $pservice->name }}",
                @endforeach
              ],
              datasets: [{
                  data: pieservicearray,
                  borderWidth: [0, 0],
                  backgroundColor: [
                      green,
                      violet,
                      "#eee",
                  ],
                  hoverBackgroundColor: [
                      green,
                      violet,
                      "#eee",
                  ]
              }]
          }
      });

    }) // end

  </script>

@endsection