@section('title')
    List Volunteer Admin
@endsection

@extends('Users.Admin.layouts.app')

@section('content')
    <!-- Start breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Volunteer</li>
            </ol>
        </nav>
    </div>

    <!-- END breadcrumb -->

    <!-- Start content -->
    <div class="container">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-center">
                Volunteer List
            </h1>
        </div>
        @if (Session::has('volunteerCreated'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('volunteerCreated') }}
            </div>
        @endif
        @if (Session::has('volunteerDeleted'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('volunteerDeleted') }}
            </div>
        @endif
        @if (Session::has('volunteerUpdated'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('volunteerUpdated') }}
            </div>
        @endif
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>Volunteer Id</th>
                    <th>User Id</th>
                    <th>Volunteer Timeline</th>
                    <th>Volunteer Available</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($volunteerData as $volunteer)
                    <tr>
                        <td>{{ ($volunteerData->currentPage() - 1) * $volunteerData->perPage() + $loop->iteration }}</td>
                        <td>{{ $volunteer->id }}</td>
                        <td>{{ $volunteer->user_id }}</td>
                        <td>{{ $volunteer->volunteer_time }}</td>
                        <td>{{ $volunteer->volunteer_available }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin#editVolunteer', $volunteer->id) }}">
                                <button type="button"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    id="details">
                                    Edit</button>
                            </a>
                            <a href="{{ route('admin#deleteVolunteer', $volunteer->user_id) }}">
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
        {{ $volunteerData->links() }}
    </div>

    <!-- End content-->
@endsection