@extends('frontendtemplate')

@section('title', 'Hotel Riza - Profile')

@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendor/jquery-nice-select/nice-select.css') }}">
	<style type="text/css">
		body {
	    background: #201D18;
		}
    .nice-select .list, .nice-select {
      border-radius: 0 !important;
    }
    .nice-select .list {
      box-shadow: 0 0 0 1px rgba(68, 68, 68, 0.1);
    }
    .nice-select:active, .nice-select.open, .nice-select:focus {
      border-color: #cda45e !important;
    }
    .cropit-preview {
      background-color: #fff;
      background-size: cover;
      border: 1px solid #ccc;
      border-radius: 3px;
      margin-top: 7px;
      width: 160px;
      height: 160px;
      margin: 0 auto 1rem;
    }

    .cropit-preview-image-container {
      cursor: move;
    }

    .cropit-image-input {
      display: block;
      width: 160px;
      margin: 1rem auto 1rem;
    }
	</style>
@endsection

@section('content')

	<main id="main">
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
        	<h2></h2>
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>Profile</li>
          </ol>
        </div>

      </div>
    </section>

    <section class="inner-page profile">
      <div class="container">

        <form method="post" action="{{ route('guests.update', Auth::id()) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-lg-3 pr-lg-0 mb-5">
              
              <div class="profile-card p-4 text-center">
                <div class="div-profile" @if ($errors->any()) style="display: none;" @endif>
                  <img src="{{ asset($guest->profilepicture) }}" class="img-fluid border rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">

                  <h6 class="text-theme mt-3 font-weight-bold">{{ $guest->user->name }}</h6>
                  <p class="text-muted">
                    <small><i class="icofont-location-pin"></i> {{ $guest->city }}, {{ $guest->country }}</small>
                  </p>
                  <p>
                    <small>
                      <a href="" class="font-italic" id="btn-edit" onclick="return false;">Edit Profile</a>
                    </small>
                  </p>
                </div>

                <div class="div-edit" @if (!$errors->any()) style="display: none;" @endif>
                  <input type="hidden" name="profilestatus" value="old" id="profilestatus">
                  <input type="hidden" name="oldprofile" value="{{ $guest->profilepicture }}">

                  <div class="image-editor text-center">
                    <div class="cropit-preview"></div>
                    <button class="btn btn-outline-secondary btn-sm btn-change" type="button">Change New</button>
                    <div id="div-new" style="display: none;">
                      <input type="file" class="cropit-image-input" name="newprofile" id="newprofile" style="overflow-x: hidden;">
                      <button class="btn btn-outline-secondary btn-sm btn-imagecancel" type="button">Cancel</button>
                    </div>
                  </div>

                </div>
              </div>

            </div>
            <div class="col-lg-9 pl-lg-5 mb-5">
              
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active px-5" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Personal Info</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link px-5" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Member Info</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active p-3 tab-personalinfo" id="home" role="tabpanel" aria-labelledby="home-tab">

                  <div class="div-profile" @if ($errors->any()) style="display: none;" @endif>
                    <div class="form-row">
                      <label class="col-3 font-weight-medium">Name: </label>
                      <label class="col-9">{{ $guest->user->name }} </label>
                    </div>

                    <div class="form-row">
                      <label class="col-3 font-weight-medium">Email: </label>
                      <label class="col-9">{{ $guest->user->email }} </label>
                    </div>

                    <div class="form-row">
                      <label class="col-3 font-weight-medium">Phone: </label>
                      <label class="col-9">{{ $guest->phone1 }}{{ $guest->phone2 ? ', '.$guest->phone2 : '' }} </label>
                    </div>

                    <div class="form-row">
                      <label class="col-3 font-weight-medium">From: </label>
                      <label class="col-9">{{ $guest->city }}, {{ $guest->country }} </label>
                    </div>

                    <div class="form-row">
                      <label class="col-3 font-weight-medium">First Joined: </label>
                      <label class="col-9">{{ $guest->user->created_at->format('d M, Y') }} </label>
                    </div>
                  </div>
                  
                  <div class="div-edit" @if (!$errors->any()) style="display: none;" @endif>
                      
                    <div class="form-row">
                      <label class="col-md-3 font-weight-medium col-form-label" for="name">Name: </label>
                      <div class="col-md-9">
                        <input type="text" name="name" id="name" value="{{ old('name', $guest->user->name) }}" placeholder="Enter Full Name">
                        @error('name')
                          <div class="error-message text-danger pl-1 mt-1">
                            <small>{{ $message }}</small>
                          </div>
                        @enderror
                      </div>
                    </div>

                    <div class="form-row">
                      <label class="col-md-3 font-weight-medium col-form-label" for="email">Email: </label>
                      <div class="col-md-9">
                        <input type="email" name="email" id="email" value="{{ old('email',$guest->user->email) }}" placeholder="Enter Email Address">
                        @error('email')
                          <div class="error-message text-danger pl-1 mt-1">
                            <small>{{ $message }}</small>
                          </div>
                        @enderror
                      </div>
                    </div>

                    <div class="form-row">
                      <label class="col-md-3 font-weight-medium col-form-label" for="phone1">Phone: </label>
                      <div class="col-md-9">
                        <input type="text" name="phone1" id="phone1" value="{{ old('phone1',$guest->phone1) }}" placeholder="Enter Phone no.">
                        @error('phone1')
                          <div class="error-message text-danger pl-1 mt-1">
                            <small>{{ $message }}</small>
                          </div>
                        @enderror
                      </div>
                    </div>

                    <div class="form-row">
                      <label class="col-md-3 font-weight-medium col-form-label" for="phone2">Optional Phone: </label>
                      <div class="col-md-9">
                        <input type="text" name="phone2" id="phone2" value="{{ old('phone2',$guest->phone2) }}" placeholder="Enter Optional Phone no.">
                      </div>
                    </div>

                    <div class="form-row">
                      <label class="col-md-3 font-weight-medium col-form-label" for="city">From: </label>
                      <div class="col-6 col-md-4">
                        <input type="text" name="city" id="city" value="{{ old('city',$guest->city) }}" placeholder="Enter City">
                      </div>
                      <div class="col-6 col-md-5">
                        <select class="nice-select wide select" name="country" id="country">
                          <option value="0" disabled>Select Country</option>
                          @foreach ($countries as $country)
                            <option value="{{ $country->name }}" @if($guest->country == $country->name) selected @endif >{{ $country->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col-6 offset-md-3 col-md-4">
                        <button type="submit" class="btn-update">Update</button>
                      </div>
                      <div class="col-6 col-md-4">
                        <button type="button" class="btn-cancel">Cancel</button>
                      </div>
                    </div>
                      
                  </div>

                </div>

                <div class="tab-pane fade p-3 tab-memberinfo" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                @if($guest->membertype_id)
                  
                  <div class="form-row">
                    <label class="col-4 col-md-3 font-weight-medium">Member ID: </label>
                    <label class="col-8 col-md-9">M-{{ $guest->member_id }} </label>
                  </div>

                  <div class="form-row">
                    <label class="col-4 col-md-3 font-weight-medium">Start Date: </label>
                    <label class="col-8 col-md-9">{{ date('d M, Y', strtotime($guest->memberstartdate)) }} </label>
                  </div>

                  <div class="form-row">
                    <label class="col-4 col-md-3 font-weight-medium">Current Points: </label>
                    <label class="col-8 col-md-9 font-weight-bold text-theme">{{ $guest->points }} </label>
                  </div>

                  <div class="form-row">
                    <label class="col-4 col-md-3 font-weight-medium">Member Type: </label>
                    <label class="col-8 col-md-9 font-weight-bold text-theme">{{ $guest->membertype->name }}</label>
                  </div>

                  <div class="form-row">
                    <label class="col-lg-3 font-weight-medium progress-status">Percentage: </label>
                    <div class="col-lg-9">

                      <div class="progress theme">
                        @php
                          $percentage = ($totalnight+$totalstay) / ($nextlevel->numberofnights+$nextlevel->numberofstays)  * 100;
                        @endphp
                        <div class="progress-bar" style="width: {{ number_format($percentage, 1) }}%;">
                          <p class="progress-title">To {{ $nextlevel->name }}</p>
                          <div class="progress-value">
                            @if ($totalstay)
                              {{ $totalnight }} {{ $totalnight == 1 ? ' night' : ' nights' }}, {{ $totalstay }} {{ $totalstay == 1 ? ' stay' : ' stays' }}
                            @else
                              0
                            @endif   
                          </div>
                        </div>
                      </div>
                      @php
                        $requirednight = $nextlevel->numberofnights - $totalnight;
                        $requiredstay = $nextlevel->numberofstays - $totalstay;
                      @endphp
                      <p class="text-muted font-italic text-right"><small>{{ $requirednight }} {{ $requirednight == 1 ? ' night' : ' nights' }} & {{ $requiredstay }} {{ $requiredstay == 1 ? ' stay' : ' stays' }} More...</small></p>

                    </div>
                  </div>

                @else 
                  <p>Not a Member Yet.</p>
                @endif

                  <div class="form-row">
                    <label class="col-lg-3 font-weight-medium pt-3">Total: </label>
                    <div class="col-4 col-lg-3 one-third p-3">
                      <p class="one-third-title">Total Nights</p>
                      <p class="one-third-value">{{ $totalnight }}</p>
                    </div>
                    <div class="col-4 col-lg-3 one-third p-3">
                      <p class="one-third-title">Total Stays</p>
                      <p class="one-third-value">{{ $totalstay }}</p>
                    </div>
                    <div class="col-4 col-lg-3 one-third p-3">
                      <p class="one-third-title">Amount</p>
                      <p class="one-third-value">$ {{ number_format($totalamount, 2) }}</p>
                    </div>
                  </div>

                </div>
              </div>

            </div>
          </div>

        </form>
      </div>
    </section>
 </main><!-- End #main -->

@endsection

@section('script')
  <script type="text/javascript" src="{{ asset('backend/vendor/cropit/dist/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backend/vendor/jquery-nice-select/jquery.nice-select.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backend/vendor/cropit/dist/jquery.cropit.js') }}"></script>
  <script type="text/javascript">
    $(function () {
      $('.select').niceSelect();
      
      $('#btn-edit').click(function() {
        $('.div-profile').hide();
        $('.div-edit').show('400');
      });

      $('.btn-cancel').click(function() {
        $('.div-edit').hide();
        $('.div-profile').show('400');
      });

      $('.image-editor').cropit({
        imageState: {
          src: '{{ asset($guest->profilepicture) }}',
        },
      });

      $('.btn-change').click(function() {
        $(this).hide();
        $('#div-new').show();
        $('#profilestatus').val('new');
        $('.btn-imagecancel').show();
      });

      $('.btn-imagecancel').click(function() {
        $(this).hide();
        $('#div-new').hide();
        $('.btn-change').show();
        $('.image-editor').cropit('imageSrc', '{{ asset($guest->profilepicture) }}');
        $('#profilestatus').val('old');
        $('#newprofile').val('');
      });

    })
  </script>

  {{-- @include('sweetalert::alert') --}}
@endsection
