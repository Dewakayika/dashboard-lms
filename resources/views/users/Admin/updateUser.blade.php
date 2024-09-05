@section('title')
    Partner Update User
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
                <li class="breadcrumb-item"><a href="{{ route('admin#listUser') }}">List
                        User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update User</li>
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
                        <form class="w-[500px]" action="{{ route('admin#updateUser', $editUser->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label">User Id</label>
                                <div class="col-md-8">
                                    <input type="text" readonly name="id" value="{{ old('id', $editUser->id) }}"
                                        class="form-control" required="true">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label">Name</label>
                                <div class="col-md-8">
                                    <input type="text" name="name" value="{{ old('name', $editUser->name) }}"
                                        class="form-control" required="true">
                                </div>
                            </div>

                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-4 pt-0">Gender</legend>
                                <div class="col-sm-8">

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                            value="0" required=""
                                            @if ($editUser->gender == 0) @return checked @endif>
                                        <label class="form-check-label" for="inlineRadio1" name="gender">Male</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                            value="1" required=""
                                            @if ($editUser->gender == 1) @return checked @endif>
                                        <label class="form-check-label" for="inlineRadio2" name="gender">Female</label>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" value="{{ old('email', $editUser->email) }}"
                                        name="email" required="true">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phone" class="col-sm-4 col-form-label">Phone number</label>
                                <div class="col-sm-8">
                                    <input type="tel" class="form-control" maxlength="11"
                                        value="{{ old('phone', $editUser->phone) }}" required="true" name="phone">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="address" class="col-sm-4 col-form-label">Address</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" required="true" value="{{ old('address', $editUser->address) }}" name="address"> {{ old('address', $editUser->address) }} </textarea>
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
