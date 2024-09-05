@section('title')
    Update Member
@endsection

@extends('users.Member.layouts.app')

@section('content')
<style>
    hr{
       height: 5px;
       border: 1px solid;
       border-radius: 10px; 
    }
</style>

    <div class="container w-300 sm:w-600 md:w-[700px] border mt-5 py-5 mb-5 shadow-lg bg-white rounded">
       <div class="p-3">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="d-flex flex-row align-items-center back "><i class="fa fa-long-arrow-left "></i>
                    <a href="{{ route('member#memberProfile') }}">Back to home</a>
                </div>
                <h6 class="text-right">Edit Profile</h6>
            </div>
            
            <form action="{{ route('member#updateMember') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                    <div class="w-full ">
                        <label for="fname">Member Name:</label>
                        <input type="text" class="form-control" placeholder="first name"
                            value="{{ old('name', $memberData->users->name) }}" name="name">
                    </div>
                    <div class="">
                        <label for="fname">Care Giver Name:</label>
                        <input type="text" class="form-control"
                            value="{{ old('member_caregiver_name', $memberData->member_caregiver_name) }}"
                            name="member_caregiver_name">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                    <div class="">
                        <label for="fname">Address:</label>
                        <input type="text" class="form-control" value="{{ old('address', $memberData->users->address) }}"
                            name="address">
                    </div>
                    <div class="">
                        <label for="fname">Care Giver Phone Number:</label>
                        <input type="tel" maxlength="11" class="form-control"
                            value="{{ old('member_caregiver_number', $memberData->member_caregiver_number) }}"
                            name="member_caregiver_number">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                    <div class="">
                        <label for="fname">Email :</label>
                        <input type="text" class="form-control" value="{{ old('email', $memberData->users->email) }}"
                            name="email">
                    </div>
                    <div class="">
                        <label for="fname">Medical Issue:</label>
                        <input type="text" class="form-control"
                            value="{{ old('member_medical_condition', $memberData->member_medical_condition) }}"
                            name="member_medical_condition">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                    <div class="">
                        <label for="fname">Member Phone Number:</label>
                        <input type="tel" maxlength="11" class="form-control" value="{{ old('phone', $memberData->users->phone) }}"
                            name="phone">
                    </div>
                    <div class="">
                        <label for="fname">Care Giver Relationship:</label>
                        <input type="text" class="form-control"
                            value="{{ old('member_caregiver_relation', $memberData->member_caregiver_relation) }}"
                            name="member_caregiver_relation">
                    </div>
                </div>
                <div class="mt-5 text-right"><button class="btn btn-warning btn-md px-4 me-md-2"
                        type="submit">Update</button></div>
            </form>
        </div>
    </div>
@endsection
