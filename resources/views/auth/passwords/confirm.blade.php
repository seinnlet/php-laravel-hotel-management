@extends('backendtemplate')

@section('title', 'Confirm Password')

@section('content')
<section class="py-5">
  <div class="mb-4">
    <h5 class="title-heading">Confirm Password</h5>
  </div>

  <div class="card">
    <div class="card-header">
      <h3 class="h6 mb-0">Password Security</h3>
    </div>
    <div class="card-body">

      <form class="form-horizontal" method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="form-group row mb-4">
          <label class="col-md-3 col-form-label" for="password">Password: <sup class="text-danger">*</sup></label>
          <div class="col-md-9">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Please confirm your password before continuing." autofocus>

            @error('password')
              <span class="invalid-feedback" role="alert">
                {{ $message }}
              </span>
            @enderror
          </div>
        </div>

        <div class="form-group row mt-5">
          <div class="col-md-9 ml-auto">
            <button type="submit" class="btn btn-primary">Confirm Password</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</section>
@endsection
