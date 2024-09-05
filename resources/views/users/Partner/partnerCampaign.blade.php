@section('title')
    Campaign Dashboard
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
                                    <td>{{ $campaign->id }}</td>
                                    <td>{{ $campaign->campaign_title }}</td>
                                    <td>{{ $campaign->campaign_description }}</td>
                                    <td>{{ $campaign->campaign_role }}</td>
                                    <td>{{ $campaign->campaign_location }}</td>
                                    <td>                    <img src="{{ asset('uploads/campaign/' . $campaign->campaign_image) }}" class="img-thumbnail" 
                                        width="100px" alt="Images"></td>
                                    <td>
                                        <a href="{{ route('partner#editCampaign', $campaign->id) }}">
                                            <button type="button" class="btn btn-outline-primary" id="edit">
                                                <i class="fa fa-edit"></i></button>
                                        </a>
                                        <a href="{{ route('partner#deleteCampaign', $campaign->id) }}">
                                            <button type="button" class="btn btn-outline-danger" id="edit">
                                                <i class="fa fa-trash"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $campaignData->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End content -->

    
@endsection
