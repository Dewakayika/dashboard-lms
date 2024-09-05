@section('title')
    Driver Dashboard
@endsection

@extends('Users.Partner.layouts.app')

@section('content')
    <!-- Start content -->
    <div class="container">

        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="mb-4">
                        {{-- Adding Categroy Session Checking  --}}
                        @if (Session::has('driverCreated'))
                            <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                                {{ Session::get('driverCreated') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        {{-- End of Session Checking --}}

                        {{-- Updating Categroy Session Checking  --}}
                        @if (Session::has('driverUpdated'))
                            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                                {{ Session::get('driverUpdated') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        {{-- End of Session Checking --}}

                        {{-- Deleting Categroy Session Checking  --}}
                        @if (Session::has('driverDeleted'))
                            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                {{ Session::get('driverUpdated') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        {{-- End of Session Checking --}}
                    </div>
                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Driver Name</th>
                                <th>Driver Gender</th>
                                <th>Driver Email</th>
                                <th>Driver Phone</th>
                                <th>Driver License</th>
                                <th>Action</th>

                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($driverData as $driver)
                                <tr>
                                    <td>{{ $driver->id }}</td>
                                    <td>{{ $driver->driver_name }}</td>
                                    <td>{{ $driver->driver_gender }}</td>
                                    <td>{{ $driver->driver_email }}</td>
                                    <td>{{ $driver->driver_phone }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/driver/' . $driver->driver_license) }}"
                                            class="img-thumbnail" width="150px" height="150px" alt="Images">
                                    </td>
                                    <td>
                                        <a href="{{ route('partner#editDriver', $driver->id) }}">
                                            <button type="button" class="btn btn-outline-primary" id="edit">
                                                <i class="fa fa-edit"></i></button>
                                        </a>
                                        <a href="{{ route('partner#deleteDriver', $driver->id) }}">
                                            <button type="button"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                                id="details">
                                                Delete</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $driverData->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End content -->
@endsection
