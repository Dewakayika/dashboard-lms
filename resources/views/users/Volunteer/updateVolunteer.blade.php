@section('title')
    Update Admin
@endsection

@extends('users.Volunteer.layouts.app')

@section('content')
    <div class="container w-300 sm:w-600 md:w-[700px] border mt-5 py-5 mb-5 shadow-lg bg-white rounded">
        <div class="p-3 py-5">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="d-flex flex-row align-items-center back"><i class="fa fa-long-arrow-left "></i>
                    <a href="{{ route('volunteer#volunteerProfile') }}">Back to home</a>
                </div>
                <h6 class="text-right">Edit Profile</h6>
            </div>
            <form action="{{ route('volunteer#updateVolunteer') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 mt-4">
                    <div class="w-full ">
                        <label for="pname">Volunteer Name:</label>
                        <input type="text" class="form-control" value="{{ old('name', $volunteerData->users->name) }}"
                            name="name">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 my-3">
                    <div class="w-full flex flex-col">
                        <label for="pgender">Gender:</label>
                        <div class="form-check form-check-inline flex gap-10">
                            <div>
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                    value="0" required="" @if ($volunteerData->users->gender == 0) @return checked @endif>
                                <label class="form-check-label" for="inlineRadio1" name="gender">Male</label>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                    value="1" required="" @if ($volunteerData->users->gender == 1) @return checked @endif>
                                <label class="form-check-label" for="inlineRadio2" name="gender">Female</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 my-3">
                    <div class="">
                        <label for="fname">Address:</label>
                        <input type="text" class="form-control"
                            value="{{ old('address', $volunteerData->users->address) }}" name="address">
                    </div>
                    <div class="">
                        <label for="fname">Phone Number:</label>
                        <input type="tel" maxlength="11" class="form-control" value="{{ old('phone', $volunteerData->users->phone) }}"
                            name="phone">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 my-3">
                    <div class="">
                        <label for="fname">Email :</label>
                        <input type="text" class="form-control" value="{{ old('email', $volunteerData->users->email) }}"
                            name="email">
                    </div>
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-4 pt-0">Volunteer time (Noon)</legend>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="volunteer_time" id="inlineRadio1"
                                value="part_time" @if ($volunteerData->volunteer_time == 'part_time') @return checked @endif>
                            <label class="form-check-label" for="inlineRadio1">Part Time</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="volunteer_time" id="inlineRadio2"
                                value="full_time" @if ($volunteerData->volunteer_time == 'full_time') @return checked @endif>
                            <label class="form-check-label" for="inlineRadio2">Full Time</label>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-4 pt-0">Available day</legend>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="volunteer_available[]" value="Monday" type="checkbox"
                                @if (str_contains($volunteerData->volunteer_available, 'Monday')) @return checked @endif>
                            <label class="form-check-label" for="inlineCheckbox1">Monday</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="volunteer_available[]" value="Tuesday" type="checkbox"
                                @if (str_contains($volunteerData->volunteer_available, 'Tuesday')) @return checked @endif>
                            <label class="form-check-label" for="inlineCheckbox2">Tuesday</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="volunteer_available[]" value="Wednesday" type="checkbox"
                                @if (str_contains($volunteerData->volunteer_available, 'Wednesday')) @return checked @endif>
                            <label class="form-check-label" for="inlineCheckbox3">Wednesday</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="volunteer_available[]" value="Thursday"
                                type="checkbox" @if (str_contains($volunteerData->volunteer_available, 'Thursday')) @return checked @endif>
                            <label class="form-check-label" for="inlineCheckbox4">Thursday</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="volunteer_available[]" value="Friday" type="checkbox"
                                @if (str_contains($volunteerData->volunteer_available, 'Friday')) @return checked @endif>
                            <label class="form-check-label" for="inlineCheckbox5">Friday</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="volunteer_available[]" value="Saturday"
                                type="checkbox" @if (str_contains($volunteerData->volunteer_available, 'Saturday')) @return checked @endif>
                            <label class="form-check-label" for="inlineCheckbox6">Saturday</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="volunteer_available[]" value="Sunday" type="checkbox"
                                @if (str_contains($volunteerData->volunteer_available, 'Sunday')) @return checked @endif>
                            <label class="form-check-label" for="inlineCheckbox7">Sunday</label>
                        </div>
                    </div>
                </fieldset>
                <div class="mt-5 text-right"><button class="btn btn-warning btn-lg px-4 me-md-2"
                        type="submit">Update</button></div>
            </form>
        </div>
    </div>
@endsection
