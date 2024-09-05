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
            <li class="breadcrumb-item active" aria-current="page">Update Meal</li>
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
                            action="{{ route('partner#updateMeal', $editMeal->id) }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="col-lg-6 animate-box my-2">
                                <h1 class="animate-box text-3xl font-bold text-center">
                                    Update Meal
                                </h1>
                            </div>
                            <div class="col-lg-6" style="padding-left: 60px">
                                <div class="row">
                                    @csrf
                                    <div>
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Menu Title</label>
                                            <input type="text" class="form-control"
                                                placeholder="Put your menu title here" name="meal_title"
                                                value="{{ old('meal_title', $editMeal->meal_title) }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 animate-box">
                                        @if ($editMeal->meal_image)
                                            <img src="{{ asset('uploads/meal/' . $editMeal->meal_image) }}"
                                                class="img-thumbnail" alt="category image" width="100px">
                                            <br>
                                        @endif
                                        <div>
                                            <div class="form-group animate-box" style="padding-top: 10px">
                                                <label for="basic-url">Menu Picture</label>
                                                <input type="file" class="form-control" name="meal_image" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Menu Description</label>
                                            <textarea class="form-control" id="" cols="30" rows="7" placeholder="Put your menu description here"
                                                name="meal_description" value="{{ old('meal_description', $editMeal->meal_description) }}">{{ old('meal_description', $editMeal->meal_description) }}</textarea>
                                        </div>
                                    </div>
                                    <div>
                                        <input type="hidden" class="form-control" placeholder="Put your partner name here"
                                            name="partner" value="{{ $partnerData->id }}" required>
                                    </div>
                                    <div>
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Menu Type</label>
                                            <select name="meal_type" class="form-control"
                                                value="{{ old('menu_type', $editMeal->meal_type) }}" required>
                                                <option value="" disabled selected hidden>Please Select One Below
                                                </option>
                                                <option>Hot</option>
                                                <option>Cold</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-10 border p-3 rounded-md">
                                        <h3 class="text-2xl">Menu Safety</h3>
                                        <input type="checkbox" id="text" name="text" value="text" required>
                                        <label for="text">No MSG</label><br>
                                        <input type="checkbox" id="text" name="text" value="text" required>
                                        <label for="text">No Artificial Preservative</label><br>
                                        <input type="checkbox" id="text" name="text" value="text" required>
                                        <label for="no_msg">No Artificial Sweeteners</label><br>
                                        <input type="checkbox" id="text" name="text" value="text" required>
                                        <label for="no_msg">No Artificial Coloring</label>
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
