@section('title')
    Update Driver
@endsection

@extends('users.Driver.layouts.app')

@section('content')
    <div class="container w-300 sm:w-600 md:w-[700px] border mt-5 py-5 mb-5 shadow-lg bg-white rounded">
        <div class="p-3 py-5">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="d-flex flex-row align-items-center back"><i class="fa fa-long-arrow-left "></i>
                    <a href="{{ route('driver#driverProfile') }}">Back to home</a>
                </div>
                <h6 class="text-right">Edit Profile</h6>
            </div>
            <form action="{{ route('driver#updateDriver') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                    <div class="w-full ">
                        <label for="fname">Driver Name:</label>
                        <input type="text" class="form-control" placeholder="first name"
                            value="{{ old('name', $driverData->users->name) }}" name="name">
                    </div>
                    <div class="">
                        <label for="fname">Address:</label>
                        <input type="text" class="form-control" value="{{ old('address', $driverData->users->address) }}"
                            name="address">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                    <div class="">
                        <label for="fname">Email :</label>
                        <input type="text" readonly class="form-control" value="{{ old('email', $driverData->users->email) }}"
                            name="email">
                    </div>
                    <div class="">
                        <label for="fname">Role :</label>
                        <input type="text" readonly class="form-control" value="{{ old('role', $driverData->users->role) }}"
                            name="role">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                    <div class="">
                        <label for="fname">Driver Phone Number:</label>
                        <input type="tel" maxlength="11" class="form-control" value="{{ old('phone', $driverData->users->phone) }}"
                            name="phone">
                    </div>
                    <div class="">
                        <label for="fname">Driver License:</label>
                        <input type="file" class="form-control" name="driver_license" value="">
                    </div>
                </div>
                <div class="mt-5 text-right"><button class="btn btn-warning btn-lg px-4 me-md-2"
                        type="submit">Update</button></div>
            </form>
        </div>
    </div>
@endsection
