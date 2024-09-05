@section('title')
    Partner Profile
@endsection

@extends('users.Volunteer.layouts.app')

@section('content')
    <style type="text/css">
        #volunteer {
            max-width: 600px;
            padding: 20px;
            margin: 50px auto;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
    </style>
    <!-- Start content -->
    <section class="h-100 gradient-custom-2">
        <div class="container h-100 ">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card shadow  mb-5 bg-white rounded">
                        <div class="rounded-top text-white d-flex flex-row" style="background-color: #fcc404; height:200px;">
                            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                                <img src="https://cdn.discordapp.com/attachments/1018894859832148009/1032512821839269938/Untitled_design.png"
                                    alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                                    style="width: 150px; z-index: 1">
                                <a href="{{ route('volunteer#editProfile') }}" type="button" class="btn btn-warning"
                                    style="z-index: 1;">Edit profile</a>
                            </div>
                            <div class="ms-3 " style="margin-top: 130px;">
                                <div class="font-weight-bold" style="font-weight: 700">
                                    <h1>{{ $userData->users->name }}</h1>
                                </div>
                                <p style="font-size: small">{{ $userData->users->address }}</p>
                            </div>
                        </div>
                        <div class="p-4 text-black" style="background-color: #f8f9fa;">
                            <div class="d-flex justify-content-end text-center py-1">
                                <div>
                                    <p class="mb-1 h5"></p>
                                    <p class="small text-muted mb-0"><i class="fa fa-phone"
                                            aria-hidden="true"></i>&nbsp;{{ $userData->users->phone }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4 text-black">
                            <div class="mb-5">
                                <p class="lead fw-normal mb-1"><i class="fa fa-address-card-o" aria-hidden="true"></i>
                                    &nbsp; Profile Information</p>
                                <div class="p-4" style="background-color: #f8f9fa;">
                                    <p class="font-italic mb-1"><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp;
                                        {{ $userData->users->email }}</p>
                                    <p class="font-italic mb-1"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;
                                        {{ $userData->users->phone }}</p>
                                    <p class="font-italic mb-1"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;
                                        {{ $userData->users->address }}</p>

                                    @if ($userData->users->gender == 1)
                                        <p class="font-italic mb-1"><i class="fa-solid fa-venus"></i>&nbsp; Female</p>
                                    @else
                                        <p class="font-italic mb-1"><i class="fa-solid fa-mars"></i>&nbsp; Male</p>
                                    @endif
                                    <p class="font-italic mb-0"><i class="fa fa-address-book"
                                            aria-hidden="true"></i></i>&nbsp; {{ $userData->users->role }}</p>
                                </div>
                            </div>

                            <div class="mb-5">
                                <p class="lead fw-normal mb-1"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;
                                    Volunteer Information</p>
                                <div class="p-4" style="background-color: #f8f9fa;">
                                    <p class="font-italic mb-1"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;
                                        {{ $userData->volunteer_time }}</p>
                                    <p class="font-italic mb-1"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
                                        {{ $userData->volunteer_available }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
