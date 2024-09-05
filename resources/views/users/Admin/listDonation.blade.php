@section('title')
    List Donation Admin
@endsection

@extends('Users.Admin.layouts.app')

@section('content')
    <!-- Start breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Donation</li>
            </ol>
        </nav>
    </div>

    <!-- END breadcrumb -->

    <!-- Start content -->
    <div class="container">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-center">
                Donation List
            </h1>
        </div>
        @if (Session::has('donationCreated'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('donationCreated') }}
            </div>
        @endif
        @if (Session::has('donationDeleted'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('donationDeleted') }}
            </div>
        @endif
        @if (Session::has('donationUpdated'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('donationUpdated') }}
            </div>
        @endif
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>Donation ID</th>
                    <th>Donor Email</th>
                    <th>Donation Amount</th>
                    <th>Donation Description</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($donationData as $donation)
                    <tr>
                        <td>{{ $donation->id }}</td>
                        <td>{{ $donation->donation_id }}</td>
                        <td>{{ $donation->donations->email_donate }}</td>
                        <td>{{ $donation->amount }}</td>
                        <td>{{ $donation->description }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin#editDonation', $donation->id) }}">
                                <button type="button"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    id="details">
                                    Edit</button>
                            </a>
                            <a href="{{ route('admin#deleteDonation', $donation->id) }}">
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
    </div>

    <!-- End content-->
@endsection
