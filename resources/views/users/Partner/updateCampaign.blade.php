@section('title')
    Partner Update Meal
@endsection

@extends('Users.Partner.layouts.app')

@section('content')
    <!-- Start breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('partner#index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('partner#index') }}">Partner Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Campaign</li>
        </ol>
    </nav>

    <!-- END breadcrumb -->

    <!-- Start content -->
    <div id="fh5co-blog-section" class="fh5co-section-gray">

        <div class="container">
            <div class="row row-bottom-padded-md ">
                <div class="container">
                    <div class="row">
                        <form class="flex flex-col items-center justify-center"
                            action="{{ route('partner#updateCampaign', $editCampaign->id) }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="col-lg-6 animate-box my-2">
                                <h1 class="animate-box text-3xl font-bold text-center">
                                    Update Campaign
                                </h1>
                            </div>
                            <div class="col-lg-6" style="padding-left: 60px">
                                <div class="row">
                                    @csrf
                                    <div class="mt-3">
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Campaign Title</label>
                                            <input type="text" class="form-control"
                                                placeholder="Put your campaign title here" name="campaign_title"
                                                value="{{ old('campaign_title', $editCampaign->campaign_title) }}">
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Campaign Description</label>
                                            <input type="text" class="form-control"
                                                placeholder="Put your campaign description" name="campaign_description"
                                                value="{{ old('campaign_description', $editCampaign->campaign_description) }}">
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        @if ($editCampaign->campaign_image)
                                            <img src="{{ asset('uploads/campaign/' . $editCampaign->campaign_image) }}"
                                                class="img-thumbnail" alt="category image" width="300px">
                                            <br>
                                        @endif
                                        <div class="-mt-6">
                                            <div class="form-group animate-box">
                                                <label for="basic-url">Campaign Image</label>
                                                <input type="file" class="form-control" name="campaign_image"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Campaign Location</label>
                                            <input type="tel" class="form-control"
                                                placeholder="Put your campaign location" name="campaign_location"
                                                value="{{ old('campaign_location', $editCampaign->campaign_location) }}">
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Campaign Role</label>
                                            <input type="tel" class="form-control" placeholder="Put your campaign role"
                                                name="campaign_role"
                                                value="{{ old('campaign_role', $editCampaign->campaign_role) }}">
                                        </div>
                                    </div>
                                    <div>
                                        <input type="hidden" class="form-control" placeholder="Put your partner name here"
                                            name="partner" value="{{ $partnerData->id }}" required>
                                    </div>
                                    <div class="mt-3">
                                        <div class="form-group animate-box">
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
@endsection
