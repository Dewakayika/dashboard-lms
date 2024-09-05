@section('title')
    Admin Update Campaign
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
                <li class="breadcrumb-item"><a href="{{ route('admin#listCampaign') }}">List
                        Campaign</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Campaign</li>
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
                        <form class="flex w-[600px] flex-col items-center justify-center"
                            action="{{ route('admin#updateCampaign', $editCampaign->id) }}" method="POST"
                            enctype="multipart/form-data">
                            <div class=" animate-box my-2">
                                <h1 class="animate-box text-3xl font-bold text-center">
                                    Update Campaign
                                </h1>
                            </div>
                            <div class="" style="">
                                <div class="row">
                                    @csrf
                                    <div>
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Campaign Id</label>
                                            <input type="text" class="form-control" readonly
                                                placeholder="Put your menu title here" name="id"
                                                value="{{ old('id', $editCampaign->id) }}">
                                        </div>
                                    </div>

                                    <div>
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Campaign Title</label>
                                            <input type="text" class="form-control"
                                                placeholder="Put your menu title here" name="campaign_title"
                                                value="{{ old('campaign_title', $editCampaign->campaign_title) }}">
                                        </div>
                                    </div>

                                    <div>
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Campaign Location</label>
                                            <input type="text" class="form-control"
                                                placeholder="Put your menu title here" name="campaign_location"
                                                value="{{ old('campaign_location', $editCampaign->campaign_location) }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 animate-box">
                                        @if ($editCampaign->campaign_image)
                                            <img src="{{ asset('uploads/campaign/' . $editCampaign->campaign_image) }}"
                                                class="img-thumbnail" alt="category image" width="200px">
                                            <br>
                                        @endif
                                        <div>
                                            <div class="form-group animate-box" style="padding-top: 10px">
                                                <label for="basic-url">Campaign Picture</label>
                                                <input type="file" title="Hallo" id="image" class="form-control"
                                                    name="campaign_image" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Campaign Description</label>
                                            <textarea class="form-control" id="" cols="30" rows="7" placeholder="Put your campaign description here"
                                                name="campaign_description" value="{{ old('campaign_description', $editCampaign->campagin_description) }}">{{ old('campaign_description', $editCampaign->campaign_description) }}</textarea>
                                        </div>
                                    </div>
                                    <div>
                                        <input type="hidden" class="form-control" placeholder="Put your partner id here"
                                            name="partner_id" value="{{ $editCampaign->partner_id }}" required>
                                    </div>
                                    <div>
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Campaign Role</label>
                                            <select name="campaign_role" class="form-control"
                                                value="{{ old('campaign_role', $editCampaign->campaign_role) }}" required>
                                                <option value="" disabled selected hidden>{{$editCampaign->campaign_role}}
                                                </option>
                                                <option>Driver</option>
                                                <option>Chef</option>
                                            </select>
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
