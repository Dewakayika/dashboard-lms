@section('title')
    Admin Update Member
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
                <li class="breadcrumb-item"><a href="{{ route('admin#listMember') }}">List
                        Member</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Member</li>
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
                        <form class="w-[600px]" action="{{ route('admin#updateMember', $editMember->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label">Member Id</label>
                                <div class="col-md-8">
                                    <input type="text" name="id" class="form-control" readonly
                                        value="{{ old('id', $editMember->id) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label">Caregiver
                                    Name</label>
                                <div class="col-md-8">
                                    <input type="text" name="member_caregiver_name" class="form-control"
                                        value="{{ old('member_caregiver_name', $editMember->member_caregiver_name) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label">Caregiver
                                    Relation</label>
                                <div class="col-md-8">
                                    <input type="text" name="member_caregiver_relation" class="form-control"
                                        value="{{ old('member_caregiver_relation', $editMember->member_caregiver_relation) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phone" class="col-md-4 col-form-label">Caregiver
                                    Phone Number</label>
                                <div class="col-sm-8">
                                    <input type="tel" maxlength="11" class="form-control" name="member_caregiver_number"
                                        value="{{ old('member_caregiver_number', $editMember->member_caregiver_number) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label">Member
                                    Condition</label>
                                <div class="col-md-8">
                                    <input type="text" name="member_medical_condition" class="form-control"
                                        value="{{ old('member_medical_condition', $editMember->member_medical_condition) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="memberstartservice" class="col-sm-4 col-form-label">Member Start
                                    Service</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="member_start_service"
                                        value="{{ old('member_start_service', $editMember->member_start_service) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="memberendservice" class="col-sm-4 col-form-label">Member End
                                    Service</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="member_end_service"
                                        value="{{ old('member_end_service', $editMember->member_end_service) }}">
                                </div>
                            </div>

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
