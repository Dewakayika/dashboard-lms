
@extends('users.Admin.layouts.auth')

@section('content')


<div class="col-12 mx-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Home</a></li>
            <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
            <li class="breadcrumb-item active text-xs" aria-current="page">{{$adminData->name}}'s Profile</li>
        </ol>
    </nav>
</div>


  <div class="main-content position-relative bg-gray-100 ">
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="{{asset('images/profile/admin_profile.png')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                {{$adminData->name}}
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                {{$adminData->email}}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="container-fluid py-4">
      <div class="row">

      </div>
    </div>
  </div>

@endsection

