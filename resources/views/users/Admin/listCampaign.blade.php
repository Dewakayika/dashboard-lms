@section('title')
    List Campaign Admin
@endsection

@extends('Users.Admin.layouts.app')

@section('content')
    <!-- Start breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Campaign</li>
            </ol>
        </nav>
    </div>

    <!-- END breadcrumb -->

    <!-- Start content -->
    <div class="container">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-center">
                Campaign List
            </h1>
        </div>
        @if (Session::has('campaignCreated'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('campaignCreated') }}
            </div>
        @endif
        @if (Session::has('campaignDeleted'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('campaignDeleted') }}
            </div>
        @endif
        @if (Session::has('campaignUpdated'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('campaignUpdated') }}
            </div>
        @endif
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>Campaign ID</th>
                    <th>Partner ID</th>
                    <th>Campaign Title</th>
                    <th>Campaign Description</th>
                    <th>Campaign Role</th>
                    <th>Campaign Location</th>
                    <th>Campaign Image</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($campaignData as $campaign)
                    <tr>
                        <td>{{ ($campaignData->currentPage() - 1) * $campaignData->perPage() + $loop->iteration }}</td>
                        <td>{{ $campaign->id }}</td>
                        <td>{{ $campaign->partner_id }}</td>
                        <td>{{ $campaign->campaign_title }}</td>
                        <td>{{ $campaign->campaign_description }}</td>
                        <td>{{ $campaign->campaign_role }}</td>
                        <td>{{ $campaign->campaign_location }}</td>
                        <td class="p-3">
                            <img src="{{ asset('uploads/campaign/' . $campaign->campaign_image) }}"
                                class="img-thumbnail" width="150px" height="150px" alt="Images">
                        </td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin#editCampaign', $campaign->id) }}">
                                <button type="button"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    id="details">
                                    Edit</button>
                            </a>
                            <a href="{{ route('admin#deleteCampaign', $campaign->id) }}">
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
        {{ $campaignData->links() }}
    </div>

    <!-- End content-->
@endsection
