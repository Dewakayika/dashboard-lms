@section('title')
    List Driver Admin
@endsection

@extends('Users.Admin.layouts.app')

@section('content')
    <!-- Start breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Driver</li>
            </ol>
        </nav>
    </div>

    <!-- END breadcrumb -->

    <!-- Start content -->
    <div class="container">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-center">
                Driver List
            </h1>
        </div>
        @if (Session::has('driverCreated'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('driverCreated') }}
            </div>
        @endif
        @if (Session::has('driverDeleted'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('driverDeleted') }}
            </div>
        @endif
        @if (Session::has('driverUpdated'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('driverUpdated') }}
            </div>
        @endif
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>Driver Id</th>
                    <th>User Id</th>
                    <th>Driver License</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($driverData as $driver)
                    <tr>
                        <td>{{ ($driverData->currentPage() - 1) * $driverData->perPage() + $loop->iteration }}</td>
                        <td>{{ $driver->id }}</td>
                        <td>{{ $driver->user_id }}</td>
                        <td>
                            <img src="{{ asset('uploads/driver/' . $driver->driver_license) }}" class="img-thumbnail" width="150px"
                                height="150px" alt="Images">
                        </td>
                        <td>
                            <a href="{{ route('admin#editDriver', $driver->id) }}">
                                <button type="button" class="btn btn-outline-primary" id="edit">
                                    <i class="fa fa-edit"></i></button>
                            </a>

                            <a href="{{ route('admin#deleteDriver', $driver->id) }}">
                                <button type="button" class="btn btn-outline-danger" id="delete">
                                    <i class="fa fa-trash"></i></button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $driverData->links() }}
    </div>

    <!-- End content-->
@endsection
