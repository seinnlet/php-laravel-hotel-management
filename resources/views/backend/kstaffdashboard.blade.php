@extends('backendtemplate')

@section('title', 'Kitchen Staff Dashboard')

@section('content')

<section class="py-5">
  <div class="row">
    <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
      <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-violet"></div>
          <div class="text">
            <h6 class="mb-0">Total Orders</h6><span class="text-gray">{{ $ordercount }}</span>
          </div>
        </div>
        <div class="icon text-white bg-violet"><i class="fas fa-clipboard-list"></i></div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
      <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-green"></div>
          <div class="text">
            <h6 class="mb-0">Total Menus</h6><span class="text-gray">{{ $menucount }}</span>
          </div>
        </div>
        <div class="icon text-white bg-green"><i class="fas fa-utensils"></i></div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
      <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-blue"></div>
          <div class="text">
            <h6 class="mb-0">Categories</h6><span class="text-gray">{{ $foodcategorycount }}</span>
          </div>
        </div>
        <div class="icon text-white bg-blue"><i class="fas fa-glass-martini-alt"></i></div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
      <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-red"></div>
          <div class="text">
            <h6 class="mb-0">Kitchen Staff</h6><span class="text-gray">{{ $kitchenstaffcount }}</span>
          </div>
        </div>
        <div class="icon text-white bg-red"><i class="fas fa-user-friends"></i></div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="row">
    <div class="col-lg-7 mb-4 mb-lg-0">
      <div class="card">
        <div class="card-header">
          <h2 class="h6 text-uppercase mb-0">Orders Line Chart</h2>
        </div>
        <div class="card-body">
          <p class="text-gray">Order Count by Months</p>
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
              <h2 class="mb-0 d-flex align-items-center"><span>{{ $foodcategorycount }}</span><span class="dot bg-green d-inline-block ml-3"></span></h2><span class="text-muted text-uppercase small">Categories</span>
              <hr><small class="text-muted">Menu By Category</small>
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
            <h6 class="mb-2">Today New Orders</h6>
            <span class="text-gray font-italic"><small>{{ count($todayneworders) }} New {{ (!count($todayneworders) || count($todayneworders) == 1) ? 'Order' : 'Orders' }}</small></span>
          </div>
        </div>
        <div class="icon bg-violet text-white"><i class="fas fa-clipboard-list"></i></div>
      </div>

      <div class="bg-white shadow roundy p-4 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-blue"></div>
          <div class="text">
            <h6 class="mb-2">Today Finished Orders</h6>
            <span class="text-gray font-italic"><small>{{ $todaydoneordercount }} {{ (!$todaydoneordercount || $todaydoneordercount == 1) ? 'Order' : 'Orders' }} Done</small></span>
          </div>
        </div>
        <div class="icon bg-blue text-white"><i class="fas fa-clipboard-check"></i></div>
      </div>
    </div>
  </div>
</section>

