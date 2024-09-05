@section('title')
    Update Partner
@endsection

@extends('users.Partner.layouts.app')

@section('content')
    <div class="container w-300 sm:w-600 md:w-[700px] border mt-5 py-5 mb-5 shadow-lg bg-white rounded">
        <div class="p-3 py-5">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="d-flex flex-row align-items-center back"><i class="fa fa-long-arrow-left "></i>
                    <a href="{{ route('partner#partnerProfile') }}">Back to home</a>
                </div>
                <h6 class="text-right">Edit Profile</h6>
            </div>
            <form action="{{ route('partner#updatePartner') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 mt-4">
                    <div class="w-full ">
                        <label for="pname">Partner Name:</label>
                        <input type="text" class="form-control" value="{{ old('name', $partnerData->users->name) }}"
                            name="name">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 my-3">
                    <div class="w-full flex flex-col">
                        <label for="pgender">Partner Gender:</label>
                        <div class="form-check form-check-inline flex gap-10">
                            <div>
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                    value="0" required="" @if ($partnerData->users->gender == 0) @return checked @endif>
                                <label class="form-check-label" for="inlineRadio1" name="gender">Male</label>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                    value="1" required="" @if ($partnerData->users->gender == 1) @return checked @endif>
                                <label class="form-check-label" for="inlineRadio2" name="gender">Female</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 my-3">
                    <div class="">
                        <label for="fname">Partner Address:</label>
                        <input type="text" class="form-control"
                            value="{{ old('address', $partnerData->users->address) }}" name="address">
                    </div>
                    <div class="">
                        <label for="fname">Partner Phone Number:</label>
                        <input type="tel" maxlength="11" class="form-control"
                            value="{{ old('phone', $partnerData->users->phone) }}" name="phone">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 my-3">
                    <div class="">
                        <label for="fname">Partner Email:</label>
                        <input type="text" class="form-control" value="{{ old('email', $partnerData->users->email) }}"
                            name="email">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 my-3">
                    <div class="">
                        <label for="fname">Partner Organization:</label>
                        <input type="text" class="form-control"
                            value="{{ old('partner_organization', $partnerData->partner_organization) }}"
                            name="partner_organization">
                    </div>
                    <div class="">
                        <label for="fname">Partnership Timeline:</label>
                        <input type="text" class="form-control"
                            value="{{ old('partnership_timeline', $partnerData->partnership_timeline) }}"
                            name="partnership_timeline">
                    </div>
                </div>
                <div class="mt-5 text-right">
                    <button class="btn btn-warning btn-lg px-4 me-md-2" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
