@section('title')
    Partner Create Campaign
@endsection

@extends('Users.Partner.layouts.app')
@vite('resources/css/flying.css')
@section('content')
    <!-- Start breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('partner#index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('partner#index') }}">Partner Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Campaign</li>
            </ol>
        </nav>
    </div>

    <!-- END breadcrumb -->

    <!-- Start content -->
    <div id="fh5co-blog-section" class="fh5co-section-gray">

        <div class="container">
            <div class="row row-bottom-padded-md ">
                <div class="container d-flex justify-center">
        <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="https://www.linkpicture.com/q/campaign.png" class="img-fluid flying"
                alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <div class="row">
                        <form class="flex flex-col justify-center" action="{{ route('partner#saveCampaign') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-6 animate-box my-2">
                                <h1 class="animate-box text-3xl font-bold text-center">
                                    Add Your Own Campaign
                                </h1>
                                <x-jet-validation-errors class="my-2 text-1xl font-semibold text-center text-mow-red" />
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div>
                                        <div class="form-group animate-box my-1">
                                            <label for="basic-url">Campaign Title:</label>
                                            <input type="text" class="form-control w-96"
                                                placeholder="Put your campaign name here" name="campaign_title" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group animate-box my-1">
                                            <label for="basic-url">Campaign Description:</label>
                                            <input type="text" class="form-control w-96"
                                                placeholder="Put your campaign description here" name="campaign_description"
                                                required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group animate-box my-1">
                                            <label for="basic-url">Campaign Role:</label>
                                            <input type="text" class="form-control w-96"
                                                placeholder="Put your campaign role here" name="campaign_role" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group animate-box my-1">
                                            <label for="basic-url">Campaign Location:</label>
                                            <input type="text" class="form-control w-96"
                                                placeholder="Put your campaign location here" name="campaign_location"
                                                required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group animate-box my-1">
                                            <label for="basic-url">Campaign Image:</label>
                                            <input type="file" placeholder="Put your campaign image here"
                                                class="form-control w-96" name="campaign_image" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mt-4 form-group animate-box">
                                            <input type="submit" value="Create"
                                                class="bg-yellow-500 py-2 px-4 rounded-md text-white text-lg hover:bg-yellow-400">
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