<section class="pt-5">
  <div class="row">
    <div class="col-lg-4">
      <div class="bg-white shadow roundy px-4 py-3 d-flex align-items-center justify-content-between mb-4">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-violet"></div>
          <div class="text">
            <h6 class="mb-1">Most Expensive</h6><span class="text-gray">{{ $expensivemenus[0]->name }} - $ {{ $expensivemenus[0]->unitprice }}</span>
          </div>
        </div>
        <div class="icon bg-violet text-white"><i class="fas fa-tags"></i></div>
      </div>
      <div class="bg-white shadow roundy px-4 py-3 d-flex align-items-center justify-content-between mb-4">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-green"></div>
          <div class="text">
            <h6 class="mb-1">Second Most Expensive</h6><span class="text-gray">{{ $expensivemenus[1]->name }} - $ {{ $expensivemenus[1]->unitprice }}</span>
          </div>
        </div>
        <div class="icon bg-green text-white"><i class="fas fa-tags"></i></div>
      </div>
      <div class="card px-5 py-4 mb-4">
        @php 
          $neworders = count($todayneworders); 
          $totalorders = $neworders + $todaydoneordercount;
          $piepercentage = ($totalorders) ? ($todaydoneordercount / $totalorders) * 100 : 0; 
        @endphp
        <h2 class="mb-0 d-flex align-items-center"><span>{{ number_format($piepercentage, 1) }} <small>%</small></span><span class="dot bg-green d-inline-block ml-3"></span></h2><span class="text-muted">Today Orders Done</span>
        <canvas id="pieChartHome2" class="mt-4 mb-3"></canvas>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card mb-lg-0">         
        <div class="card-header">
          <h2 class="h6 mb-0 text-uppercase">Popular Menus</h2>
        </div>
        <div class="card-body">
          <p class="text-gray mb-5">Top Three Menus Customers Ordered</p>
          
          @if (count($topmenus))
          
          @if (count($topmenus) >= 1)
          <div class="d-flex justify-content-between align-items-start align-items-sm-center mb-5 flex-column flex-sm-row">
            <div class="left d-flex align-items-center">
              <div class="icon icon-lg shadow mr-3 text-gray"><i class="fas fa-award"></i></div>
              <div class="text">
                <h6 class="mb-0 d-flex align-items-center"> <span>1. {{ $topmenus[0]->name }}.</span><span class="dot dot-sm ml-2 bg-violet"></span></h6><small class="text-gray">Total {{ $topmenus[0]->qty }} {{ $topmenus[0]->qty == 1 ? 'time' : 'times' }}</small>
              </div>
            </div>
            <div class="right ml-5 ml-sm-0 pl-3 pl-sm-0 text-violet">
              <h5>$ {{ $topmenus[0]->unitprice }}</h5>
            </div>
          </div>
          @endif 
          @if (count($topmenus) >= 2)
          <div class="d-flex justify-content-between align-items-start align-items-sm-center mb-5 flex-column flex-sm-row">
            <div class="left d-flex align-items-center">
              <div class="icon icon-lg shadow mr-3 text-gray"><i class="fas fa-award"></i></div>
              <div class="text">
                <h6 class="mb-0 d-flex align-items-center"> <span>2. {{ $topmenus[1]->name }}.</span><span class="dot dot-sm ml-2 bg-green"></span></h6><small class="text-gray">Total {{ $topmenus[1]->qty }} {{ $topmenus[1]->qty == 1 ? 'time' : 'times' }}</small>
              </div>
            </div>
            <div class="right ml-5 ml-sm-0 pl-3 pl-sm-0 text-green">
              <h5>$ {{ $topmenus[1]->unitprice }}</h5>
            </div>
          </div>
          @endif
          @if (count($topmenus) >= 3)
          <div class="d-flex justify-content-between align-items-start align-items-sm-center mb-4 flex-column flex-sm-row">
            <div class="left d-flex align-items-center">
              <div class="icon icon-lg shadow mr-3 text-gray"><i class="fas fa-award"></i></div>
              <div class="text">
                <h6 class="mb-0 d-flex align-items-center"> <span>3. {{ $topmenus[2]->name }}.</span><span class="dot dot-sm ml-2 bg-blue"></span></h6><small class="text-gray">Total {{ $topmenus[2]->qty }} {{ $topmenus[2]->qty == 1 ? 'time' : 'times' }}</small>
              </div>
            </div>
            <div class="right ml-5 ml-sm-0 pl-3 pl-sm-0 text-blue">
              <h5>$ {{ $topmenus[2]->unitprice }}</h5>
            </div>
          </div>
          @endif
          @endif

        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="row">
    @foreach ($todayneworders as $torder)
      <div class="col-lg-12"><a href="{{ route('orders.show', $torder->id) }}" class="message card px-5 py-3 mb-4 bg-hover-gradient-primary no-anchor-style">
        <div class="row">
          <div class="col-lg-3 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
            <strong class="h6 mb-0">{{ date('h:i', strtotime($torder->created_at)) }}<sup class="smaller text-gray font-weight-normal">{{ date('A', strtotime($torder->created_at)) }}</sup></strong>
            
            <h6 class="mb-0 ml-3"> R - {{ $torder->room->roomno }}</h6>
          </div>
          <div class="col-lg-9 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
            <div class="bg-gray-100 roundy px-4 py-1 mr-0 mr-lg-3 mt-2 mt-lg-0 text-dark exclode text-capitalize">
              New Order
            </div>
            <p class="mb-0 mt-3 mt-lg-0 font-italic">

              @php $i=0; @endphp
              @foreach ($torder->food as $f)
                @if ($i), @endif{{$f->name}}@php $i++; @endphp
              @endforeach
              
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
      orderarray = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

      @foreach ($linechartorders as $lorder)
        orderarray[{{$lorder->months-1}}] = {{ $lorder->ordercount }}
      @endforeach

      max = Math.max(...orderarray);
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
                    label: "Order Count",
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
                    data: orderarray,
                    spanGaps: false
                }
            ]
        }
      });

      piecategoryarray = [];
      @foreach ($foodcategories as $category)
        piecategoryarray.push({{ $category->food_count }});
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
                @foreach ($foodcategories as $category)
                  "{{ $category->name }}",
                @endforeach
              ],
              datasets: [{
                  data: piecategoryarray,
                  borderWidth: [0, 0],
                  backgroundColor: [
                      green,
                      violet,
                      "#63CCF2",
                      "#F4DA6A",
                      "#eee",
                      "#F36A4A",
                      "#138FE2",
                  ],
                  hoverBackgroundColor: [
                      green,
                      violet,
                      "#63CCF2",
                      "#F4DA6A",
                      "#eee",
                      "#F36A4A",
                      "#138FE2",
                  ]
              }]
          }
      });

      let neworder = {{ $neworders }};
      let doneorder = {{ $todaydoneordercount }};
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
                  "Done",
                  "New Orders"
              ],
              datasets: [{
                  data: [doneorder, neworder],
                  borderWidth: [0, 0],
                  backgroundColor: [
                      green,
                      "#eee"
                  ],
                  hoverBackgroundColor: [
                      green,
                      "#eee"
                  ]
              }]
          }
      });


    }) // end

  </script>

@endsection