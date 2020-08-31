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
            <h6 class="mb-0">Data consumed</h6><span class="text-gray">145,14 GB</span>
          </div>
        </div>
        <div class="icon text-white bg-violet"><i class="fas fa-server"></i></div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
      <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-green"></div>
          <div class="text">
            <h6 class="mb-0">Open cases</h6><span class="text-gray">32</span>
          </div>
        </div>
        <div class="icon text-white bg-green"><i class="far fa-clipboard"></i></div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
      <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-blue"></div>
          <div class="text">
            <h6 class="mb-0">Work orders</h6><span class="text-gray">400</span>
          </div>
        </div>
        <div class="icon text-white bg-blue"><i class="fa fa-dolly-flatbed"></i></div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
      <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-red"></div>
          <div class="text">
            <h6 class="mb-0">New invoices</h6><span class="text-gray">123</span>
          </div>
        </div>
        <div class="icon text-white bg-red"><i class="fas fa-receipt"></i></div>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="row mb-4">
    <div class="col-lg-7 mb-4 mb-lg-0">
      <div class="card">
        <div class="card-header">
          <h2 class="h6 text-uppercase mb-0">Current server uptime</h2>
        </div>
        <div class="card-body">
          <p class="text-gray">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
          <div class="chart-holder">
            <canvas id="lineChart1" style="max-height: 14rem !important;" class="w-100"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-5 mb-4 mb-lg-0 pl-lg-0">
      <div class="card mb-3">
        <div class="card-body">
          <div class="row align-items-center flex-row">
            <div class="col-lg-5">
              <h2 class="mb-0 d-flex align-items-center"><span>86.4</span><span class="dot bg-green d-inline-block ml-3"></span></h2><span class="text-muted text-uppercase small">Work hours</span>
              <hr><small class="text-muted">Lorem ipsum dolor sit</small>
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
              <h2 class="mb-0 d-flex align-items-center"><span>1.724</span><span class="dot bg-violet d-inline-block ml-3"></span></h2><span class="text-muted text-uppercase small">Server time</span>
              <hr><small class="text-muted">Lorem ipsum dolor sit</small>
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
      <div class="card mb-3">
        <div class="card-body">
          <div class="row align-items-center mb-3 flex-row">
            <div class="col-lg-5">
              <h2 class="mb-0 d-flex align-items-center"><span>86%</span><span class="dot bg-violet d-inline-block ml-3"></span></h2><span class="text-muted text-uppercase small">Monthly Usage</span>
              <hr><small class="text-muted">Lorem ipsum dolor sit</small>
            </div>
            <div class="col-lg-7">
              <canvas id="pieChartHome3"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="row align-items-center flex-row">
            <div class="col-lg-5">
              <h2 class="mb-0 d-flex align-items-center"><span>$126,41</span><span class="dot bg-green d-inline-block ml-3"></span></h2><span class="text-muted text-uppercase small">All Income</span>
              <hr><small class="text-muted">Lorem ipsum dolor sit</small>
            </div>
            <div class="col-lg-7">
              <canvas id="pieChartHome4"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-7">
      <div class="card">
        <div class="card-header">
          <h2 class="h6 text-uppercase mb-0">Total Overdue</h2>
        </div>
        <div class="card-body">
          <p class="text-gray">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
          <div class="chart-holder">
            <canvas id="lineChart2" style="max-height: 14rem !important;" class="w-100"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="py-5">
  <div class="row text-dark">
    <div class="col-lg-4 mb-4 mb-lg-0">
      <div class="card rounded credit-card bg-hover-gradient-violet">
        <div class="content d-flex flex-column justify-content-between p-4">
          <h1 class="mb-5"><i class="fab fa-cc-visa"></i></h1>
          <div class="d-flex justify-content-between align-items-end pt-3">
            <div class="text-uppercase">
              <div class="font-weight-bold d-block">Card Number</div><small class="text-gray">1245 1478 1362 6985</small>
            </div>
            <h4 class="mb-0">$417.78</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mb-4 mb-lg-0">
      <div class="card rounded credit-card bg-hover-gradient-blue">
        <div class="content d-flex flex-column justify-content-between p-4">
          <h1 class="mb-5"><i class="fab fa-cc-mastercard"></i></h1>
          <div class="d-flex justify-content-between align-items-end pt-3">
            <div class="text-uppercase">
              <div class="font-weight-bold d-block">Card Number</div><small class="text-gray">1245 1478 1362 6985</small>
            </div>
            <h4 class="mb-0">$124.17</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mb-4 mb-lg-0">
      <div class="card rounded credit-card bg-hover-gradient-green">
        <div class="content d-flex flex-column justify-content-between p-4">
          <h1 class="mb-5"><i class="fab fa-cc-discover"></i></h1>
          <div class="d-flex justify-content-between align-items-end pt-3">
            <div class="text-uppercase">
              <div class="font-weight-bold d-block">Card Number</div><small class="text-gray">1245 1478 1362 6985</small>
            </div>
            <h4 class="mb-0">$568.00</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="row">
    <div class="col-lg-8">
      <div class="card mb-5 mb-lg-0">         
        <div class="card-header">
          <h2 class="h6 mb-0 text-uppercase">Transaction history</h2>
        </div>
        <div class="card-body">
          <p class="text-gray mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
          <div class="d-flex justify-content-between align-items-start align-items-sm-center mb-4 flex-column flex-sm-row">
            <div class="left d-flex align-items-center">
              <div class="icon icon-lg shadow mr-3 text-gray"><i class="fab fa-dropbox"></i></div>
              <div class="text">
                <h6 class="mb-0 d-flex align-items-center"> <span>Dropbox Inc.</span><span class="dot dot-sm ml-2 bg-violet"></span></h6><small class="text-gray">Account renewal</small>
              </div>
            </div>
            <div class="right ml-5 ml-sm-0 pl-3 pl-sm-0 text-violet">
              <h5>-$20</h5>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-start align-items-sm-center mb-4 flex-column flex-sm-row">
            <div class="left d-flex align-items-center">
              <div class="icon icon-lg shadow mr-3 text-gray"><i class="fab fa-apple"></i></div>
              <div class="text">
                <h6 class="mb-0 d-flex align-items-center"> <span>App Store.</span><span class="dot dot-sm ml-2 bg-green"></span></h6><small class="text-gray">Software cost</small>
              </div>
            </div>
            <div class="right ml-5 ml-sm-0 pl-3 pl-sm-0 text-green">
              <h5>-$20</h5>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-start align-items-sm-center mb-4 flex-column flex-sm-row">
            <div class="left d-flex align-items-center">
              <div class="icon icon-lg shadow mr-3 text-gray"><i class="fas fa-shopping-basket"></i></div>
              <div class="text">
                <h6 class="mb-0 d-flex align-items-center"> <span>Supermarket.</span><span class="dot dot-sm ml-2 bg-blue"></span></h6><small class="text-gray">Shopping</small>
              </div>
            </div>
            <div class="right ml-5 ml-sm-0 pl-3 pl-sm-0 text-blue">
              <h5>-$20</h5>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-start align-items-sm-center mb-4 flex-column flex-sm-row">
            <div class="left d-flex align-items-center">
              <div class="icon icon-lg shadow mr-3 text-gray"><i class="fab fa-android"></i></div>
              <div class="text">
                <h6 class="mb-0 d-flex align-items-center"> <span>Play Store.</span><span class="dot dot-sm ml-2 bg-red"></span></h6><small class="text-gray">Software cost</small>
              </div>
            </div>
            <div class="right ml-5 ml-sm-0 pl-3 pl-sm-0 text-red">
              <h5>-$20</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="bg-white shadow roundy px-4 py-3 d-flex align-items-center justify-content-between mb-4">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-violet"></div>
          <div class="text">
            <h6 class="mb-0">Completed cases</h6><span class="text-gray">127 new cases</span>
          </div>
        </div>
        <div class="icon bg-violet text-white"><i class="fas fa-clipboard-check"></i></div>
      </div>
      <div class="bg-white shadow roundy px-4 py-3 d-flex align-items-center justify-content-between mb-4">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-green"></div>
          <div class="text">
            <h6 class="mb-0">New Quotes</h6><span class="text-gray">214 new quotes</span>
          </div>
        </div>
        <div class="icon bg-green text-white"><i class="fas fa-dollar-sign"></i></div>
      </div>
      <div class="bg-white shadow roundy px-4 py-3 d-flex align-items-center justify-content-between mb-4">
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="dot mr-3 bg-blue"></div>
          <div class="text">
            <h6 class="mb-0">New clients</h6><span class="text-gray">25 new clients</span>
          </div>
        </div>
        <div class="icon bg-blue text-white"><i class="fas fa-user-friends"></i></div>
      </div>
      <div class="card px-5 py-4">
        <h2 class="mb-0 d-flex align-items-center"><span>86.4</span><span class="dot bg-red d-inline-block ml-3"></span></h2><span class="text-muted">Server time</span>
        <div class="chart-holder">
          <canvas id="lineChart3" style="max-height: 7rem !important;" class="w-100">      </canvas>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="py-5">
  <div class="row">
    <div class="col-lg-12"><a href="#" class="message card px-5 py-3 mb-4 bg-hover-gradient-primary no-anchor-style">
      <div class="row">
        <div class="col-lg-3 d-flex align-items-center flex-column flex-lg-row text-center text-md-left"><strong class="h5 mb-0">24<sup class="smaller text-gray font-weight-normal">Apr</sup></strong><img src="{{ asset('backend/img/avatar-1.jpg') }}" alt="..." style="max-width: 3rem" class="rounded-circle mx-3 my-2 my-lg-0">
          <h6 class="mb-0">Jason Maxwell</h6>
        </div>
        <div class="col-lg-9 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
          <div class="bg-gray-100 roundy px-4 py-1 mr-0 mr-lg-3 mt-2 mt-lg-0 text-dark exclode">User testing</div>
          <p class="mb-0 mt-3 mt-lg-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
        </div>
      </div></a></div>
      <div class="col-lg-12"><a href="#" class="message card px-5 py-3 mb-4 bg-hover-gradient-primary no-anchor-style">
        <div class="row">
          <div class="col-lg-3 d-flex align-items-center flex-column flex-lg-row text-center text-md-left"><strong class="h5 mb-0">24<sup class="smaller text-gray font-weight-normal">Nov</sup></strong><img src="{{ asset('backend/img/avatar-2.jpg') }}" alt="..." style="max-width: 3rem" class="rounded-circle mx-3 my-2 my-lg-0">
            <h6 class="mb-0">Sam Andy</h6>
          </div>
          <div class="col-lg-9 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
            <div class="bg-gray-100 roundy px-4 py-1 mr-0 mr-lg-3 mt-2 mt-lg-0 text-dark exclode">Web Developer</div>
            <p class="mb-0 mt-3 mt-lg-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
          </div>
        </div></a></div>
        <div class="col-lg-12"><a href="#" class="message card px-5 py-3 mb-4 bg-hover-gradient-primary no-anchor-style">
          <div class="row">
            <div class="col-lg-3 d-flex align-items-center flex-column flex-lg-row text-center text-md-left"><strong class="h5 mb-0">17<sup class="smaller text-gray font-weight-normal">Aug</sup></strong><img src="{{ asset('backend/img/avatar-3.jpg') }}" alt="..." style="max-width: 3rem" class="rounded-circle mx-3 my-2 my-lg-0">
              <h6 class="mb-0">Margret Peter</h6>
            </div>
            <div class="col-lg-9 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
              <div class="bg-gray-100 roundy px-4 py-1 mr-0 mr-lg-3 mt-2 mt-lg-0 text-dark exclode">Analysis Agent</div>
              <p class="mb-0 mt-3 mt-lg-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
            </div>
          </div></a></div>
          <div class="col-lg-12"><a href="#" class="message card px-5 py-3 mb-4 bg-hover-gradient-primary no-anchor-style">
            <div class="row">
              <div class="col-lg-3 d-flex align-items-center flex-column flex-lg-row text-center text-md-left"><strong class="h5 mb-0">15<sup class="smaller text-gray font-weight-normal">Sep</sup></strong><img src="{{ asset('backend/img/avatar-4.jpg') }}" alt="..." style="max-width: 3rem" class="rounded-circle mx-3 my-2 my-lg-0">
                <h6 class="mb-0">Jason Doe</h6>
              </div>
              <div class="col-lg-9 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                <div class="bg-gray-100 roundy px-4 py-1 mr-0 mr-lg-3 mt-2 mt-lg-0 text-dark exclode">User testing</div>
                <p class="mb-0 mt-3 mt-lg-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
              </div>
            </div></a></div>
          </div>
        </section>

  @endsection