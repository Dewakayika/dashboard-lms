@section('title')
    Admin Update Meal
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
                <li class="breadcrumb-item"><a href="{{ route('admin#listMeal') }}">List
                        Meal</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Meal</li>
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
                            action="{{ route('admin#updateMeal', $editMeal->id) }}" method="POST"
                            enctype="multipart/form-data">
                            <div class=" animate-box my-2">
                                <h1 class="animate-box text-3xl font-bold text-center">
                                    Update Meal
                                </h1>
                            </div>
                            <div class="" style="">
                                <div class="row">
                                    @csrf
                                    <div>
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Menu Id</label>
                                            <input type="text" class="form-control" readonly
                                                placeholder="Put your menu title here" name="id"
                                                value="{{ old('id', $editMeal->id) }}">
                                        </div>
                                    </div>

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
                                                <input type="file" title="Hallo" id="image" class="form-control"
                                                    name="meal_image" value="">
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
                                            name="partner" value="{{ $editMeal->partner_id }}" required>
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
