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
                        @if (Session::has('mealCreated'))
                            <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                                {{ Session::get('mealCreated') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        {{-- End of Session Checking --}}

                        {{-- Updating Categroy Session Checking  --}}
                        @if (Session::has('updateData'))
                            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                                {{ Session::get('updateData') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        {{-- End of Session Checking --}}

                        {{-- Deleting Categroy Session Checking  --}}
                        @if (Session::has('mealDeleted'))
                            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                {{ Session::get('mealDeleted') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        {{-- End of Session Checking --}}
                    </div>
                    <div>
                        <a href="{{ route('partner#orderVolunteer', $orderData->id) }}"><button class="btn btn-primary">Choose Volunteer</button></a>
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
                                    <td>{{ $driver->driver_license }}</td>
                                    <td>{{ $orderCount->where('driver_id', $driver->id)->count('delivery_status') }}/3
                                        <form action="{{ route('partner#saveOrderDriver', $driver->id) }}" method="GET">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $orderData->id }}">
                                            <button type="submit" class="btn btn-outline-primary" id="edit">
                                                Choose</button>
                                        </form>
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
