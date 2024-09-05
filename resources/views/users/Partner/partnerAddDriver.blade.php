@section('title')
    Partner Create Driver
@endsection

@extends('Users.Partner.layouts.app')

@section('content')
    <!-- Start breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('partner#index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('partner#index') }}">Partner Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Driver</li>
            </ol>
        </nav>
    </div>

    <!-- END breadcrumb -->

    <!-- Start content -->
    <div id="fh5co-blog-section" class="fh5co-section-gray">

        <div class="container h-screen">
            <div class="row row-bottom-padded-md ">
                <div class="container">
                    <div class="row">
                        <form class="flex flex-col items-center justify-center" action="{{ route('partner#saveDriver') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-6 animate-box my-2">
                                <h1 class="animate-box text-3xl font-bold text-center">
                                    Add Your Own Driver
                                </h1>
                                <x-jet-validation-errors class="my-2 text-1xl font-semibold text-center text-mow-red" />
                            </div>
                            <div class="col-lg-6" style="padding-left: 60px">
                                <div class="row">
                                    <div>
                                        <div class="form-group animate-box my-1">
                                            <label for="basic-url">Driver Name:</label>
                                            <input type="text" class="form-control"
                                                placeholder="Put your driver name here" name="driver_name" required>
                                        </div>
                                    </div>
                                    <fieldset class="row flex flex-col mb-1">
                                        <legend class="col-form-label -mb-2 col-sm-4">Gender:</legend>
                                        <div class="col-sm-8">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="driver_gender"
                                                    id="inlineRadio1" value="0" required>
                                                <label class="form-check-label" for="inlineRadio1"
                                                    name="gender">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="driver_gender"
                                                    id="inlineRadio2" value="1" required>
                                                <label class="form-check-label" for="inlineRadio2"
                                                    name="gender">Female</label>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div>
                                        <div class="form-group animate-box my-1">
                                            <label for="basic-url">Driver Email:</label>
                                            <input type="text" class="form-control"
                                                placeholder="Put your Driver Email here" name="driver_email" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group animate-box my-1">
                                            <label for="basic-url">Driver Phone:</label>
                                            <input class="form-control" maxlength="11" type="tel"
                                                placeholder="Put your driver phone here" name="driver_phone" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group animate-box my-1">
                                            <label for="basic-url">Driver License:</label>
                                            <input type="file" class="form-control" name="driver_license" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mt-4 form-group animate-box">
                                            <input type="submit" value="Create"
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
