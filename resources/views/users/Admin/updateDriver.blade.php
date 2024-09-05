@section('title')
    Admin Update Driver
@endsection

@extends('Users.Admin.layouts.app')

@section('content')
    <!-- Start breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Admin
                        Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin#listDriver') }}">List
                        Driver</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Driver</li>
            </ol>
        </nav>
    </div>

    <!-- END breadcrumb -->

    <!-- Start content -->
    <div id="fh5co-blog-section" class="fh5co-section-gray">

        <div class="container">
            <div class="row row-bottom-padded-md ">
                <div class="flex w-full p-4 justify-center items-center">
                    <div class="bg-white p-7 shadow-md rounded" id="form">
                        <form class="flex flex-col items-center justify-center"
                            action="{{ route('admin#updateDriver', $editDriver->id) }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="col-lg-6 animate-box my-2">
                                <h1 class="animate-box text-3xl font-bold text-center">
                                    Update Driver
                                </h1>
                            </div>
                            <div class="col-lg-6" style="padding-left: 60px">
                                <div class="row">
                                    @csrf
                                    <div class="mb-3">
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Driver Id</label>
                                            <input type="text" readonly class="form-control"
                                                placeholder="Put your menu title here" name="id"
                                                value="{{ old('id', $editDriver->id) }}">
                                        </div>
                                    </div>

                                    <div class="">
                                        @if ($editDriver->driver_license)
                                            <img src="{{ asset('uploads/driver/' . $editDriver->driver_license) }}"
                                                class="img-thumbnail" alt="category image" width="500px">
                                            <br>
                                        @endif
                                        <div>
                                            <div class="form-group animate-box">
                                                <label for="basic-url">Driver License</label>
                                                <input type="file" title="Hallo" id="image" class="form-control"
                                                    name="driver_license" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mt-4 form-group animate-box">
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
