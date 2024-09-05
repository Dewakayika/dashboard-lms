@section('title')
    Admin Update Volunteer
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
                <li class="breadcrumb-item"><a href="{{ route('admin#listVolunteer') }}">List
                        Volunteer</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Volunteer</li>
            </ol>
        </nav>
    </div>

    <!-- END breadcrumb -->

    <!-- Start content -->
    <div id="fh5co-blog-section" class="fh5co-section-gray">

        <div class="container">
            <div class="row row-bottom-padded-md ">
                <div class="flex w-full p-4 justify-center items-center">
                    <div class="bg-white shadow-md p-7 rounded" id="form">
                        <form class="w-[600px]" action="{{ route('admin#updateVolunteer', $editVolunteer->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label">Volunteer Id</label>
                                <div class="col-md-8">
                                    <input type="text" name="id" readonly
                                        value="{{ old('id', $editVolunteer->id) }}"
                                        class="form-control" required="true">
                                </div>
                            </div>

                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-4 pt-0">Volunteer time (Noon)</legend>
                                <div class="col-sm-8">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="volunteer_time"
                                            id="inlineRadio1" value="part_time" @if($editVolunteer->volunteer_time == 'part_time') @return checked @endif>
                                        <label class="form-check-label" for="inlineRadio1">Part Time</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="volunteer_time"
                                            id="inlineRadio2" value="full_time" @if($editVolunteer->volunteer_time == 'full_time') @return checked @endif>
                                        <label class="form-check-label" for="inlineRadio2">Full Time</label>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-4 pt-0">Available day</legend>
                                <div class="col-sm-8">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="volunteer_available[]" value="Monday"
                                            type="checkbox" @if (str_contains($editVolunteer->volunteer_available, 'Monday')) @return checked @endif>
                                        <label class="form-check-label" for="inlineCheckbox1">Monday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="volunteer_available[]" value="Tuesday"
                                        type="checkbox" @if (str_contains($editVolunteer->volunteer_available, 'Tuesday')) @return checked @endif>
                                        <label class="form-check-label" for="inlineCheckbox2">Tuesday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="volunteer_available[]" value="Wednesday"
                                        type="checkbox" @if (str_contains($editVolunteer->volunteer_available, 'Wednesday')) @return checked @endif>
                                        <label class="form-check-label" for="inlineCheckbox3">Wednesday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="volunteer_available[]" value="Thursday"
                                        type="checkbox" @if (str_contains($editVolunteer->volunteer_available, 'Thursday')) @return checked @endif>
                                        <label class="form-check-label" for="inlineCheckbox4">Thursday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="volunteer_available[]" value="Friday"
                                        type="checkbox" @if (str_contains($editVolunteer->volunteer_available, 'Friday')) @return checked @endif>
                                        <label class="form-check-label" for="inlineCheckbox5">Friday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="volunteer_available[]" value="Saturday"
                                        type="checkbox" @if (str_contains($editVolunteer->volunteer_available, 'Saturday')) @return checked @endif>
                                        <label class="form-check-label" for="inlineCheckbox6">Saturday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="volunteer_available[]" value="Sunday"
                                        type="checkbox" @if (str_contains($editVolunteer->volunteer_available, 'Sunday')) @return checked @endif>
                                        <label class="form-check-label" for="inlineCheckbox7">Sunday</label>
                                    </div>
                                </div>
                            </fieldset>

                            <button type="submit" class="btn btn-outline-primary" style="float: right;">Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End content-->
@endsection
