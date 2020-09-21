@extends('backendtemplate')

@section('title', 'Detail Roomtype')

@section('css')
<style type="text/css">	
	@media (max-width: 768px) {
	  .div-profilepicture {
	  	text-align: center;
		}
		.div-profilepicture img {
			width: 40%;
		}
	}
</style>
@endsection

@section('content')
	<section class="py-5">
		<div class="mb-4">
			<h5 class="title-heading d-inline-block float-left">{{ $user->name }}</h5>
			<a href="{{ route('staff.edit', $user->id) }}" class="btn btn-primary float-right rounded"><i class="fas fa-pen fa-sm mr-2 text-gray-100"></i> Edit</a>
			<div class="clearfix"></div>
		</div>

		{{-- form --}}
		<div class="card">
      <div class="card-header">
        <h3 class="h6 mb-0">My Profile</h3>
      </div>
      <div class="card-body">
      	<div class="row">
      		<div class="col-md-3 pl-md-3 pr-md-4 pr-lg-5 div-profilepicture mb-5">
      			<img src="{{ asset($user->staff->profilepicture) }}" alt="StaffProfile" class="img-fluid rounded-circle shadow-sm">
      		</div>
      		<div class="col-md-9">
      			<table class="table table-borderless" style="font-size: .85rem;">
      				<tr>
      					<td class="font-weight-medium">Name : </td>
      					<td>{{ $user->name }}</td>
      				</tr>
      				<tr>
      					<td class="font-weight-medium">Email : </td>
      					<td>{{ $user->email }}</td>
      				</tr>
      				<tr>
      					<td class="font-weight-medium">Role : </td>
      					<td>{{ $user->getRoleNames()->first() }}</td>
      				</tr>
      				<tr>
      					<td class="font-weight-medium">Phone No. : </td>
      					<td>{{ $user->staff->phone }}</td>
      				</tr>
      				<tr>
      					<td class="font-weight-medium">Gender : </td>
      					<td>{{ $user->staff->gender }}</td>
      				</tr>
      				<tr>
      					<td class="font-weight-medium">Address : </td>
      					<td>{{ $user->staff->address }}</td>
      				</tr>
      			</table>
      		</div>
      	</div>
      </div>
    </div>

  </section>

@endsection