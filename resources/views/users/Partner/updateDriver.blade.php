@section('title')
    Partner Update Meal
@endsection

@extends('Users.Partner.layouts.app')

@section('content')
    <!-- Start breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('partner#index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('partner#index') }}">Partner Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Driver</li>
        </ol>
    </nav>

    <!-- END breadcrumb -->

    <!-- Start content -->
    <div id="fh5co-blog-section" class="fh5co-section-gray">

        <div class="container">
            <div class="row row-bottom-padded-md ">
                <div class="container">
                    <div class="row">
                        <form class="flex flex-col items-center justify-center"
                            action="{{ route('partner#updateDriver', $editDriver->id) }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="col-lg-6 animate-box my-2">
                                <h1 class="animate-box text-3xl font-bold text-center">
                                    Update Driver
                                </h1>
                            </div>
                            <div class="col-lg-6" style="padding-left: 60px">
                                <div class="row">
                                    @csrf
                                    <div class="mt-3">
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Driver Name</label>
                                            <input type="text" class="form-control"
                                                placeholder="Put your menu title here" name="driver_name"
                                                value="{{ old('driver_name', $editDriver->driver_name) }}">
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="driver_gender"
                                                id="inlineRadio1" value="0" required=""
                                                @if ($editDriver->gender == 0) @return checked @endif>
                                            <label class="form-check-label" for="inlineRadio1"
                                                name="driver_gender">Male</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="driver_gender"
                                                id="inlineRadio2" value="1" required=""
                                                @if ($editDriver->gender == 1) @return checked @endif>
                                            <label class="form-check-label" for="inlineRadio2"
                                                name="driver_gender">Female</label>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Driver Email</label>
                                            <input type="email" class="form-control"
                                                placeholder="Put your menu time availability here" name="driver_email"
                                                value="{{ old('driver_email', $editDriver->driver_email) }}">
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        @if ($editDriver->driver_license)
                                            <img src="{{ asset('uploads/driver/' . $editDriver->driver_license) }}"
                                                class="img-thumbnail" alt="category image" width="300px">
                                            <br>
                                        @endif
                                        <div class="-mt-6">
                                            <div class="form-group animate-box">
                                                <label for="basic-url">Driver License</label>
                                                <input type="file" class="form-control" name="driver_license"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Driver Phone</label>
                                            <input type="tel" class="form-control"
                                                placeholder="Put your menu time availability here" name="driver_phone"
                                                value="{{ old('driver_phone', $editDriver->driver_phone) }}">
                                        </div>
                                    </div>
                                    <div>
                                        <input type="hidden" class="form-control" placeholder="Put your partner name here"
                                            name="partner" value="{{ $partnerData->id }}" required>
                                    </div>
                                    <div class="mt-3">
                                        <div class="form-group animate-box">
                                            <input type="submit" value="Update"
                                                class="bg-blue-500 py-2 px-3 rounded-md text-white text-lg hover:bg-blue-700">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End content-->
@endsection
